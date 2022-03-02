<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use App\Models\Lesson;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\Semester;



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

        return view('RoleTeacher.timetable.teacher_timetable_search', [
            'title' => 'Thời khóa biểu',
            'semesters' => $semesters,
        ]);
    }

    public function showTimetable(Request $request)
    {
        $request->validate([
            'semester_id' => 'required',
        ], [
            'semester_id.required' => 'Giáo viên vui lòng chọn học kì',
        ]);
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->first();
        $teacher_id = $info->id;

        $semesterRequest = $request->semester_id;
        $semester = Semester::where('id', $semesterRequest)->first();
        $datas = Lesson::with('classes', 'teachers', 'day', 'time', 'course', 'room')
            ->where('teacher_id', $teacher_id)
            ->where('semester_id', $semesterRequest)
            ->orderBy('day_id', 'asc')
            ->get();

        return view('RoleTeacher.timetable.teacher_timetable_details', [
            'title' => 'Thời khóa biểu',
            'datas' => $datas,
            'semester' => $semester
        ]);
    }
}
