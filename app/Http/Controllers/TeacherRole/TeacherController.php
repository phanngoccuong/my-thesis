<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        return view('dashboard.teacher_dashboard', [
            'title' => 'Teacher Dashboard'
        ]);
    }

    public function showClass()
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->get();
        $teacher_id = $info[0]->id;

        $semesters = DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->join('semesters', 'semesters.id', '=', 'lessons.semester_id')
            ->select('semesters.*')
            ->distinct()
            ->get();

        return view('RoleTeacher.teacher_timetable', [
            'title' => 'Danh Sách Quản lý',
            'semesters' => $semesters,
        ]);
    }

    public function timetableSearch()
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->get();
        $teacher_id = $info[0]->id;

        $semesters = DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->join('semesters', 'semesters.id', '=', 'lessons.semester_id')
            ->select('semesters.*')
            ->distinct()
            ->get();

        return view('RoleTeacher.teacher_timetable', [
            'title' => 'Thời khóa biểu',
            'semesters' => $semesters,
        ]);
    }

    public function showTimetable(Request $request)
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->get();
        $teacher_id = $info[0]->id;

        $semesterRequest = $request->semester_id;

        $datas = DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->join('times', 'times.id', '=', 'lessons.time_id')
            ->join('days', 'days.id', '=', 'lessons.day_id')
            ->join('classes', 'classes.id', '=', 'lessons.class_id')
            ->join('classrooms', 'classrooms.id', '=', 'lessons.classroom_id')
            ->join('semesters', 'semesters.id', '=', 'lessons.semester_id')
            ->where('semesters.id', '=', $semesterRequest)
            ->select(
                'courses.course_name',
                'classes.class_name',
                'days.day_name',
                'times.time',
                'classrooms.classroom_name',
                'teachers.teacher_name'
            )
            ->orderBy('day_name', 'asc')
            ->get();
        return response()->json($datas);
    }



    public function showAll()
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->get();
        $teacher_id = $info[0]->id;
        $classShow = DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->join('classes', 'classes.id', '=', 'lessons.class_id')
            ->select(
                'classes.*',
            )
            ->distinct()
            ->orderBy('class_name', 'asc')
            ->get();
        // dd($classShow);
        return view('RoleTeacher.class_all', [
            'title' => 'Class All',
            'classShow' => $classShow
        ]);
    }

    public function showClassDetail($id)
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->get();
        $teacher_id = $info[0]->id;
        $classStudents = DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->join('students', 'students.class_id', '=', 'lessons.class_id')
            ->where('students.class_id', '=', $id)
            ->select(
                'students.*'
            )
            ->distinct()
            ->orderBy('id', 'asc')
            ->paginate(10);
        //dd($classStudents);
        return view('RoleTeacher.class_student_list', [
            'title' => 'Student List',
            'classStudents' => $classStudents
        ]);
    }
}
