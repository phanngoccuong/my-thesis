<?php

namespace App\Http\Controllers\StudentRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\StudentMarks;
use Illuminate\Support\Facades\DB;
use App\Models\Semester;

class MarkController extends Controller
{
    public function show()
    {
        $currentUserEmail = Auth::user()->email;
        $semesters = Student::where('email', '=', $currentUserEmail)
            ->join('promotions', 'promotions.student_id', '=', 'students.id')
            ->join('semesters', 'semesters.session_id', '=', 'promotions.session_id')
            ->select('semesters.*')
            ->distinct()
            ->get();

        return view('RoleStudent.student_mark_view', [
            'title' => 'Điểm học sinh',
            'semesters' => $semesters,
        ]);
    }

    public function getMark(Request $request)
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->first();
        $studentID = $studentInfo->id;
        $semester_id = $request->semester_id;
        $semester = Semester::where('id', $semester_id)->first();
        $data = StudentMarks::with('course')
            ->where('student_id', '=', $studentID)
            ->where('semester_id', '=', $semester_id)
            ->get();

        return view('RoleStudent.student_mark_details', [
            'title' => 'Kết quả học tập',
            'data' => $data,
            'semester' => $semester
        ]);
    }
}
