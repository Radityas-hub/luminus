<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Course;
use App\Models\Transaction;
use App\Models\Report; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Dompdf\Dompdf;
use Dompdf\Options;

class AdminController extends Controller
{
    public function dashboard()
    {
        $jumlahSiswa = User::where('role', 'siswa')->count();
        $jumlahKursus = Course::count();
        $jumlahInstruktur = User::where('role', 'instructor')->count();
        $recentCourses = Course::with('instructor', 'students')->latest()->take(5)->get();
        
        // Data for charts
        $enrollmentData = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                              ->where('role', 'siswa')
                              ->groupBy('month')
                              ->orderBy('month')
                              ->pluck('count', 'month')->toArray();
        
        $revenueData = Transaction::selectRaw('MONTH(date) as month, SUM(amount) as total')
                                  ->groupBy('month')
                                  ->orderBy('month')
                                  ->pluck('total', 'month')->toArray();
        
        // Ensure all months are represented in the data
        $enrollmentData = $this->fillMissingMonths($enrollmentData);
        $revenueData = $this->fillMissingMonths($revenueData);
        
        // Calculate new courses added this month
        $newCoursesThisMonth = Course::whereMonth('created_at', now()->month)->count();
        
        // Calculate new students enrolled this month
        $newStudentsThisMonth = User::where('role', 'siswa')->whereMonth('created_at', now()->month)->count();
        
        // Calculate new instructors added this month
        $newInstructorsThisMonth = User::where('role', 'instructor')->whereMonth('created_at', now()->month)->count();
        
        // Calculate total course sales and monthly revenue
        $totalCourseSales = Transaction::sum('amount');
        $monthlyRevenue = Transaction::whereMonth('date', now()->month)->sum('amount');
        $monthlyRevenuePercentage = $this->calculateMonthlyRevenuePercentage();

        return view('admin.dashboard', compact('jumlahSiswa', 'jumlahKursus', 'jumlahInstruktur', 'recentCourses', 'enrollmentData', 'revenueData', 'newCoursesThisMonth', 'newStudentsThisMonth', 'newInstructorsThisMonth', 'totalCourseSales', 'monthlyRevenue', 'monthlyRevenuePercentage'));
    }


    
    public function downloadReport()
    {
        $data = [
            'jumlahSiswa' => User::where('role', 'siswa')->count(),
            'jumlahKursus' => Course::count(),
            'jumlahInstruktur' => User::where('role', 'instructor')->count(),
            'newCoursesThisMonth' => Course::whereMonth('created_at', now()->month)->count(),
            'newStudentsThisMonth' => User::where('role', 'siswa')->whereMonth('created_at', now()->month)->count(),
            'newInstructorsThisMonth' => User::where('role', 'instructor')->whereMonth('created_at', now()->month)->count(),
            'totalCourseSales' => Transaction::sum('amount'),
            'monthlyRevenue' => Transaction::whereMonth('date', now()->month)->sum('amount'),
            'monthlyRevenuePercentage' => $this->calculateMonthlyRevenuePercentage(),
        ];
    
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Set page orientation and margins
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageMargins()->setTop(0.5)->setRight(0.5)->setBottom(0.5)->setLeft(0.5);
    
        // Company Header
        $sheet->setCellValue('A1', 'Luminus ');
        $sheet->mergeCells('A1:I1');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 20],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
    
        // Report Title
        $sheet->setCellValue('A3', 'LAPORAN KINERJA BULANAN');
        $sheet->mergeCells('A3:I3');
        $sheet->getStyle('A3')->applyFromArray([
            'font' => ['bold' => true, 'size' => 16],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
    
        // Period
        $sheet->setCellValue('A4', 'Untuk Periode  ' . now()->format('d F, Y'));
        $sheet->mergeCells('A4:I4');
        $sheet->getStyle('A4')->applyFromArray([
            'font' => ['italic' => true, 'size' => 12],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
    
        $sections = [
            'A7:C7' => 'STATISTIK PENGGUNA',
            'D7:F7' => 'METRIK PERTUMBUHAN BULANAN',
            'G7:I7' => 'RINGKASAN KEUANGAN'
        ];
    
        foreach ($sections as $range => $title) {
            $sheet->setCellValue(explode(':', $range)[0], $title);
            $sheet->mergeCells($range);
            $sheet->getStyle($range)->applyFromArray([
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '1F4E78']
                ],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
            ]);
        }
    
        $dataLayout = [
            'A8' => ['Jumlah Siswa', $data['jumlahSiswa']],
            'B8' => ['Jumlah Kursus', $data['jumlahKursus']],
            'C8' => ['Jumlah Instruktur', $data['jumlahInstruktur']],
            'D8' => ['Kursus Baru', $data['newCoursesThisMonth']],
            'E8' => ['Siswa Baru', $data['newStudentsThisMonth']],
            'F8' => ['Instruktur Baru', $data['newInstructorsThisMonth']],
            'G8' => ['Total Penjualan', 'Rp ' . number_format($data['totalCourseSales'], 0, ',', '.')],
            'H8' => ['Pendapatan Bulanan', 'Rp ' . number_format($data['monthlyRevenue'], 0, ',', '.')],
            'I8' => ['Tingkat Pertumbuhan', number_format($data['monthlyRevenuePercentage'], 1) . '%']
        ];
    
        foreach ($dataLayout as $cell => $value) {
            
            $sheet->setCellValue($cell, $value[0]);
            $sheet->getStyle($cell)->applyFromArray([
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E7EEF5']
                ],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
            ]);
    
            
            $valueCell = substr($cell, 0, 1) . (intval(substr($cell, 1)) + 1);
            $sheet->setCellValue($valueCell, $value[1]);
            $sheet->getStyle($valueCell)->applyFromArray([
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
            ]);
        }

        foreach (range('A', 'I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    
        $footerRow = 12;
        $sheet->setCellValue("A{$footerRow}", 'Dibuat oleh: ' . auth()->user()->name);
        $sheet->setCellValue("G{$footerRow}", 'Dibuat pada: ' . now()->format('d/m/Y H:i:s'));
        $sheet->mergeCells("A{$footerRow}:F{$footerRow}");
        $sheet->mergeCells("G{$footerRow}:I{$footerRow}");
        $sheet->getStyle("A{$footerRow}:I{$footerRow}")->applyFromArray([
            'font' => ['italic' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],
        ]);
    
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Laporan_Keuangan_' . now()->format('F_Y') . '.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);
    
        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }

    private function fillMissingMonths($data)
    {
        $filledData = [];
        for ($month = 1; $month <= 12; $month++) {
            $filledData[$month] = $data[$month] ?? 0;
        }
        return $filledData;
    }

    private function calculateMonthlyRevenuePercentage()
    {
        $lastMonthRevenue = Transaction::whereMonth('date', now()->subMonth()->month)->sum('amount');
        $currentMonthRevenue = Transaction::whereMonth('date', now()->month)->sum('amount');

        if ($lastMonthRevenue == 0) {
            return $currentMonthRevenue > 0 ? 100 : 0;
        }

        return (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100;
    }



    public function showCreateInstructorForm()
    {
        return view('admin.create-instructor');
    }

    public function storeCourse(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructor_id' => 'required|exists:users,id',
            'original_price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'video_count' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_parts' => 'required|array',
            'video_parts.*.title' => 'required|string|max:255',
            'video_parts.*.video_url' => 'required|url',
        ]);
    
        $course = new Course();
        $course->title = $request->title;
        $course->description = $request->description;
        $course->instructor_id = $request->instructor_id;
        $course->original_price = $request->original_price;
        $course->discounted_price = $request->discounted_price;
        $course->duration = $request->duration;
        $course->video_count = $request->video_count;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('courses', 'public');
            $course->image_url = $imagePath;
        }
    
        // Calculate discount percentage if discounted price is provided
        if ($request->discounted_price) {
            $course->discount_percentage = (($request->original_price - $request->discounted_price) / $request->original_price) * 100;
        } else {
            $course->discount_percentage = 0;
        }
    
        $course->save();
    
        // Save video parts
        foreach ($request->video_parts as $videoPart) {
            $course->videoParts()->create([
                'title' => $videoPart['title'],
                'video_url' => $videoPart['video_url'],
            ]);
        }
    
        return redirect()->route('admin.courses.create')->with('success', 'Kursus berhasil dibuat!');
    }
    


public function instructors()
{
    $instructors = User::where('role', 'instructor')->get();
    return view('admin.instructors', compact('instructors'));
}

public function createInstructor(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'instructor',
    ]);

    return redirect()->route('admin.instructors')->with('success', 'Instructor created successfully!');
}

public function updateInstructor(Request $request, $id)
{
    $instructor = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $instructor->name = $request->name;
    $instructor->email = $request->email;
    if ($request->filled('password')) {
        $instructor->password = Hash::make($request->password);
    }
    $instructor->save();

    return redirect()->route('admin.instructors')->with('success', 'Instructor updated successfully!');
}


public function deleteInstructor($id)
{
    $instructor = User::findOrFail($id);
    $instructor->delete();

    return redirect()->route('admin.instructors')->with('success', 'Instructor deleted successfully!');
}


public function toggleInstructorStatus($id)
{
    $instructor = User::findOrFail($id);
    $instructor->status = $instructor->status == 'active' ? 'inactive' : 'active';
    $instructor->save();

    return redirect()->route('admin.instructors')->with('success', 'Instructor status updated successfully!');
}

public function courses()
{
    $courses = Course::all();
    return view('admin.courses.index', compact('courses'));
}



public function updateCourse(Request $request, $id)
{
    $course = Course::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'instructor_id' => 'required|exists:users,id',
        'original_price' => 'required|numeric|min:0',
        'discounted_price' => 'nullable|numeric|min:0',
        'duration' => 'required|integer|min:1',
        'video_count' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $course->title = $request->title;
    $course->description = $request->description;
    $course->instructor_id = $request->instructor_id;
    $course->original_price = $request->original_price;
    $course->discounted_price = $request->discounted_price;
    $course->duration = $request->duration;
    $course->video_count = $request->video_count;

    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($course->image_url && file_exists(storage_path('app/public/' . $course->image_url))) {
            \Storage::delete('public/' . $course->image_url);
        }
        // Simpan gambar baru
        $image = $request->file('image');
        $imagePath = $image->store('courses', 'public');
        $course->image_url = $imagePath;
    }

    // Hitung persentase diskon jika harga diskon diberikan
    if ($request->discounted_price) {
        $course->discount_percentage = (($request->original_price - $request->discounted_price) / $request->original_price) * 100;
    } else {
        $course->discount_percentage = 0;
    }

    $course->save();

    return redirect()->route('admin.courses.create')->with('success', 'Kursus berhasil diperbarui!');
}

public function deleteCourse($id)
{
    $course = Course::findOrFail($id);
    $course->delete();

    return redirect()->route('admin.courses.create')->with('success', 'Kursus berhasil dihapus!');
}

public function showCreateCourseForm()
{
    $instructors = User::where('role', 'instructor')->get();
    $courses = Course::all();
    return view('admin.courses.create', compact('instructors', 'courses'));
} 


public function students(Request $request)
{
    $query = User::where('role', 'siswa');
    
    if ($request->has('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%");
        });
    }
    
    $students = $query->get();
    return view('admin.students.index', compact('students'));
}

public function showStudent($id)
{
    $student = User::with('enrolledCourses', 'progress', 'transactions')->findOrFail($id);
    return view('admin.students.show', compact('student'));
}


public function finance()
{
    // Total pendapatan platform
    $totalRevenue = Transaction::sum('amount');

    // Monthly Revenue for current year
    $monthlyRevenues = Transaction::selectRaw('
        MONTH(date) as month,
        MONTHNAME(date) as month_name,
        YEAR(date) as year,
        SUM(amount) as total_amount,
        COUNT(*) as transaction_count
    ')
    ->whereYear('date', now()->year)
    ->groupBy('year', 'month', 'month_name')
    ->orderBy('month', 'DESC')
    ->get();

    // Previous Year Comparison
    $lastYearRevenues = Transaction::selectRaw('
        MONTH(date) as month,
        MONTHNAME(date) as month_name,
        YEAR(date) as year,
        SUM(amount) as total_amount
    ')
    ->whereYear('date', now()->year - 1)
    ->groupBy('year', 'month', 'month_name')
    ->orderBy('month', 'DESC')
    ->get();

    // Pendapatan per kursus
    $revenuePerCourse = Course::withSum('transactions', 'amount')->get();

    // Laporan penjualan kursus secara terperinci
    $salesReports = Transaction::with('course', 'user')->get();

    return view('admin.finance', compact(
        'totalRevenue', 
        'monthlyRevenues', 
        'lastYearRevenues',
        'revenuePerCourse', 
        'salesReports'
    ));
}

public function exportFinanceReport()
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    // Company Header
    $sheet->setCellValue('A1', 'LUMINUS EDUCATION');
    $sheet->setCellValue('A2', 'FINANCIAL REPORT');
    $sheet->setCellValue('A3', 'Period: ' . now()->format('F Y'));
    $sheet->mergeCells('A1:F1');
    $sheet->mergeCells('A2:F2');
    $sheet->mergeCells('A3:F3');

    // Revenue Summary Section
    $sheet->setCellValue('A5', 'REVENUE SUMMARY');
    $sheet->mergeCells('A5:F5');
    
    $sheet->setCellValue('B7', 'Total Revenue');
    $sheet->setCellValue('C7', Transaction::sum('amount'));
    
    $sheet->setCellValue('B8', 'Monthly Revenue');
    $sheet->setCellValue('C8', Transaction::whereMonth('date', now()->month)->sum('amount'));
    
    // Monthly Revenue Growth
    $lastMonthRevenue = Transaction::whereMonth('date', now()->subMonth()->month)->sum('amount');
    $currentMonthRevenue = Transaction::whereMonth('date', now()->month)->sum('amount');
    $growth = $lastMonthRevenue != 0 ? (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 : 0;
    
    $sheet->setCellValue('B9', 'Revenue Growth');
    $sheet->setCellValue('C9', number_format($growth, 2) . '%');

    // Course Revenue Section
    $sheet->setCellValue('A11', 'COURSE REVENUE ANALYSIS');
    $sheet->mergeCells('A11:F11');
    
    $sheet->setCellValue('B13', 'Course Name');
    $sheet->setCellValue('C13', 'Revenue');
    $sheet->setCellValue('D13', 'Students');
    $sheet->setCellValue('E13', '% of Total');

    $totalRevenue = Transaction::sum('amount');
    $courseRevenue = Course::withSum('transactions', 'amount')
        ->withCount('students')
        ->get();

    $row = 14;
    foreach ($courseRevenue as $course) {
        $percentage = ($course->transactions_sum_amount / $totalRevenue) * 100;
        
        $sheet->setCellValue('B' . $row, $course->title);
        $sheet->setCellValue('C' . $row, $course->transactions_sum_amount ?? 0);
        $sheet->setCellValue('D' . $row, $course->students_count);
        $sheet->setCellValue('E' . $row, number_format($percentage, 2) . '%');
        $row++;
    }

    // Transaction History
    $sheet->setCellValue('A' . ($row + 2), 'TRANSACTION HISTORY');
    $sheet->mergeCells('A' . ($row + 2) . ':F' . ($row + 2));
    
    $row += 4;
    $sheet->setCellValue('B' . $row, 'Date');
    $sheet->setCellValue('C' . $row, 'Course');
    $sheet->setCellValue('D' . $row, 'Student');
    $sheet->setCellValue('E' . $row, 'Amount');

    $transactions = Transaction::with(['course', 'user'])
        ->orderBy('date', 'desc')
        ->take(50)
        ->get();

    $row++;
    foreach ($transactions as $transaction) {
        $sheet->setCellValue('B' . $row, $transaction->date->format('d M Y'));
        $sheet->setCellValue('C' . $row, $transaction->course->title);
        $sheet->setCellValue('D' . $row, $transaction->user->name);
        $sheet->setCellValue('E' . $row, $transaction->amount);
        $row++;
    }

    // Styling
    $headerStyle = [
        'font' => [
            'bold' => true,
            'size' => 14,
            'color' => ['rgb' => '1E3A8A']
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'EFF6FF']
        ]
    ];

    $subHeaderStyle = [
        'font' => [
            'bold' => true,
            'size' => 11,
            'color' => ['rgb' => '1E40AF']
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'F3F4F6']
        ],
        'borders' => [
            'bottom' => ['borderStyle' => Border::BORDER_THIN]
        ]
    ];

    $currencyStyle = [
        'numberFormat' => [
            'formatCode' => '"Rp"#,##0_-'
        ]
    ];

    // Apply Styles
    $sheet->getStyle('A1:A3')->applyFromArray($headerStyle);
    $sheet->getStyle('A5')->applyFromArray($headerStyle);
    $sheet->getStyle('A11')->applyFromArray($headerStyle);
    $sheet->getStyle('B13:E13')->applyFromArray($subHeaderStyle);
    $sheet->getStyle('C7:C8')->applyFromArray($currencyStyle);
    $sheet->getStyle('C14:C' . ($row-1))->applyFromArray($currencyStyle);
    $sheet->getStyle('E14:E' . ($row-1))->applyFromArray($currencyStyle);

    // Set Column Widths
    $sheet->getColumnDimension('B')->setWidth(30);
    $sheet->getColumnDimension('C')->setWidth(20);
    $sheet->getColumnDimension('D')->setWidth(20);
    $sheet->getColumnDimension('E')->setWidth(15);

    // Add Borders
    $sheet->getStyle('B13:E' . ($row-1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

    // Create response
    $writer = new Xlsx($spreadsheet);
    $filename = 'luminus_financial_report_' . now()->format('Y_m_d') . '.xlsx';
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    
    $writer->save('php://output');
    exit;
}


public function reports()
{
    $years = range(now()->year, now()->year - 2);
    $months = array_map(function($m) {
        return ['value' => $m, 'label' => date('F', mktime(0, 0, 0, $m, 1))];
    }, range(1, 12));
    
    return view('admin.reports', compact('years', 'months'));
}

public function generateReport(Request $request)
{
    $request->validate([
        'report_type' => 'required|in:financial,enrollment,course,instructor',
        'format' => 'required|in:pdf,excel',
        'period' => 'required|in:monthly,yearly,custom',
        'year' => 'required|integer',
        'month' => 'required_if:period,monthly|integer|min:1|max:12',
    ]);

    switch($request->report_type) {
        case 'financial':
            return $this->generateFinancialReport($request);
        case 'enrollment':
            return $this->generateEnrollmentReport($request);
        case 'course':
            return $this->generateCourseReport($request);
        case 'instructor':
            return $this->generateInstructorReport($request);
    }
}

public function forumReports()
{
    $reports = Report::with('user', 'thread')->latest()->get();
    return view('admin.forum-reports', compact('reports'));
}


public function listCourses(Request $request)
{
    $query = Course::query();

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('title', 'LIKE', "%{$search}%");
    }

    if ($request->has('filter')) {
        $filter = $request->input('filter');
        switch ($filter) {
            case 'termurah':
                $query->orderBy('discounted_price', 'asc')
                      ->orderBy('original_price', 'asc');
                break;
            case 'terpopuler':
                $query->withCount('transactions')
                      ->orderBy('transactions_count', 'desc');
                break;
            default:
                $query->latest();
        }
    } else {
        $query->latest();
    }

    $recommendations = Course::inRandomOrder()->limit(3)->pluck('title')->toArray();
    
    // Change pagination limit from 8 to 6
    $courses = $query->paginate(6)->withQueryString();
    
    return view('coursesPage.index', compact('courses', 'recommendations'));
}

}