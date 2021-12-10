<?php

namespace App\Http\Controllers\StudentRole;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Day;

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

    public function showTimetable()
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->get();
        $class_id = $studentInfo[0]->class_id;
        $days = Day::all();
        $shift1s = DB::table('classes')
            ->join('lessons', 'lessons.class_id', '=', 'classes.id')
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->join('times', 'times.id', '=', 'lessons.time_id')
            ->where('classes.id', '=', $class_id)
            ->where('times.time', '=', '7h20-8h05')
            ->select('courses.course_name')
            ->get();
        $shift2s = DB::table('classes')
            ->join('lessons', 'lessons.class_id', '=', 'classes.id')
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->join('times', 'times.id', '=', 'lessons.time_id')
            ->where('classes.id', '=', $class_id)
            ->where('times.time', '=', '8h15-9h00')
            ->select('courses.course_name')
            ->get();
        $shift3s = DB::table('classes')
            ->join('lessons', 'lessons.class_id', '=', 'classes.id')
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->join('times', 'times.id', '=', 'lessons.time_id')
            ->where('classes.id', '=', $class_id)
            ->where('times.time', '=', '9h20-10h05')
            ->select('courses.course_name')
            ->get();
        $shift4s = DB::table('classes')
            ->join('lessons', 'lessons.class_id', '=', 'classes.id')
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->join('times', 'times.id', '=', 'lessons.time_id')
            ->where('classes.id', '=', $class_id)
            ->where('times.time', '=', '10h15-11h00')
            ->select('courses.course_name')
            ->get();
        return view('RoleStudent.student_timetable', [
            'title' => 'Student Timetable',
            'days' => $days,
            'shift1s' => $shift1s,
            'shift2s' => $shift2s,
            'shift3s' => $shift3s,
            'shift4s' => $shift4s,
        ]);
    }

    public function timetableDetails()
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->get();
        $class_id = $studentInfo[0]->class_id;
        $datas = DB::table('lessons')
            ->join('classes', 'classes.id', '=', 'lessons.class_id')
            ->where('classes.id', '=', $class_id)
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->join('times', 'times.id', '=', 'lessons.time_id')
            ->join('days', 'days.id', '=', 'lessons.day_id')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->join('classrooms', 'classrooms.id', '=', 'lessons.classroom_id')
            ->select(
                'courses.course_name',
                'classes.class_name',
                'days.day_name',
                'times.time',
                'classrooms.classroom_name',
                'teachers.teacher_name'
            )
            ->orderBy('day_name', 'asc')->get();
        //dd($datas);
        return view('RoleStudent.timetable-details', [
            'title' => 'Timetable Details',
            'datas' => $datas
        ]);
    }
}
