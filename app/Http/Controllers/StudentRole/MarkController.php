<?php

namespace App\Http\Controllers\StudentRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\StudentMarks;
use Illuminate\Support\Facades\DB;

class MarkController extends Controller
{
    public function show()
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->get();
        $id = $studentInfo[0]->id;

        $semesters = DB::table('student_marks')
            ->where('student_id', '=', $id)
            ->join('semesters', 'semesters.id', '=', 'student_marks.semester_id')
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
            ->get();
        $studentID = $studentInfo[0]->id;
        $semesterRequest = $request->semester_id;

        $data = StudentMarks::with('course')
            ->where('student_id', '=', $studentID)
            ->where('semester_id', '=', $semesterRequest)
            ->get();

        return response()->json($data);
    }
}
