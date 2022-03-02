<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Semester;

class LessonDetailsController extends Controller
{
    public function search()
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

        return view('RoleTeacher.lesson-details.search', [
            'title' => 'Chi tiết bài giảng',
            'semesters' => $semesters,
        ]);
    }
    public function show(Request $request)
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
        $datas = Lesson::with('classes', 'course')
            ->where('teacher_id', $teacher_id)
            ->where('semester_id', $semesterRequest)
            ->select('course_id', 'class_id')
            ->distinct()
            ->get();
        return view('RoleTeacher.lesson-details.search-result', [
            'title' => 'Chi tiết bài giảng',
            'datas' => $datas,
            'semester' => $semester
        ]);
    }
}
