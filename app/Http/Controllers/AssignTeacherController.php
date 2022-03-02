<?php

namespace App\Http\Controllers;

use App\Models\AssignTeacher;
use App\Models\Classes;
use App\Models\Teacher;
use App\Models\YearSession;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AssignTeacherController extends Controller
{
    public function create()
    {
        $years = YearSession::orderBy('id', 'desc')->get();
        $classes = Classes::orderBy('class_name', 'asc')->get();
        $teachers = Teacher::orderBy('teacher_name', 'asc')->get();
        return view('teacher.assign_teacher_add', [
            'title' => 'Thêm giáo viên chủ nhiệm',
            'years' => $years,
            'classes' => $classes,
            'teachers' => $teachers
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'session_id' => 'required',
            'teacher_id' => 'required|array',
            'teacher_id.*' => 'required|string'
        ]);

        // $class_request = $request->class_id;
        DB::beginTransaction();
        try {
            for ($i = 0; $i < count($request->class_id); $i++) {
                $insert = [
                    'class_id' => $request->class_id[$i],
                    'session_id' => $request->session_id,
                    'teacher_id' => $request->teacher_id[$i],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                DB::table('assign_teachers')->insert($insert);
            }
            DB::commit();
            Toastr::success('Bổ nhiệm thành công!!', 'Thành công');
            return redirect()->back();
        } catch (\Exception $err) {
            DB::rollBack();
            Toastr::error('Vui lòng nhập đầy đủ tất cả các giáo viên chủ nhiệm!!', 'Thất bại');
            return redirect()->back();
        }
    }

    public function index()
    {
        $years = YearSession::orderBy('id', 'desc')->get();
        return view('teacher.assign_list_search', [
            'title' => 'Danh sách giáo viên chủ nhiệm',
            'years' => $years,
        ]);
    }

    public function getFormTeacher(Request $request)
    {
        $request->validate([
            'session_id' => 'required',
        ], [
            'session_id.required' => 'Vui lòng chọn năm học'
        ]);
        $session_id = $request->session_id;
        $year = YearSession::where('id', $session_id)->first();
        $data = AssignTeacher::with('class', 'teacher', 'year')->where('session_id', $session_id)
            ->get();
        $teachers = Teacher::orderBy('teacher_name', 'asc')->get();
        return view('teacher.assign_list_full', [
            'title' => 'Danh sách giáo viên chủ nhiệm',
            'data' => $data,
            'teachers' => $teachers,
            'year' => $year
        ]);
    }
    public function update(Request $request)
    {
        AssignTeacher::where('session_id', '=', $request->session_id)
            ->delete();

        DB::beginTransaction();
        try {
            for ($i = 0; $i < count($request->class_id); $i++) {
                $insert = [
                    'class_id' => $request->class_id[$i],
                    'session_id' => $request->session_id,
                    'teacher_id' => $request->teacher_id[$i],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                DB::table('assign_teachers')->insert($insert);
            }
            DB::commit();
            Toastr::success('Cập nhật thành công!!', 'Thành công');
            return redirect()->back();
        } catch (
            \Exception
            $err
        ) {
            DB::rollBack();
            Toastr::error('Vui lòng nhập đầy đủ tất cả các giáo viên chủ nhiệm!!', 'Thất bại');
            return redirect()->back();
        }
    }
}
