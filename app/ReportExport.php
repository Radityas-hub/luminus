<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ReportExport implements WithMultipleSheets
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function sheets(): array
    {
        return [
            new CoursesSheet($this->data['courses']),
            new StudentsSheet($this->data['students']),
            new InstructorsSheet($this->data['instructors']),
            new TransactionsSheet($this->data['transactions']),
        ];
    }
}