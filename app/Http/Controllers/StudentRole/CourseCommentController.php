<?php

namespace App\Http\Controllers\StudentRole;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\TeacherComment;

class CourseCommentController extends Controller
{
    public function searchComment()
    {
        $currentUserEmail = Auth::user()->email;
        $semesters = Student::where('email', '=', $currentUserEmail)
            ->join('promotions', 'promotions.student_id', '=', 'students.id')
            ->join('semesters', 'semesters.session_id', '=', 'promotions.session_id')
            ->select('semesters.*')
            ->distinct()
            ->get();

        return view('RoleStudent.comment.search', [
            'title' => 'Nhận xét của giáo viên',
            'semesters' => $semesters,
        ]);
    }
    public function getTeacherComment(Request $request)
    {
        $request->validate([
            'semester_id' => 'required',
        ], [
            'semester_id.required' => 'Học sinh chưa chọn học kì',
        ]);
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->first();
        $studentID = $studentInfo->id;
        $semester_id = $request->semester_id;
        $semester = Semester::where('id', $semester_id)->first();
        $data = TeacherComment::with('course')
            ->where('student_id', '=', $studentID)
            ->where('semester_id', '=', $semester_id)
            ->get();

        return view('RoleStudent.comment.details', [
            'title' => 'Nhận xét của giáo viên',
            'data' => $data,
            'semester' => $semester
        ]);
    }
}
