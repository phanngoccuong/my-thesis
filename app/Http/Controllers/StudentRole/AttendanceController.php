<?php

namespace App\Http\Controllers\StudentRole;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Models\StudentAttendances;
use App\Models\Semester;

class AttendanceController extends Controller
{
    public function showAttendance()
    {
        $currentUserEmail = Auth::user()->email;
        $semesters = Student::where('email', '=', $currentUserEmail)
            ->join('promotions', 'promotions.student_id', '=', 'students.id')
            ->join('semesters', 'semesters.session_id', '=', 'promotions.session_id')
            ->select('semesters.*')
            ->distinct()
            ->get();
        return view('RoleStudent.attendance.student_attendance_view', [
            'title' => 'Thông tin điểm danh',
            'semesters' => $semesters,
        ]);
    }

    public function getAttendance(Request $request)
    {
        $request->validate([
            'semester_id' => 'required',
            'course_id' => 'required'
        ], [
            'semester_id.required' => 'Học sinh chưa chọn học kì',
            'course_id.required' => 'Học sinh chưa chọn môn học'
        ]);
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->first();
        $student_id = $studentInfo->id;
        $course_id = $request->course_id;
        $course = Course::where('id', $course_id)->first();
        $semester_id = $request->semester_id;
        $semester = Semester::where('id', $semester_id)->first();
        $datas = StudentAttendances::with('student', 'course', 'classes', 'semester')
            ->where('semester_id', '=', $semester_id)
            ->where('course_id', '=', $course_id)
            ->where('student_id', '=', $student_id)
            ->orderBy('date', 'asc')->get();

        return view('RoleStudent.attendance.student_attendance_view_details', [
            'title' => 'Thông tin điểm danh',
            'datas' => $datas,
            'semester' => $semester,
            'course' => $course
        ]);
    }

    public function getCourse(Request $request)
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
            ->select('courses.*')
            ->distinct()
            ->get();
        return response()->json($data);
    }
}
