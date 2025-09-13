<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Course;
use App\Models\User;
use App\Models\RecentReport;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\File;

class ReportController extends Controller
{
    public function generateReport(Request $request)
    {
        $request->validate([
            'report_type' => 'required|in:financial,enrollment,course,instructor',
            'format' => 'required|in:pdf,excel',
            'period' => 'required|in:monthly,yearly,custom',
            'year' => 'required|integer',
            'month' => 'required_if:period,monthly|integer|min:1|max:12',
        ]);

        switch ($request->report_type) {
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

    // Laporan Keuangan
    public function generateFinancialReport(Request $request)
    {
        $year = $request->year;
        $month = $request->month;

        $transactions = Transaction::with(['course', 'user'])
            ->whereYear('date', $year)
            ->when($request->period == 'monthly', function ($query) use ($month) {
                return $query->whereMonth('date', $month);
            })
            ->orderBy('date', 'desc')
            ->get();

        if ($request->format == 'excel') {
            return $this->generateExcelReport($transactions, 'Financial_Report');
        } else {
            return $this->generatePdfReport($transactions, 'Financial_Report');
        }
    }

    // Laporan Pendaftaran
    public function generateEnrollmentReport(Request $request)
    {
        $year = $request->year;
        $month = $request->month;

        $users = User::whereYear('created_at', $year)
            ->when($request->period == 'monthly', function ($query) use ($month) {
                return $query->whereMonth('created_at', $month);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        if ($request->format == 'excel') {
            return $this->generateExcelReport($users, 'Enrollment_Report');
        } else {
            return $this->generatePdfReport($users, 'Enrollment_Report');
        }
    }

    // Laporan Analisis Kursus
    public function generateCourseReport(Request $request)
    {
        $courses = Course::withCount('students')
            ->with('instructor')
            ->orderBy('students_count', 'desc')
            ->get();

        if ($request->format == 'excel') {
            return $this->generateExcelReport($courses, 'Course_Analytics');
        } else {
            return $this->generatePdfReport($courses, 'Course_Analytics');
        }
    }

    // Laporan Kinerja Instruktur
    public function generateInstructorReport(Request $request)
    {
        $instructors = User::whereHas('courses')
            ->with(['courses' => function ($query) {
                $query->withCount('enrollments');
            }])
            ->get();

        if ($request->format == 'excel') {
            return $this->generateExcelReport($instructors, 'Instructor_Performance');
        } else {
            return $this->generatePdfReport($instructors, 'Instructor_Performance');
        }
    }

    private function generateExcelReport($data, $reportTitle)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Set properti dokumen
        $spreadsheet->getProperties()
            ->setCreator("Luminus")
            ->setTitle($reportTitle)
            ->setSubject($reportTitle)
            ->setDescription("Generated $reportTitle for Luminus.");
    
        // Tambahkan header dan data sesuai tipe laporan
        switch ($reportTitle) {
            case 'Financial_Report':
                $sheet->setCellValue('A1', 'Date');
                $sheet->setCellValue('B1', 'Course');
                $sheet->setCellValue('C1', 'Student');
                $sheet->setCellValue('D1', 'Amount');
                $sheet->setCellValue('E1', 'Description');
    
                $row = 2;
                foreach ($data as $transaction) {
                    $sheet->setCellValue('A' . $row, $transaction->date->format('Y-m-d'));
                    $sheet->setCellValue('B' . $row, $transaction->course->title);
                    $sheet->setCellValue('C' . $row, $transaction->user->name);
                    $sheet->setCellValue('D' . $row, $transaction->amount);
                    $sheet->setCellValue('E' . $row, $transaction->description);
                    $row++;
                }
    
                // Add chart
                $this->addChart($sheet, 'Financial Report', 'A1:E' . ($row - 1));
                break;
    
            case 'Enrollment_Report':
                $sheet->setCellValue('A1', 'Registration Date');
                $sheet->setCellValue('B1', 'Name');
                $sheet->setCellValue('C1', 'Email');
    
                $row = 2;
                foreach ($data as $user) {
                    $sheet->setCellValue('A' . $row, $user->created_at->format('Y-m-d'));
                    $sheet->setCellValue('B' . $row, $user->name);
                    $sheet->setCellValue('C' . $row, $user->email);
                    $row++;
                }
    
                // Add chart
                $this->addChart($sheet, 'Enrollment Report', 'A1:C' . ($row - 1));
                break;
    
            case 'Course_Analytics':
                $sheet->setCellValue('A1', 'Course Title');
                $sheet->setCellValue('B1', 'Instructor');
                $sheet->setCellValue('C1', 'Enrollments');
    
                $row = 2;
                foreach ($data as $course) {
                    $sheet->setCellValue('A' . $row, $course->title);
                    $sheet->setCellValue('B' . $row, $course->instructor->name);
                    $sheet->setCellValue('C' . $row, $course->students_count);
                    $row++;
                }
    
                // Add chart
                $this->addChart($sheet, 'Course Analytics', 'A1:C' . ($row - 1));
                break;
    
            case 'Instructor_Performance':
                $sheet->setCellValue('A1', 'Instructor');
                $sheet->setCellValue('B1', 'Courses');
                $sheet->setCellValue('C1', 'Total Enrollments');
    
                $row = 2;
                foreach ($data as $instructor) {
                    $totalEnrollments = $instructor->courses->sum('enrollments_count');
                    $sheet->setCellValue('A' . $row, $instructor->name);
                    $sheet->setCellValue('B' . $row, $instructor->courses->count());
                    $sheet->setCellValue('C' . $row, $totalEnrollments);
                    $row++;
                }
    
                // Add chart
                $this->addChart($sheet, 'Instructor Performance', 'A1:C' . ($row - 1));
                break;
        }
    
        // Set lebar kolom
        foreach (range('A', $sheet->getHighestColumn()) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    
        // Ensure the reports directory exists
        $reportsDirectory = storage_path('app/reports');
        if (!File::exists($reportsDirectory)) {
            File::makeDirectory($reportsDirectory, 0755, true);
        }
    
        // Simpan ke file
        $fileName = $reportTitle . '_' . now()->format('Y_m_d_H_i_s') . '.xlsx';
        $filePath = $reportsDirectory . '/' . $fileName;
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);
    
        // Save report details to database
        RecentReport::create([
            'report_name' => $fileName,
            'report_type' => $reportTitle,
            'format' => 'excel',
            'generated_at' => now(),
        ]);
    
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
    
    private function generatePdfReport($data, $reportTitle)
    {
        $viewName = 'admin.reports.pdf_' . strtolower($reportTitle);
        $html = view($viewName, compact('data'))->render();
    
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
    
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
    
        // Ensure the reports directory exists
        $reportsDirectory = storage_path('app/reports');
        if (!File::exists($reportsDirectory)) {
            File::makeDirectory($reportsDirectory, 0755, true);
        }
    
        // Simpan ke file
        $fileName = $reportTitle . '_' . now()->format('Y_m_d_H_i_s') . '.pdf';
        $filePath = $reportsDirectory . '/' . $fileName;
        file_put_contents($filePath, $dompdf->output());
    
        // Save report details to database
        RecentReport::create([
            'report_name' => $fileName,
            'report_type' => $reportTitle,
            'format' => 'pdf',
            'generated_at' => now(),
        ]);
    
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
    // Metode untuk menambahkan chart ke Excel
    private function addChart($sheet, $title, $dataRange)
    {
        $dataSeriesLabels = [
            new DataSeriesValues('String', "'$title'!$dataRange", null, 1),
        ];

        $xAxisTickValues = [
            new DataSeriesValues('String', "'$title'!$dataRange", null, 4),
        ];

        $dataSeriesValues = [
            new DataSeriesValues('Number', "'$title'!$dataRange", null, 4),
        ];

        $series = new DataSeries(
            DataSeries::TYPE_BARCHART,
            DataSeries::GROUPING_CLUSTERED,
            range(0, count($dataSeriesValues) - 1),
            $dataSeriesLabels,
            $xAxisTickValues,
            $dataSeriesValues
        );

        $plotArea = new PlotArea(null, [$series]);
        $legend = new Legend(Legend::POSITION_RIGHT, null, false);
        $chartTitle = new Title($title);

        $chart = new Chart(
            $title,
            $chartTitle,
            $legend,
            $plotArea,
            true,
            0,
            null,
            null
        );

        $chart->setTopLeftPosition('G2');
        $chart->setBottomRightPosition('N15');

        $sheet->addChart($chart);
    }

    public function index()
    {
        // Get last 5 years for the dropdown
        $years = range(date('Y'), date('Y')-4);
        
        // Months array for dropdown
        $months = [
            ['value' => 1, 'label' => 'January'],
            ['value' => 2, 'label' => 'February'],
            ['value' => 3, 'label' => 'March'],
            ['value' => 4, 'label' => 'April'],
            ['value' => 5, 'label' => 'May'],
            ['value' => 6, 'label' => 'June'],
            ['value' => 7, 'label' => 'July'],
            ['value' => 8, 'label' => 'August'],
            ['value' => 9, 'label' => 'September'],
            ['value' => 10, 'label' => 'October'],
            ['value' => 11, 'label' => 'November'],
            ['value' => 12, 'label' => 'December']
        ];
    
        $recentReports = RecentReport::orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        return view('admin.reports', compact('recentReports', 'years', 'months'));
    }

    public function getRecentReports()
    {
        $recentReports = RecentReport::orderBy('created_at', 'desc')->take(5)->get();
        return view('admin.reports', compact('recentReports'));
    }

public function downloadReport($id)
{
    try {
        $report = RecentReport::findOrFail($id);
    
        $filePath = storage_path('app/reports/' . $report->report_name);
    
        if (!file_exists($filePath)) {
            throw new \Exception('Report not found.');
        }
    
        return response()->download($filePath);
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
}