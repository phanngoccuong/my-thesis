<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use App\Models\Classes;
use App\Models\Course;
use App\Models\Semester;
use App\Models\TeacherComment;
use Brian2694\Toastr\Facades\Toastr;

class CourseCommentController extends Controller
{
    public function search()
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

        return view('RoleTeacher.course_comment.search_form', [
            'title' => 'Nhập nhận xét',
            'semesters' => $semesters,
        ]);
    }
    public function create(Request $request)
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
            ->orderBy('name', 'asc')
            ->get();
        $semester = Semester::where('id', $semester_id)->first();
        $class = Classes::where('id', $class_id)->first();
        $course = Course::where('id', $course_id)->first();
        return view('RoleTeacher.course_comment.comment_add', [
            'title' => 'Nhập nhận xét',
            'data' => $data,
            'course' => $course,
            'class' => $class,
            'semester' => $semester
        ]);
    }
    public function store(Request $request)
    {
        $student =
            TeacherComment::where('semester_id',  $request->semester_id)
            ->where('class_id',  $request->class_id)
            ->where('course_id',  $request->course_id)
            ->where('student_id', $request->student_id)
            ->first();
        if ($student) {
            Toastr::error('Học sinh đã có nhận xét!!', 'Failed');
            return redirect()->back();
        }
        try {
            $studentRequest = $request->student_id;
            if ($studentRequest) {
                for ($i = 0; $i < count($request->student_id); $i++) {
                    $comments = new TeacherComment();
                    $comments->student_id = $request->student_id[$i];
                    $comments->class_id = $request->class_id;
                    $comments->course_id = $request->course_id;
                    $comments->semester_id = $request->semester_id;
                    $comments->comment = $request->comment[$i];
                    $comments->save();
                }
                Toastr::success('Nhập nhận xét thành công!!', 'Success');
                return redirect()->back();
            }
        } catch (
            \Exception
            $err
        ) {
            Toastr::error('Nhập nhận xét thất bại!!', 'Failed');
            return redirect()->back();
        }
    }
    public function show()
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

        return view('RoleTeacher.course_comment.comment_show_search', [
            'title' => 'Nhận xét môn học',
            'semesters' => $semesters,
        ]);
    }
    public function edit(Request $request)
    {
        $class_id = $request->class_id;
        $course_id = $request->course_id;
        $semester_id = $request->semester_id;
        $semester = Semester::where('id', $semester_id)->first();
        $class = Classes::where('id', $class_id)->first();
        $course = Course::where('id', $course_id)->first();
        $data = TeacherComment::with('student')
            ->where('class_id', '=', $class_id)
            ->where('semester_id', '=', $semester_id)
            ->where('course_id', '=', $course_id)
            ->get();
        return view('RoleTeacher.course_comment.comment_show_list', [
            'title' => 'Nhận xét môn học',
            'data' => $data,
            'semester' => $semester,
            'course' => $course,
            'class' => $class
        ]);
    }
    public function update(Request $request)
    {
        $studentRequest = $request->student_id;
        TeacherComment::where('semester_id', '=', $request->semester_id)
            ->where('class_id', '=', $request->class_id)
            ->where('course_id', '=', $request->course_id)
            ->delete();

        if ($studentRequest) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $comments = new TeacherComment();
                $comments->student_id = $request->student_id[$i];
                $comments->class_id = $request->class_id;
                $comments->course_id = $request->course_id;
                $comments->semester_id = $request->semester_id;
                $comments->comment = $request->comment[$i];
                $comments->save();
            }
            Toastr::success('Sửa nhận xét thành công!!', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Sửa nhận xét thất bại!!', 'Failed');
            return redirect()->back();
        }
    }
}