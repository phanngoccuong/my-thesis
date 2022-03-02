<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class StudentExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $students = DB::table('students')
            ->select(
                'last_name',
                'first_name',
                'email',
                'father_name',
                'mother_name',
                'father_number',
                'mother_number',
                'dateOfBirth',
                'address'
            )->get();
        return $students;
    }
    public function headings(): array
    {
        return [
            'Họ',
            'Tên',
            'Email',
            'Tên bố',
            'Tên mẹ',
            'SĐT Bố',
            'SĐT Mẹ',
            'Ngày sinh',
            'Địa chỉ'
        ];
    }
}
