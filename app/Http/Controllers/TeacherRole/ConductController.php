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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ConductController extends Controller
{
    // lấy lớp chủ nhiệm
    public function getClass()
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
    // Lấy danh sách học sinh
    public function getStudent($class, $year)
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
        $request->validate([
            'semester_id' => 'required',
            'conduct_type' => 'required|array',
        ], [
            'semester_id.required' => 'Giáo viên vui lòng chọn học kì',
            'conduct_type.required' => 'Giáo viên vui lòng nhập hạnh kiểm'
        ]);
        $conducts =
            Conduct::where('semester_id',  $request->semester_id)
            ->where('student_id', $request->student_id)
            ->first();
        if ($conducts) {
            Toastr::error('Học sinh đã được hạnh kiểm!!', 'Failed');
            return redirect()->back();
        }
        DB::beginTransaction();
        try {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $insert =  [
                    'student_id' => $request->student_id[$i],
                    'class_id' => $request->class_id,
                    'semester_id' => $request->semester_id,
                    'conduct_type' => $request->conduct_type[$i],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                DB::table('conducts')->insert($insert);
            }
            DB::commit();
            Toastr::success('Nhập hạnh kiểm thành công!!', 'Thành công');
            return redirect()->route('conduct.teacher.form.class.edit');
        } catch (
            \Exception
            $err
        ) {
            DB::rollBack();
            Toastr::error('Vui lòng nhập hạnh kiểm cho tất cả học sinh!!', 'Thất bại');
            return redirect()->back();
        }
    }
    public function getClassToEdit()
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
        $request->validate([
            'semester_id' => 'required'
        ], [
            'semester_id.required' => 'Vui lòng chọn học kì'
        ]);
        $class_id = $request->class_id;
        $semester_id = $request->semester_id;
        $semester = Semester::where('id', $semester_id)->first();
        $class = Classes::where('id', $class_id)->first();

        $students = Conduct::with('student')
            ->where('semester_id',  $request->semester_id)
            ->where('class_id', $request->class_id)
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

        Conduct::where('semester_id',  $request->semester_id)
            ->where('class_id', $request->class_id)
            ->delete();

        DB::beginTransaction();
        try {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $insert =  [
                    'student_id' => $request->student_id[$i],
                    'class_id' => $request->class_id,
                    'semester_id' => $request->semester_id,
                    'conduct_type' => $request->conduct_type[$i],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                DB::table('conducts')->insert($insert);
            }
            DB::commit();
            Toastr::success('Nhập hạnh kiểm thành công!!', 'Thành công');
            return redirect()->route('conduct.teacher.form.class.edit');
        } catch (
            \Exception
            $err
        ) {
            DB::rollBack();
            Toastr::error('Vui lòng nhập hạnh kiểm cho tất cả học sinh!!', 'Thất bại');
            return redirect()->back();
        }
    }
}
