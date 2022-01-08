<?php

namespace App\Http\Controllers\StudentRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Services\TimetableService;
use App\Models\Day;


class TimetableController extends Controller
{
    public function searchTimetable()
    {
        $currentUserEmail = Auth::user()->email;
        $semesters = Student::where('email', '=', $currentUserEmail)
            ->join('promotions', 'promotions.student_id', '=', 'students.id')
            ->join('semesters', 'semesters.session_id', '=', 'promotions.session_id')
            ->select('semesters.*')
            ->distinct()
            ->get();

        return view('RoleStudent.student_timetable_search', [
            'title' => 'Thời khóa biểu',
            'semesters' => $semesters
        ]);
    }

    public function showTimetable(Request $request, TimetableService $timetableService)
    {
        $days = Day::all();
        $currentUserEmail = Auth::user()->email;

        $semester_id = $request->semester_id;
        $class = DB::table('students')->where('email', '=', $currentUserEmail)
            ->join('promotions', 'promotions.student_id', '=', 'students.id')
            ->join('semesters', 'semesters.session_id', '=', 'promotions.session_id')
            ->where('semesters.id', '=', $semester_id)
            ->select('promotions.class_id', 'semesters.semester_name')
            ->first();

        $timetableData = $timetableService->generateTimetable($days, $class, $semester_id);

        return view('RoleStudent.student_timetable', [
            'title' => 'Thời khóa biểu',
            'days' => $days,
            'class' => $class,
            'timetableData' => $timetableData
        ]);
    }


    public function timetableDetails(Request $request)
    {
        $currentUserEmail = Auth::user()->email;

        $semester_id = $request->semester_id;
        $class = DB::table('students')->where('email', '=', $currentUserEmail)
            ->join('promotions', 'promotions.student_id', '=', 'students.id')
            ->join('semesters', 'semesters.session_id', '=', 'promotions.session_id')
            ->where('semesters.id', '=', $semester_id)
            ->select('promotions.class_id')
            ->first();
        $data = DB::table('lessons')
            ->where('semester_id', '=', $semester_id)
            ->where('class_id', '=', $class->class_id)
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->join('times', 'times.id', '=', 'lessons.time_id')
            ->join('days', 'days.id', '=', 'lessons.day_id')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->join('classrooms', 'classrooms.id', '=', 'lessons.classroom_id')
            ->select(
                'courses.course_name',
                'days.day_name',
                'times.time',
                'classrooms.classroom_name',
                'teachers.teacher_name'
            )
            ->orderBy('day_name', 'asc')->get();

        return response()->json($data);
    }

    public function timetableDetailsIndex()
    {

        $currentUserEmail = Auth::user()->email;
        $semesters = Student::where('email', '=', $currentUserEmail)
            ->join('promotions', 'promotions.student_id', '=', 'students.id')
            ->join('semesters', 'semesters.session_id', '=', 'promotions.session_id')
            ->select('semesters.*')
            ->distinct()
            ->get();
        return view('RoleStudent.timetable-details', [
            'title' => 'Thời khóa biểu chi tiết',
            'semesters' => $semesters
        ]);
    }
}
