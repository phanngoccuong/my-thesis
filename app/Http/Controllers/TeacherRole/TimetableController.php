<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;

class TimetableController extends Controller
{
    public function timetableSearch()
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->first();
        $teacher_id = $info->id;

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
            ->first();
        $teacher_id = $info->id;

        $semesterRequest = $request->semester_id;

        $data = DB::table('lessons')
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
        return response()->json($data);
    }
}
