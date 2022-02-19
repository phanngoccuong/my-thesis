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
use App\Models\Student;
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
        $request->validate([
            'course_id' => 'required',
            'class_id' => 'required',
            'semester_id' => 'required',
        ], [
            'class_id.required' => 'Giáo viên vui lòng chọn lớp',
            'semester_id.required' => 'Giáo viên vui lòng chọn học kì',
            'course_id.required' => 'Giáo viên vui lòng chọn môn học',
        ]);
        $course_id = $request->course_id;
        $class_id = $request->class_id;
        $semester_id = $request->semester_id;
        $datas = Student::join('promotions', 'promotions.student_id', '=', 'students.id')
            ->join('semesters', 'semesters.session_id', '=', 'promotions.session_id')
            ->where('promotions.class_id', '=', $class_id)
            ->where('semesters.id', '=', $semester_id)
            ->select('students.*')
            ->orderBy('first_name', 'asc')
            ->get();

        $semester = Semester::where('id', $semester_id)->first();
        $class = Classes::where('id', $class_id)->first();
        $course = Course::where('id', $course_id)->first();
        return view('RoleTeacher.course_comment.comment_add', [
            'title' => 'Nhập nhận xét',
            'datas' => $datas,
            'course' => $course,
            'class' => $class,
            'semester' => $semester
        ]);
    }
}
