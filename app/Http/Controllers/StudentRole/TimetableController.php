<?php

namespace App\Http\Controllers\StudentRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Services\TimetableService;
use App\Models\Day;
use App\Models\Lesson;
use App\Models\LessonDocument;
use App\Models\Semester;

class TimetableController extends Controller
{
    // thoi khoa bieu hinh bang
    public function searchTimetable()
    {
        $currentUserEmail = Auth::user()->email;
        $semesters = Student::where('email', '=', $currentUserEmail)
            ->join('promotions', 'promotions.student_id', '=', 'students.id')
            ->join('semesters', 'semesters.session_id', '=', 'promotions.session_id')
            ->select('semesters.*')
            ->distinct()
            ->get();

        return view('RoleStudent.timetable.student_timetable_search', [
            'title' => 'Thời khóa biểu',
            'semesters' => $semesters
        ]);
    }

    public function showTimetable(Request $request, TimetableService $timetableService)
    {
        $request->validate([
            'semester_id' => 'required',
        ], [
            'semester_id.required' => 'Học sinh chưa chọn học kì',
        ]);
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

        return view('RoleStudent.timetable.student_timetable', [
            'title' => 'Thời khóa biểu',
            'days' => $days,
            'class' => $class,
            'timetableData' => $timetableData
        ]);
    }

    // thoi khoa bieu chi tiet

    public function timetableDetailsIndex()
    {
        $currentUserEmail = Auth::user()->email;
        $semesters = Student::where('email', '=', $currentUserEmail)
            ->join('promotions', 'promotions.student_id', '=', 'students.id')
            ->join('semesters', 'semesters.session_id', '=', 'promotions.session_id')
            ->select('semesters.*')
            ->distinct()
            ->get();
        return view('RoleStudent.timetable.timetable-details_search', [
            'title' => 'Thời khóa biểu chi tiết',
            'semesters' => $semesters
        ]);
    }
    public function timetableDetails(Request $request)
    {
        $request->validate([
            'semester_id' => 'required',
        ], [
            'semester_id.required' => 'Học sinh chưa chọn học kì',
        ]);
        $currentUserEmail = Auth::user()->email;

        $semester_id = $request->semester_id;
        $semester = Semester::where('id', $semester_id)->first();
        $class = DB::table('students')->where('email', '=', $currentUserEmail)
            ->join('promotions', 'promotions.student_id', '=', 'students.id')
            ->join('semesters', 'semesters.session_id', '=', 'promotions.session_id')
            ->where('semesters.id', '=', $semester_id)
            ->select('promotions.class_id')
            ->first();

        $datas = Lesson::with('classes', 'teachers', 'day', 'time', 'course', 'room')
            ->where('semester_id', '=', $semester_id)
            ->where('class_id', '=', $class->class_id)
            ->orderBy('day_id', 'asc')
            ->get();
        return view('RoleStudent.timetable.timetable_show', [
            'title' => 'Thời khóa biểu chi tiết',
            'datas' => $datas,
            'semester' => $semester
        ]);
    }
}
