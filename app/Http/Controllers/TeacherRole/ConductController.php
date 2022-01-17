<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\AssignTeacher;
use App\Models\Semester;
use App\Models\Classes;
use App\Models\Conduct;
use App\Models\Promotion;
use App\Models\YearSession;
use Brian2694\Toastr\Facades\Toastr;

class ConductController extends Controller
{
    public function allClass()
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->first();
        $teacher_id = $info->id;
        $datas = AssignTeacher::with('year')->where('teacher_id', $teacher_id)->orderBy('session_id', 'desc')->get();
        return view('RoleTeacher.conduct.form_class_list', [
            'title' => 'Sổ hạnh kiểm',
            'datas' => $datas
        ]);
    }
    public function getStudentByClass($class, $year)
    {
        $class = Classes::findOrFail($class);
        $year = YearSession::findOrFail($year);
        $semesters = Semester::where('session_id', $year->id)->get();
        $students = Promotion::with('student')
            ->where('class_id', $class->id)
            ->where('session_id', $year->id)->get();
        return view('RoleTeacher.conduct.conduct_student_add', [
            'title' => 'Sổ hạnh kiểm',
            'students' => $students,
            'class' => $class,
            'year' => $year,
            'semesters' => $semesters
        ]);
    }
    public function store(Request $request)
    {
        $conducts =
            Conduct::where('semester_id',  $request->semester_id)
            ->where('student_id', $request->student_id)
            ->first();
        if ($conducts) {
            Toastr::error('Học sinh đã được hạnh kiểm!!', 'Failed');
            return redirect()->back();
        }
        try {
            $studentRequest = $request->student_id;
            if ($studentRequest) {
                for ($i = 0; $i < count($request->student_id); $i++) {
                    $conducts = new Conduct();
                    $conducts->student_id = $request->student_id[$i];
                    $conducts->class_id = $request->class_id;
                    $conducts->semester_id = $request->semester_id;
                    $conducts->conduct_type = $request->conduct_type[$i];
                    $conducts->save();
                }
                Toastr::success('Nhập hạnh kiểm thành công!!', 'Success');
                return redirect()->route('conduct.teacher.form.class.edit');
            }
        } catch (
            \Exception
            $err
        ) {
            Toastr::error('Nhập hạnh kiểm thất bại!!', 'Failed');
            return redirect()->back();
        }
    }
    public function allClassEdit()
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->first();
        $teacher_id = $info->id;
        $datas = AssignTeacher::with('year')->where('teacher_id', $teacher_id)->orderBy('session_id', 'desc')->get();

        return view('RoleTeacher.conduct.edit_conduct_class_list', [
            'title' => 'Sổ hạnh kiểm',
            'datas' => $datas
        ]);
    }

    public function edit($class, $year)
    {
        $class = Classes::findOrFail($class);
        $year = YearSession::findOrFail($year);
        $semesters = Semester::where('session_id', $year->id)->get();
        $students = Promotion::with('student')
            ->where('class_id', $class->id)
            ->where('session_id', $year->id)->get();
        return view('RoleTeacher.conduct.conduct_search', [
            'title' => 'Sổ hạnh kiểm',
            'students' => $students,
            'class' => $class,
            'year' => $year,
            'semesters' => $semesters
        ]);
    }

    public function show(Request $request)
    {
        $class_id = $request->class_id;
        $semester_id = $request->semester_id;
        $semester = Semester::where('id', $semester_id)->first();
        $class = Classes::where('id', $class_id)->first();
        $students = Conduct::with('student')
            ->where('class_id', '=', $class_id)
            ->where('semester_id', '=', $semester_id)
            ->get();

        return view('RoleTeacher.conduct.conduct_show', [
            'title' => 'Sổ hạnh kiểm',
            'students' => $students,
            'semester' => $semester,
            'class' => $class
        ]);
    }
    public function update(Request $request)
    {
        $studentRequest = $request->student_id;

        Conduct::where('semester_id',  $request->semester_id)
            ->where('class_id', $request->class_id)
            ->delete();

        if ($studentRequest) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $conducts = new Conduct();
                $conducts->student_id = $request->student_id[$i];
                $conducts->class_id = $request->class_id;
                $conducts->semester_id = $request->semester_id;
                $conducts->conduct_type = $request->conduct_type[$i];
                $conducts->save();
            }
            Toastr::success('Nhập hạnh kiểm thành công!!', 'Success');
            return redirect()->route('conduct.teacher.form.class.edit');
        } else {
            Toastr::error('Sửa điểm thất bại!!', 'Failed');
            return redirect()->back();
        }
    }
}
