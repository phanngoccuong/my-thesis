<?php

namespace App\Http\Controllers\StudentRole;

use App\Http\Controllers\Controller;

use App\Models\Student;

use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    public function index()
    {
        return view('dashboard.student_dashboard', [
            'title' => 'Student Dashboard'
        ]);
    }

    public function showProfile()
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->with('classes', 'batches')
            ->get();
        //dd($studentInfo);
        return view('RoleStudent.student_profile', [
            'title' => 'Student Profile',
            'studentInfo' => $studentInfo
        ]);
    }

    public function showClassInfo()
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->get();
        $class_id = $studentInfo[0]->class_id;
        $classAllInfo = Student::join('classes', 'students.class_id', '=', 'classes.id')
            ->where('classes.id', '=', $class_id)
            ->select('classes.class_name', 'classes.formteacher_id', 'students.*')
            ->get();
        return view('RoleStudent.student_class', [
            'title' => 'Student Class Info',
            'classAllInfo' => $classAllInfo
        ]);
    }
}
