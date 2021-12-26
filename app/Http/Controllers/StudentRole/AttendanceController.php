<?php

namespace App\Http\Controllers\StudentRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Models\StudentAttendances;

class AttendanceController extends Controller
{
    public function showAttendance()
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->get();
        $id = $studentInfo[0]->id;

        $semesters = DB::table('student_attendances')
            ->where('student_id', '=', $id)
            ->join('semesters', 'semesters.id', '=', 'student_attendances.semester_id')
            ->select('semesters.*')
            ->distinct()
            ->get();
        return view('RoleStudent.student_attendance_view', [
            'title' => 'Thông tin điểm danh',
            'semesters' => $semesters,
        ]);
    }

    public function getAttendance(Request $request)
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->get();
        $student_id = $studentInfo[0]->id;
        $course = $request->course_id;
        $semester = $request->semester_id;
        $datas = StudentAttendances::with('student', 'course', 'classes', 'semester')
            ->where('semester_id', '=', $semester)
            ->where('course_id', '=', $course)
            ->where('student_id', '=', $student_id)
            ->orderBy('date', 'asc')
            ->paginate(10);

        return view('RoleStudent.student_attendance_view_details', [
            'title' => 'Thông tin điểm danh',
            'datas' => $datas
        ]);
    }

    public function getCourse(Request $request)
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->get();

        $semester_id = $request->semester_id;
        $datas = DB::table('student_attendances')
            ->where('semester_id', '=', $semester_id)
            ->join('courses', 'courses.id', '=', 'student_attendances.course_id')
            ->select(
                'courses.*',
            )
            ->distinct()
            ->orderBy('course_name', 'asc')
            ->get();
        return response()->json($datas);
    }
}
