<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Transaction;
use App\Models\Progress;
use App\Models\Task;
use App\Models\VideoPart;
use App\Models\Certificate;
use Barryvdh\DomPDF\Facade as PDF;


class SiswaController extends Controller
{


    public function dashboard()
    {
        $user = Auth::user();
        
        // Get enrolled courses count
        $enrolledCount = $user->enrolledCourses()->count();
        
        // Get completed courses count
        $completedCount = $user->enrolledCourses()
            ->wherePivot('completion_status', 'completed')
            ->count();
        
        // Calculate total study hours from enrolled courses
        $totalHours = $user->enrolledCourses()->sum('duration');
        
        // Calculate overall progress
        $totalProgress = $user->enrolledCourses()
            ->sum('course_user.progress');
        $totalCourses = $user->enrolledCourses()->count();
        $overallProgress = $totalCourses > 0 ? round($totalProgress / $totalCourses) : 0;
    
        // Get recent courses with progress
        $recentCourses = $user->enrolledCourses()
            ->with('instructor')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($course) use ($user) {
                $course->progress = $user->enrolledCourses()
                    ->where('course_id', $course->id)
                    ->first()
                    ->pivot
                    ->progress ?? 0;
                return $course;
            });
    
        return view('siswa.dashboard', compact(
            'enrolledCount',
            'completedCount',
            'totalHours',
            'overallProgress',
            'recentCourses'
        ));
    }
    
    public function courses()
    {
        $user = Auth::user();
        $courses = $user->enrolledCourses()
            ->with(['videoParts', 'instructor'])
            ->get()
            ->map(function ($course) use ($user) {
                $totalVideos = $course->videoParts->count();
                $completedVideos = $user->videoParts()
                    ->where('course_id', $course->id)
                    ->count();
                
                $progress = $totalVideos > 0 ? round(($completedVideos / $totalVideos) * 100) : 0;
                
                // Update the progress in pivot table
                $user->enrolledCourses()->updateExistingPivot($course->id, [
                    'progress' => $progress
                ]);
                
                $course->progress = $progress;
                return $course;
            });
    
        return view('siswa.my-courses', compact('courses'));
    }
    

    public function editProfile()
    {
        return view('siswa.edit-profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nationality' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'occupation' => 'nullable|string|max:255',
            'personal_goal' => 'nullable|string|max:255',
        ]);
    
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $profilePicturePath = $profilePicture->store('profile_pictures', 'public');
            $user->profile_picture_url = $profilePicturePath;
        }
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nationality = $request->nationality;
        $user->city = $request->city;
        $user->phone = $request->phone;
        $user->occupation = $request->occupation;
        $user->personal_goal = $request->personal_goal;
    
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
    
        return redirect()->route('siswa.editProfile')->with('success', 'Profile updated successfully.');
    }

    public function progress()
    {
        $user = Auth::user();

        // Fetch progress data for the last 7 days
        $progressData = Progress::where('user_id', $user->id)
                                ->where('date', '>=', now()->subDays(7))
                                ->orderBy('date')
                                ->get();

        // Fetch the most studied topics
        $topics = Progress::where('user_id', $user->id)
                          ->select('topic', DB::raw('count(*) as total'))
                          ->groupBy('topic')
                          ->orderBy('total', 'desc')
                          ->take(2)
                          ->get();

        return view('siswa.progress', compact('progressData', 'topics'));
    }


public function transactions()
{
    $user = Auth::user();
    $transactions = $user->transactions()
        ->with('course')  // Eager load the course relationship
        ->orderBy('date', 'desc')
        ->paginate(10);

    return view('siswa.transactions', compact('transactions'));
}
public function buyCourse(Request $request)
{
    $request->validate([
        'course_id' => 'required|exists:courses,id',
    ]);

    $user = Auth::user();
    $course = Course::find($request->course_id);

    // Cek apakah pengguna sudah membeli kursus ini
    if ($user->enrolledCourses()->where('course_id', $course->id)->exists()) {
        return redirect()->back()->with('message', 'Anda sudah terdaftar di kursus ini.');
    }

    // Simpan transaksi
    $transaction = new Transaction();
    $transaction->user_id = $user->id;
    $transaction->course_id = $course->id; // Set the course_id field
    $transaction->description = "Pembelian kursus: " . $course->title;
    $transaction->amount = $course->discounted_price ?? $course->original_price;
    $transaction->date = now();
    $transaction->save();

    // Tambahkan kursus ke daftar kursus yang diikuti siswa
    $user->enrolledCourses()->attach($course->id);

    return redirect()->route('siswa.courses')->with('success', 'Kursus berhasil dibeli dan ditambahkan ke akun Anda.');
}

// Metode untuk menampilkan kursus yang dibeli pengguna
public function myCourses()
{
    $user = Auth::user();
    $courses = $user->enrolledCourses()->get();

    return view('siswa.my-courses', compact('courses'));
}


public function updateProgress(Request $request, $courseId)
{
    $user = Auth::user();
    $course = $user->enrolledCourses()->where('course_id', $courseId)->first();

    if (!$course) {
        return redirect()->route('siswa.courses')->with('error', 'Anda tidak terdaftar pada kursus ini.');
    }

    $request->validate([
        'progress' => 'required|integer|min:0|max:100',
        'topic' => 'required|string|max:255',
    ]);

    // Update or create progress
    $progress = Progress::updateOrCreate(
        [
            'user_id' => $user->id,
            'course_id' => $courseId,
            'topic' => $request->topic,
        ],
        [
            'progress' => $request->progress,
            'date' => now(),
        ]
    );

    // Check if the course is completed
    $totalProgress = $user->progress()
        ->where('course_id', $courseId)
        ->avg('progress');

    if ($totalProgress >= 100) {
        $user->enrolledCourses()->updateExistingPivot($courseId, ['completion_status' => 'completed']);
    }

    return redirect()->route('siswa.courses.show', $courseId)->with('success', 'Progress updated successfully.');
}


public function completeCourse($courseId)
{
    $user = Auth::user();
    $course = $user->enrolledCourses()->where('course_id', $courseId)->first();

    if (!$course) {
        return redirect()->route('siswa.courses')->with('error', 'Anda tidak terdaftar pada kursus ini.');
    }

    // Update the pivot table to mark the course as completed
    $user->enrolledCourses()->updateExistingPivot($courseId, ['completion_status' => 'completed']);

    // Generate certificate URL
    $certificateUrl = 'certificates/' . $user->id . '-' . $course->id . '.pdf';

    // Create certificate record
    $certificate = Certificate::create([
        'user_id' => $user->id,
        'course_id' => $course->id,
        'certificate_url' => $certificateUrl,
    ]);

    // Generate PDF
    $pdf = PDF::loadView('certificates.template', compact('user', 'course'));
    $pdf->save(storage_path('app/public/' . $certificateUrl));

    return redirect()->route('siswa.courses.show', $courseId)->with('success', 'Kursus berhasil diselesaikan dan sertifikat telah dibuat.');
}


public function showCourse($id, Request $request)
{
    $user = Auth::user();
    $course = Course::with(['tasks', 'videoParts', 'instructor'])->findOrFail($id);

    // Check if user is enrolled
    if (!$user->enrolledCourses()->where('course_id', $id)->exists()) {
        return redirect()->route('siswa.courses')->with('error', 'Anda tidak terdaftar pada kursus ini.');
    }

    // Calculate progress
    $totalVideos = $course->videoParts->count();
    $completedVideos = $user->videoParts()
        ->where('course_id', $course->id)
        ->count();
    $progressPercentage = $totalVideos > 0 ? round(($completedVideos / $totalVideos) * 100) : 0;

    // Update progress in pivot table
    $user->enrolledCourses()->updateExistingPivot($id, [
        'progress' => $progressPercentage
    ]);

    // Get current video
    $currentVideoId = $request->query('video');
    if ($currentVideoId) {
        $currentVideo = $course->videoParts()->find($currentVideoId);
    } else {
        $currentVideo = $course->videoParts()
            ->whereNotIn('id', $user->videoParts->pluck('id'))
            ->first();
    }

    if (!$currentVideo) {
        $currentVideo = $course->videoParts->first();
    }

    return view('siswa.courses.show', compact(
        'user',
        'course',
        'currentVideo',
        'totalVideos',
        'completedVideos',
        'progressPercentage'
    ));
}

public function updateTask(Request $request, $taskId)
{
    $task = Task::findOrFail($taskId);
    $task->is_completed = $request->is_completed;
    $task->save();

    // Update course progress
    $course = $task->course;
    $totalTasks = $course->tasks()->count();
    $completedTasks = $course->tasks()->where('is_completed', true)->count();
    $progress = ($completedTasks / $totalTasks) * 100;

    // Update the pivot table with the new progress
    Auth::user()->enrolledCourses()->updateExistingPivot($course->id, ['progress' => $progress]);

    return redirect()->route('siswa.courses.show', $course->id)->with('success', 'Task updated successfully.');
}





public function completeVideoPart($videoPartId)
{
    $user = Auth::user();
    $videoPart = VideoPart::findOrFail($videoPartId);
    $course = $videoPart->course;

    // Check if user is enrolled
    if (!$user->enrolledCourses()->where('course_id', $course->id)->exists()) {
        return redirect()->route('siswa.courses')->with('error', 'Anda tidak terdaftar pada kursus ini.');
    }

    // Mark video as completed
    $user->videoParts()->attach($videoPartId);

    // Calculate progress
    $totalVideoParts = $course->videoParts()->count();
    $completedVideoParts = $user->videoParts()->where('course_id', $course->id)->count();
    $progress = ($completedVideoParts / $totalVideoParts) * 100;

    // Update course progress
    $user->enrolledCourses()->updateExistingPivot($course->id, ['progress' => $progress]);

    // Check if the course is completed
    if ($progress >= 100) {
        $user->enrolledCourses()->updateExistingPivot($course->id, ['completion_status' => 'completed']);

        // Generate certificate file name
        $certificateFileName = $user->id . '-' . $course->id . '.pdf';

        // Ensure the certificates directory exists
        $certificatesPath = storage_path('app/public/certificates');
        if (!file_exists($certificatesPath)) {
            mkdir($certificatesPath, 0777, true);
        }

        // Generate PDF and save it
        $pdf = PDF::loadView('certificates.template', compact('user', 'course'));
        $pdf->save($certificatesPath . '/' . $certificateFileName);

        // Generate certificate URL (relative to public directory)
        $certificateUrl = 'certificates/' . $certificateFileName;

        // Create certificate record
        $certificate = Certificate::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'certificate_url' => $certificateUrl,
        ]);
    }

    return redirect()
        ->route('siswa.courses.show', $course->id)
        ->with('success', 'Video berhasil diselesaikan!');
}

public function completeTask(Request $request, $taskId)
{
    $task = Task::findOrFail($taskId);
    $task->is_completed = true;
    $task->save();

    // Update course progress
    $course = $task->course;
    $totalTasks = $course->tasks()->count();
    $completedTasks = $course->tasks()->where('is_completed', true)->count();
    $progress = ($completedTasks / $totalTasks) * 100;

    // Update the pivot table with the new progress
    Auth::user()->enrolledCourses()->updateExistingPivot($course->id, ['progress' => $progress]);

    return redirect()->route('siswa.courses.show', $course->id)->with('success', 'Task completed successfully.');
}

public function generateCertificate($courseId)
{
    $user = Auth::user();
    $course = Course::findOrFail($courseId);

    // Check if the user has completed the course
    if (!$user->enrolledCourses()->where('course_id', $courseId)->wherePivot('completion_status', 'completed')->exists()) {
        return redirect()->route('siswa.courses.show', $courseId)->with('error', 'Anda belum menyelesaikan kursus ini.');
    }

    // Generate certificate URL
    $certificateUrl = 'certificates/' . $user->id . '-' . $course->id . '.pdf';

    // Create certificate record
    $certificate = Certificate::create([
        'user_id' => $user->id,
        'course_id' => $course->id,
        'certificate_url' => $certificateUrl,
    ]);

    // Generate PDF
    $pdf = PDF::loadView('certificates.template', compact('user', 'course'));
    $pdf->save(storage_path('app/public/' . $certificateUrl));

    return redirect()->route('siswa.courses.show', $courseId)->with('success', 'Sertifikat berhasil dibuat.');
}

public function downloadCertificate($certificateId)
{
    $certificate = Certificate::findOrFail($certificateId);
    $filePath = storage_path('app/public/' . $certificate->certificate_url);

    if (!file_exists($filePath)) {
        return redirect()->back()->with('error', 'Sertifikat tidak ditemukan.');
    }

    return response()->download($filePath);
}

public function indexCertificates()
{
    $user = Auth::user();
    $certificates = $user->certificates()->with('course')->get();

    return view('siswa.certificates.index', compact('certificates'));
}
}