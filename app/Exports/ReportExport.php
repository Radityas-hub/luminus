<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromArray, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return [
            [
                'Total Students' => $this->data['jumlahSiswa'],
                'Total Courses' => $this->data['jumlahKursus'],
                'Total Instructors' => $this->data['jumlahInstruktur'],
                'New Courses This Month' => $this->data['newCoursesThisMonth'],
                'New Students This Month' => $this->data['newStudentsThisMonth'],
                'New Instructors This Month' => $this->data['newInstructorsThisMonth'],
                'Total Course Sales' => $this->data['totalCourseSales'],
                'Monthly Revenue' => $this->data['monthlyRevenue'],
                'Monthly Revenue Percentage' => $this->data['monthlyRevenuePercentage'],
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'Total Students',
            'Total Courses',
            'Total Instructors',
            'New Courses This Month',
            'New Students This Month',
            'New Instructors This Month',
            'Total Course Sales',
            'Monthly Revenue',
            'Monthly Revenue Percentage',
        ];
    }
}