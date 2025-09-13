<?php
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\InstructorController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;
use App\Models\Course;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ReportController;


Route::get('/', function () {
    $courses = Course::all(); 
    return view('home', compact('courses'));
})->name('home');

Route::get('/chat', function () {
    return view('courseRecommender');
})->name('courseRecommender');

// Route untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Route untuk registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Route untuk forget password
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Route untuk logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Rute untuk menampilkan halaman verifikasi OTP
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Rute untuk mengirim OTP
Route::post('/otp/send', [OtpController::class, 'sendOtp'])->middleware('auth')->name('otp.send');

// Rute untuk memverifikasi OTP
Route::post('/otp/verify', [OtpController::class, 'verifyOtp'])->middleware('auth')->name('otp.verify');

// Route untuk dashboard admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});


// Route for instructor dashboard
Route::middleware(['auth', 'role:instructor'])->prefix('instructor')->group(function () {
    Route::get('/dashboard', [InstructorController::class, 'dashboard'])->name('instructor.dashboard');
});

// Route for admin to create instructor accounts
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/create-instructor', [AdminController::class, 'showCreateInstructorForm'])->name('admin.createInstructor');
    Route::post('/create-instructor', [AdminController::class, 'createInstructor'])->name('admin.storeInstructor');
});


// Route untuk dashboard siswa
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/courses', [SiswaController::class, 'courses'])->name('siswa.courses');
    Route::get('/edit-profile', [SiswaController::class, 'editProfile'])->name('siswa.editProfile');
    Route::put('/update-profile', [SiswaController::class, 'updateProfile'])->name('siswa.updateProfile');
    Route::delete('/delete-profile-picture', [SiswaController::class, 'deleteProfilePicture'])->name('siswa.deleteProfilePicture');
    Route::get('/progress', [SiswaController::class, 'progress'])->name('siswa.progress');
    Route::get('/transactions', [SiswaController::class, 'transactions'])->name('siswa.transactions');
    Route::post('/courses/{id}/complete', [SiswaController::class, 'completeCourse'])->name('siswa.courses.complete');
    Route::post('/courses/{id}/progress', [SiswaController::class, 'updateProgress'])->name('siswa.courses.updateProgress');
    Route::get('/courses/{id}', [SiswaController::class, 'showCourse'])->name('siswa.courses.show');
    Route::post('/tasks/{id}/update', [SiswaController::class, 'updateTask'])->name('siswa.tasks.update');
    Route::post('/tasks/{id}/update', [SiswaController::class, 'completeTask'])->name('siswa.tasks.update'); 
    Route::post('/video-parts/{id}/complete', [SiswaController::class, 'completeVideoPart'])->name('siswa.videoParts.complete');
    Route::get('/courses/{id}/certificate', [SiswaController::class, 'generateCertificate'])->name('siswa.courses.certificate');
    Route::get('/certificates/{id}/download', [SiswaController::class, 'downloadCertificate'])->name('siswa.certificates.download');
    Route::get('/certificates', [SiswaController::class, 'indexCertificates'])->name('siswa.certificates.index');
Route::post('/video-parts/{id}/watch-time', [SiswaController::class, 'updateWatchTime'])->name('siswa.videoParts.watchTime');
});


// Route untuk pembelian kursus
Route::middleware(['auth'])->group(function () {
    Route::post('/siswa/buy-course', [SiswaController::class, 'buyCourse'])->name('siswa.buyCourse');
    Route::get('/siswa/my-courses', [SiswaController::class, 'myCourses'])->name('siswa.myCourses');
    Route::get('/payment/{course_id}', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/cancel', [PaymentController::class, 'cancelPayment'])->name('payment.cancel');
});

// Route untuk menampilkan detail kursus
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {
    Route::get('/courses/{id}', [SiswaController::class, 'showCourse'])->name('siswa.courses.show');
});


// Route untuk admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/courses/create', [AdminController::class, 'showCreateCourseForm'])->name('admin.courses.create');
    Route::post('/admin/courses', [AdminController::class, 'storeCourse'])->name('admin.courses.store');
    Route::put('/admin/courses/{id}', [AdminController::class, 'updateCourse'])->name('admin.courses.update');
    Route::delete('/admin/courses/{id}', [AdminController::class, 'deleteCourse'])->name('admin.courses.delete');
    Route::get('/instructors', [AdminController::class, 'instructors'])->name('admin.instructors');
    Route::post('/instructors', [AdminController::class, 'createInstructor'])->name('admin.instructors.store');
    Route::put('/instructors/{id}', [AdminController::class, 'updateInstructor'])->name('admin.instructors.update');
    Route::put('/instructors/{id}/toggle-status', [AdminController::class, 'toggleInstructorStatus'])->name('admin.instructors.toggleStatus');
    Route::delete('/instructors/{id}', [AdminController::class, 'deleteInstructor'])->name('admin.instructors.delete');
    Route::get('/download-report', [AdminController::class, 'downloadReport'])->name('admin.downloadReport');
    Route::get('/admin/students', [AdminController::class, 'students'])->name('admin.students.index'); // Changed from 'admin.students'
    Route::get('/admin/students/{id}', [AdminController::class, 'showStudent'])->name('admin.students.show');
    Route::get('/finance', [AdminController::class, 'finance'])->name('admin.finance');
    Route::get('/admin/finance/export', [AdminController::class, 'exportFinanceReport'])->name('admin.finance.export');
    Route::get('/admin/transactions/{year}/{month}', function($year, $month) {
    return App\Models\Transaction::with(['course', 'user'])
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date', 'desc')
            ->get();
    })->middleware(['auth', 'role:admin'])->name('admin.transactions.filter');
    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::post('/admin/reports/generate', [AdminController::class, 'generateReport'])->name('admin.reports.generate');
    Route::delete('/threads/{id}', [ThreadController::class, 'destroy'])->name('threads.destroy');
    Route::get('/admin/forum-reports', [AdminController::class, 'forumReports'])->name('admin.forumReports');
    Route::post('/admin/reports/generate', [ReportController::class, 'generateReport'])->name('admin.reports.generate');
});



Route::get('/verify/{id}', [CertificateController::class, 'verify'])
    ->name('certificate.verify');

    Route::resource('forums', ForumController::class)->except(['create']);
    Route::resource('threads', ThreadController::class)->except(['create']);
    
    Route::get('/forums', [ForumController::class, 'index'])->name('forums.index');
    Route::post('/threads', [ThreadController::class, 'store'])->name('threads.store');
    Route::get('/forums/category/{id}', [ForumController::class, 'filterByCategory'])->name('forums.filterByCategory');
    Route::post('/threads/store', [ThreadController::class, 'storeFromIndex'])->name('threads.storeFromIndex');
    Route::get('/forums/category', [ForumController::class, 'showAllCategories'])->name('forums.showAllCategories');
    Route::get('/forums/category/{id}', [ForumController::class, 'filterByCategory'])->name('forums.filterByCategory');
    Route::get('/threads/{id}', [ThreadController::class, 'show'])->name('threads.show');
    Route::post('/threads/{id}/upvote', [ThreadController::class, 'upvote'])->name('threads.upvote');
    Route::post('/threads/{id}/downvote', [ThreadController::class, 'downvote'])->name('threads.downvote');
    Route::post('/threads/{id}/comment', [ThreadController::class, 'comment'])->name('threads.comment');
    Route::get('/threads/{id}/comments', [ThreadController::class, 'commentsPage'])->name('threads.commentsPage');
    Route::post('/threads/{id}/reply', [ThreadController::class, 'reply'])->name('threads.reply');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
  
    Route::post('/reports', [ThreadController::class, 'storeReport'])->name('reports.store');
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports');
    Route::get('/admin/reports/download/{id}', [ReportController::class, 'downloadReport'])->name('admin.reports.download');
    Route::post('/comments/reply', [CommentController::class, 'storeReply'])->name('comments.reply');
  
   
    Route::get('/kursus', [AdminController::class, 'listCourses'])->name('courses.list');


    Route::get('/search', [ForumController::class, 'search'])->name('threads.search');
    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');