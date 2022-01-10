<?php

namespace App\Http\Controllers\StudentRole;

use App\Http\Controllers\Controller;
use App\Models\AssignTeacher;
use App\Models\end_semester_note;
use App\Models\Promotion;
use App\Models\Semester;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class TeacherNoteController extends Controller
{
    public function index()
    {
        $currentUserEmail = Auth::user()->email;
        $semesters = Student::where('email', '=', $currentUserEmail)
            ->join('promotions', 'promotions.student_id', '=', 'students.id')
            ->join('semesters', 'semesters.session_id', '=', 'promotions.session_id')
            ->select('semesters.*')
            ->distinct()
            ->get();
        return view('RoleStudent.note_semester_search', [
            'title' => 'Sổ liên lạc',
            'semesters' => $semesters,
        ]);
    }
    public function getTeacherNote(Request $request)
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->first();
        $studentID = $studentInfo->id;
        $semester_id = $request->semester_id;
        $semester = Semester::where('id', $semester_id)->first();
        $class = Promotion::with('classes')
            ->where('student_id', $studentID)->where('session_id', $semester->session_id)->first();
        $teacher = AssignTeacher::with('teacher')
            ->where('class_id', $class->class_id)->where('session_id', $semester->session_id)->first();
        $data = end_semester_note::where('student_id', '=', $studentID)
            ->where('semester_id', '=', $semester_id)
            ->first();

        return view('RoleStudent.note_show', [
            'title' => 'Sổ liên lạc',
            'semester' => $semester,
            'data' => $data,
            'class' => $class,
            'teacher' => $teacher
        ]);
    }
}
