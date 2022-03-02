<?php

namespace App\Exports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeacherExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $teachers = DB::table('teachers')
            ->select('teacher_name', 'gender', 'email', 'dateOfBirth', 'mobileNumber', 'address')->get();
        return $teachers;
    }
    public function headings(): array
    {
        return [
            'Họ và tên',
            'Giới tính',
            'Email',
            'Ngày sinh',
            'Số điện thoại',
            'Địa chỉ',
        ];
    }
}
