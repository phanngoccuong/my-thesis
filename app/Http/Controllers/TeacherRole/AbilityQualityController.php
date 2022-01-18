<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use App\Models\AbilityQuality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Teacher;
use App\Models\AssignTeacher;
use App\Models\Semester;
use App\Models\Classes;

use App\Models\Promotion;
use App\Models\Student;
use App\Models\YearSession;
use Brian2694\Toastr\Facades\Toastr;
use Svg\Tag\Rect;

class AbilityQualityController extends Controller
{
    // lấy lớp chủ nhiệm
    public function allClass()
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->first();
        $teacher_id = $info->id;
        $datas = AssignTeacher::with('year')->where('teacher_id', $teacher_id)->orderBy('session_id', 'desc')->get();
        return view('RoleTeacher.alility-quality.form_class_list', [
            'title' => 'Sổ năng lực phẩm chất',
            'datas' => $datas
        ]);
    }
    //danh sach hoc sinh lop chu nhiem
    public function classList($class, $year)
    {
        $class = Classes::findOrFail($class);
        $year = YearSession::findOrFail($year);
        $semesters = Semester::where('session_id', $year->id)->get();
        $students = Promotion::with('student')
            ->where('class_id', $class->id)
            ->where('session_id', $year->id)->get();
        return view('RoleTeacher.alility-quality.student_list', [
            'title' => 'Sổ năng lực phẩm chất',
            'students' => $students,
            'class' => $class,
            'year' => $year,
            'semesters' => $semesters
        ]);
    }

    public function add($student, $class, $year)
    {
        $class = Classes::findOrFail($class);
        $year = YearSession::findOrFail($year);
        $student = Student::findOrFail($student);
        $semesters = Semester::where('session_id', $year->id)->get();

        return view('RoleTeacher.alility-quality.a-q_add', [
            'title' => 'Sổ năng lực phẩm chất',
            'class' => $class,
            'year' => $year,
            'student' => $student,
            'semesters' => $semesters
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id'             => 'required|integer',
            'class_id'               => 'required|integer',
            'semester_id'            => 'required|integer',
            'self_management'        => 'required',
            'cooperate'              => 'required',
            'problem_solving'        => 'required',
            'hard_work'              => 'required',
            'self_confident'         => 'required',
            'honesty'                => 'required',
            'united'                 => 'required',
        ]);
        $student =
            AbilityQuality::where('semester_id',  $request->semester_id)
            ->where('class_id',  $request->class_id)
            ->where('student_id', $request->student_id)
            ->first();
        if ($student) {
            Toastr::error('Học sinh đã được nhập!!', 'Failed');
            return redirect()->back();
        }
        try {
            $student = new AbilityQuality;
            $student->student_id             = $request->student_id;
            $student->class_id               = $request->class_id;
            $student->semester_id            = $request->semester_id;
            $student->self_management        = $request->self_management;
            $student->cooperate              = $request->cooperate;
            $student->problem_solving        = $request->problem_solving;
            $student->hard_work              = $request->hard_work;
            $student->self_confident         = $request->self_confident;
            $student->honesty                = $request->honesty;
            $student->united                 = $request->united;
            $student->save();
            Toastr::success('Thêm  thành công!!', 'Success');
            return redirect()->route('a-q.list', ['class' => $request->class_id, 'year' => $request->session_id]);
        } catch (\Exception $e) {
            Toastr::error('Gửi thất bại', 'Failed');
            return redirect()->back();
        }
    }
    public function show($student, $class, $year)
    {
        $class = Classes::findOrFail($class);
        $year = YearSession::findOrFail($year);
        $student = Student::findOrFail($student);
        $semesters = Semester::where('session_id', $year->id)->get();

        return view('RoleTeacher.alility-quality.a-q_show', [
            'title' => 'Sổ năng lực phẩm chất',
            'class' => $class,
            'year' => $year,
            'student' => $student,
            'semesters' => $semesters
        ]);
    }
    public function showDetails(Request $request)
    {
        $student_id = $request->student_id;
        $semester_id = $request->semester_id;
        $class_id = $request->class_id;
        $semester = Semester::where('id', $semester_id)->first();
        $class = Classes::where('id', $class_id)->first();
        $student = Student::where('id', $student_id)->first();
        $data = AbilityQuality::where('class_id', $class_id)
            ->where('semester_id', $semester_id)
            ->where('student_id', $student_id)->first();

        return view('RoleTeacher.alility-quality.a-q_details', [
            'title' => 'Sổ năng lực phẩm chất',
            'class' => $class,
            'student' => $student,
            'semester' => $semester,
            'data' => $data
        ]);
    }
}
