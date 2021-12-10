<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    public function search(Request $request)
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->get();
        $teacher_id = $info[0]->id;
        $classes = DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->join('classes', 'classes.id', '=', 'lessons.class_id')
            ->select(
                'classes.*',
            )
            ->distinct()
            ->orderBy('class_name', 'asc')
            ->get();
        $class_id = $request->class_id;
        $datas = Student::where('class_id', '=', $class_id)->get();
        return response()->json($datas);
    }

    public function getClass(Request $request)
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->get();
        $teacher_id = $info[0]->id;
        $semester_id = $request->semester_id;
        $datas =
            DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->join('semesters', 'semesters.id', '=', 'lessons.semester_id')
            ->where('semesters.id', '=', $semester_id)
            ->join('classes', 'classes.id', '=', 'lessons.class_id')
            ->select(
                'classes.*',
            )
            ->distinct()
            ->orderBy('class_name', 'asc')
            ->get();
        return response()->json($datas);
    }

    public function getCourse(Request $request)
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->get();
        $teacher_id = $info[0]->id;
        $class_id = $request->class_id;
        $datas =
            DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->join('classes', 'classes.id', '=', 'lessons.class_id')
            ->where('classes.id', '=', $class_id)
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->select(
                'courses.*',
            )
            ->distinct()
            ->orderBy('course_name', 'asc')
            ->get();
        return response()->json($datas);
    }

    public function create()
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->get();
        $teacher_id = $info[0]->id;
        $classes = DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->join('classes', 'classes.id', '=', 'lessons.class_id')
            ->select(
                'classes.*',
            )
            ->distinct()
            ->orderBy('class_name', 'asc')
            ->get();
        $semesters = DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->join('semesters', 'semesters.id', '=', 'lessons.semester_id')
            ->select('semesters.*')
            ->distinct()
            ->get();

        return view('RoleTeacher.mark_add', [
            'title' => 'Nhập điểm học sinh',
            'classes' => $classes,
            'semesters' => $semesters,
        ]);
    }
}
