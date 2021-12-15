<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentMarks;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class MarkController extends Controller
{
    public function search(Request $request)
    {
        $class_id = $request->class_id;
        $datas = Student::where('class_id', '=', $class_id)->get();
        return response()->json($datas);
    }

    public function getClass(Request $request)
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->get();
        $teacher_id = $info[0]->id;
        $semester_id = $request->semester_id;
        $datas =
            DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->join('semesters', 'semesters.id', '=', 'lessons.semester_id')
            ->where('semesters.id', '=', $semester_id)
            ->join('classes', 'classes.id', '=', 'lessons.class_id')
            ->select(
                'classes.*',
            )
            ->distinct()
            ->orderBy('class_name', 'asc')
            ->get();
        return response()->json($datas);
    }

    public function getCourse(Request $request)
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->get();
        $teacher_id = $info[0]->id;
        $class_id = $request->class_id;
        $datas =
            DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->join('classes', 'classes.id', '=', 'lessons.class_id')
            ->where('classes.id', '=', $class_id)
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->select(
                'courses.*',
            )
            ->distinct()
            ->orderBy('course_name', 'asc')
            ->get();
        return response()->json($datas);
    }

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

        return view('RoleTeacher.mark_add', [
            'title' => 'Nhập điểm học sinh',
            'semesters' => $semesters,
        ]);
    }

    protected function isValidMark(Request $request)
    {
        $studentMark = DB::table('student_marks')->get();
        for ($i = 0; $i < count($request->student_id); $i++) {
            if (
                $request->student_id[$i] == $studentMark[$i]->student_id
                && $request->semester_id == $studentMark[$i]->semester_id
            ) {
                Toastr::error('HSinh da co diem', 'Error');
                return false;
            }
            return true;
        }
    }

    public function store(Request $request)
    {
        $studentRequest = $request->student_id;

        if ($studentRequest) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $marks = new StudentMarks();
                $marks->student_id = $request->student_id[$i];
                $marks->class_id = $request->class_id;
                $marks->course_id = $request->course_id;
                $marks->semester_id = $request->semester_id;
                $marks->half_mark = $request->half_mark[$i];
                $marks->final_mark = $request->final_mark[$i];
                $marks->save();
            }
            Toastr::success('Nhập điểm thành công!!', 'Success');
            return redirect()->route('mark.edit');
        }
    }

    public function edit()
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

        return view('RoleTeacher.mark_edit', [
            'title' => 'Xem điểm học sinh',
            'semesters' => $semesters,
        ]);
    }

    public function getEditList(Request $request)
    {
        $class_id = $request->class_id;
        $course_id = $request->course_id;

        $data = StudentMarks::with('student')
            ->where('class_id', '=', $class_id)
            ->where('course_id', '=', $course_id)
            ->get();
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $studentRequest = $request->student_id;
        StudentMarks::where('semester_id', '=', $request->semester_id)
            ->where('class_id', '=', $request->class_id)
            ->where('course_id', '=', $request->course_id)
            ->delete();

        if ($studentRequest) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $marks = new StudentMarks();
                $marks->student_id = $request->student_id[$i];
                $marks->class_id = $request->class_id;
                $marks->course_id = $request->course_id;
                $marks->semester_id = $request->semester_id;
                $marks->half_mark = $request->half_mark[$i];
                $marks->final_mark = $request->final_mark[$i];
                $marks->save();
            }
            Toastr::success('Sửa điểm thành công!!', 'Success');
            return redirect()->back();
        }
    }
}
