<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use App\Models\AbilityQuality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Teacher;
use App\Models\AssignTeacher;
use App\Models\Semester;
use App\Models\Classes;

use App\Models\Promotion;
use App\Models\Student;
use App\Models\YearSession;
use Brian2694\Toastr\Facades\Toastr;


class AbilityQualityController extends Controller
{
    // lấy lớp chủ nhiệm
    public function allClass()
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->first();
        $teacher_id = $info->id;
        $datas = AssignTeacher::with('year')->where('teacher_id', $teacher_id)->orderBy('session_id', 'desc')->get();
        return view('RoleTeacher.alility-quality.form_class_list', [
            'title' => 'Sổ năng lực phẩm chất',
            'datas' => $datas
        ]);
    }
    //danh sach hoc sinh lop chu nhiem
    public function classList($class, $year)
    {
        $class = Classes::findOrFail($class);
        $year = YearSession::findOrFail($year);
        $semesters = Semester::where('session_id', $year->id)->get();
        $students = Promotion::with('student')
            ->where('class_id', $class->id)
            ->where('session_id', $year->id)->get();
        return view('RoleTeacher.alility-quality.student_list', [
            'title' => 'Sổ năng lực phẩm chất',
            'students' => $students,
            'class' => $class,
            'year' => $year,
            'semesters' => $semesters
        ]);
    }
    // ghi so
    public function add($student, $class, $year)
    {
        $class = Classes::findOrFail($class);
        $year = YearSession::findOrFail($year);
        $student = Student::findOrFail($student);


        return view('RoleTeacher.alility-quality.a-q_add', [
            'title' => 'Sổ năng lực phẩm chất',
            'class' => $class,
            'year' => $year,
            'student' => $student,
        ]);
    }
}
