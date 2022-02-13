<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Student;
use App\Models\StudentMarks;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Carbon;

class MarkController extends Controller
{
    public function create()
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

        return view('RoleTeacher.mark.mark_add_search', [
            'title' => 'Nhập điểm học sinh',
            'semesters' => $semesters,
        ]);
    }

    public function getClass(Request $request)
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->first();
        $teacher_id = $info->id;
        $semester_id = $request->semester_id;
        $data =
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
        return response()->json($data);
    }


    public function getCourse(Request $request)
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->first();
        $teacher_id = $info->id;
        $class_id = $request->class_id;
        $semester_id = $request->semester_id;
        $data =
            DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->join('semesters', 'semesters.id', '=', 'lessons.semester_id')
            ->where('semesters.id', '=', $semester_id)
            ->join('classes', 'classes.id', '=', 'lessons.class_id')
            ->where('classes.id', '=', $class_id)
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->select(
                'courses.*',
            )
            ->distinct()
            ->orderBy('course_name', 'asc')
            ->get();
        return response()->json($data);
    }

    public function search(Request $request)
    {
        $course_id = $request->course_id;
        $class_id = $request->class_id;
        $semester_id = $request->semester_id;
        $data = DB::table('students')
            ->join('promotions', 'promotions.student_id', '=', 'students.id')
            ->join('semesters', 'semesters.session_id', '=', 'promotions.session_id')
            ->where('promotions.class_id', '=', $class_id)
            ->where('semesters.id', '=', $semester_id)
            ->select('students.*')
            ->orderBy('first_name', 'asc')
            ->get();
        $semester = Semester::where('id', $semester_id)->first();
        $class = Classes::where('id', $class_id)->first();
        $course = Course::where('id', $course_id)->first();
        return view('RoleTeacher.mark.mark_add', [
            'title' => 'Nhập điểm cho học sinh',
            'data' => $data,
            'course' => $course,
            'class' => $class,
            'semester' => $semester
        ]);
    }


    public function store(Request $request)
    {
        $studentMarks =
            StudentMarks::where('semester_id',  $request->semester_id)
            ->where('class_id',  $request->class_id)
            ->where('course_id',  $request->course_id)
            ->where('student_id', $request->student_id)
            ->first();
        if ($studentMarks) {
            Toastr::error('Học sinh đã được nhập điểm!!', 'Thất bại');
            return redirect()->back();
        }
        DB::beginTransaction();
        try {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $insert = [
                    'student_id' => $request->student_id[$i],
                    'class_id' => $request->class_id,
                    'is_point' => $request->is_point,
                    'course_id' => $request->course_id,
                    'semester_id' => $request->semester_id,
                    'half_mark' => $request->half_mark[$i],
                    'final_mark' => $request->final_mark[$i],
                    'result' => $request->result[$i],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                DB::table('student_marks')->insert($insert);
            }
            DB::commit();
            Toastr::success('Nhập điểm thành công!!', 'Thành công');
            return redirect()->route('mark.edit');
        } catch (
            \Exception
            $err
        ) {
            DB::rollBack();
            Toastr::error('Vui lòng nhập điểm cho tất cả học sinh!!', 'Thất bại');
            return redirect()->back();
        }
    }

    public function edit()
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

        return view('RoleTeacher.mark.mark_edit_search', [
            'title' => 'Sổ điểm học sinh',
            'semesters' => $semesters,
        ]);
    }

    public function getEditList(Request $request)
    {
        $class_id = $request->class_id;
        $course_id = $request->course_id;
        $semester_id = $request->semester_id;
        $semester = Semester::where('id', $semester_id)->first();
        $class = Classes::where('id', $class_id)->first();
        $course = Course::where('id', $course_id)->first();
        $data = StudentMarks::with('student')
            ->where('class_id', '=', $class_id)
            ->where('semester_id', '=', $semester_id)
            ->where('course_id', '=', $course_id)
            ->get();
        return view('RoleTeacher.mark.mark_edit_list', [
            'title' => 'Sổ điểm học sinh',
            'data' => $data,
            'semester' => $semester,
            'course' => $course,
            'class' => $class
        ]);
    }

    public function update(Request $request)
    {
        StudentMarks::where('semester_id', '=', $request->semester_id)
            ->where('class_id', '=', $request->class_id)
            ->where('course_id', '=', $request->course_id)
            ->delete();
        DB::beginTransaction();
        try {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $insert = [
                    'student_id' => $request->student_id[$i],
                    'class_id' => $request->class_id,
                    'is_point' => $request->is_point,
                    'course_id' => $request->course_id,
                    'semester_id' => $request->semester_id,
                    'half_mark' => $request->half_mark[$i],
                    'final_mark' => $request->final_mark[$i],
                    'result' => $request->result[$i],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                DB::table('student_marks')->insert($insert);
            }
            DB::commit();
            Toastr::success('Nhập điểm thành công!!', 'Thành công');
            return redirect()->route('mark.edit');
        } catch (
            \Exception
            $err
        ) {
            DB::rollBack();
            Toastr::error('Vui lòng nhập điểm cho tất cả học sinh!!', 'Thất bại');
            return redirect()->back();
        }
    }
}
