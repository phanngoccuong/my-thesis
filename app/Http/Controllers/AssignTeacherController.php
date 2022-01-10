<?php

namespace App\Http\Controllers;

use App\Models\AssignTeacher;
use App\Models\Classes;
use App\Models\Teacher;
use App\Models\YearSession;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

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
        $class_request = $request->class_id;
        if ($class_request) {
            for ($i = 0; $i < count($request->class_id); $i++) {
                $assign = new AssignTeacher();
                $assign->class_id = $request->class_id[$i];
                $assign->session_id = $request->session_id;
                $assign->teacher_id = $request->teacher_id[$i];
                $assign->save();
            }
            Toastr::success('Thêm giáo viên chủ nhiệm thành công!!', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Thêm giáo viên chủ nhiệm thất bại!!', 'Failed');
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
        $session_id = $request->session_id;
        $year = YearSession::where('id', $session_id)->first();
        $data = AssignTeacher::with('class', 'teacher', 'year')->where('session_id', $session_id)->get();
        $teachers = Teacher::orderBy('teacher_name', 'asc')->get();
        return view('teacher.assign_list_full', [
            'title' => 'Danh sách giáo viên chủ nhiệm',
            'data' => $data,
            'teachers' => $teachers,
            'year' => $year
        ]);
    }
}
