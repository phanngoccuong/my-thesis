<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\Teacher;
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

    public function showClassForm()
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->get();
        $teacher_id = $info[0]->id;
        $className = Classes::join('teachers', 'teachers.id', '=', 'classes.formteacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->select('classes.*')
            ->get();
        $id = $className[0]->id;
        $studentList = Student::where('class_id', '=', $id)->get();
        return view('RoleTeacher.class_list', [
            'title' => 'Class List',
            'className' => $className,
            'studentList' => $studentList
        ]);
    }

    public function showTimetable()
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->get();
        $teacher_id = $info[0]->id;

        $datas = DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->join('times', 'times.id', '=', 'lessons.time_id')
            ->join('days', 'days.id', '=', 'lessons.day_id')
            ->join('classes', 'classes.id', '=', 'lessons.class_id')
            ->join('classrooms', 'classrooms.id', '=', 'lessons.classroom_id')
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
        return view('RoleTeacher.teacher_timetable', [
            'title' => 'Teacher Timetable',
            'datas' => $datas
        ]);
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
