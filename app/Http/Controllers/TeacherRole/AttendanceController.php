<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use App\Models\StudentAttendances;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class AttendanceController extends Controller
{
    public function create()
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->get();
        $teacher_id = $info[0]->id;

        $semesters = DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->join('semesters', 'semesters.id', '=', 'lessons.semester_id')
            ->select('semesters.*')
            ->distinct()
            ->get();

        return view('RoleTeacher.attendance_view', [
            'title' => 'Điểm danh',
            'semesters' => $semesters,
        ]);
    }

    public function store(Request $request)
    {
        $studentRequest = $request->student_id;

        if ($studentRequest) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $marks = new StudentAttendances();
                $marks->student_id = $request->student_id[$i];
                $marks->class_id = $request->class_id;
                $marks->course_id = $request->course_id;
                $marks->semester_id = $request->semester_id;
                $marks->date = $request->date;
                $marks->status = $request->status[$i];
                $marks->save();
            }
            Toastr::success('Điểm  danh thành công!!', 'Success');
            return redirect()->back();
        }
    }

    public function show()
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->get();
        $teacher_id = $info[0]->id;

        $semesters = DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->join('semesters', 'semesters.id', '=', 'lessons.semester_id')
            ->select('semesters.*')
            ->distinct()
            ->get();

        return view('RoleTeacher.attendance_edit', [
            'title' => 'Điểm danh',
            'semesters' => $semesters,
        ]);
    }

    public function getDate(Request $request)
    {
        $class_id = $request->class_id;
        $course_id = $request->course_id;
        $semester_id = $request->semester_id;
        $data = StudentAttendances::where('class_id', '=', $class_id)
            ->where('semester_id', '=', $semester_id)
            ->where('course_id', '=', $course_id)
            ->select('date')
            ->distinct()
            ->get();
        return response()->json($data);
    }

    public function getAtten(Request $request)
    {
        $class = $request->class_id;
        $course = $request->course_id;
        $semester = $request->semester_id;
        $date = $request->date;
        $datas = StudentAttendances::with('student', 'course', 'classes', 'semester')
            ->where('class_id', '=', $class)
            ->where('semester_id', '=', $semester)
            ->where('course_id', '=', $course)
            ->where('date', '=', $date)
            ->orderBy('id', 'asc')
            ->get();

        return view('RoleTeacher.attendance_details', [
            'title' => 'Điểm danh',
            'datas' => $datas
        ]);
    }
}
