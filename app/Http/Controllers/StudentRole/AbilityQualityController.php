<?php

namespace App\Http\Controllers\StudentRole;

use App\Http\Controllers\Controller;
use App\Models\AbilityQuality;
use App\Models\AssignTeacher;
use App\Models\Promotion;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\YearSession;
use Illuminate\Support\Facades\DB;

class AbilityQualityController extends Controller
{
    public function index()
    {
        $currentUserEmail = Auth::user()->email;
        $years = DB::table('students')
            ->where('email', '=', $currentUserEmail)
            ->join('promotions', 'promotions.student_id', '=', 'students.id')
            ->join('year_sessions', 'year_sessions.id', '=', 'promotions.session_id')
            ->select('year_sessions.*')
            ->distinct()
            ->get();

        return view('RoleStudent.a-q.search', [
            'title' => 'Năng lực phẩm chất',
            'years' => $years,
        ]);
    }
    public function getAQ(Request $request)
    {
        $request->validate([
            'session_id' => 'required'
        ], [
            'session_id.required' => 'Học sinh chưa chọn năm học'
        ]);
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->first();
        $studentID = $studentInfo->id;
        $year_id = $request->session_id;
        $year = YearSession::findOrFail($year_id);
        $class = Promotion::with('classes')
            ->where('student_id', $studentID)->where('session_id', $year->id)->first();
        $teacher = AssignTeacher::with('teacher')
            ->where('class_id', $class->class_id)->where('session_id', $year->id)->first();
        $data = AbilityQuality::where('student_id', '=', $studentID)
            ->where('session_id', '=', $year_id)
            ->first();

        return view('RoleStudent.a-q.details', [
            'title' => 'Năng lực phẩm chất',
            'year' => $year,
            'data' => $data,
            'class' => $class,
            'teacher' => $teacher
        ]);
    }
}
