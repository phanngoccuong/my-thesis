<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = DB::table('semesters')
            ->orderBy('semester_name', 'asc')
            ->paginate(10);
        return view('semester.semester_all',  [
            'title' => 'Quản lý học kì',
            'semesters' => $semesters
        ]);
    }

    public function create()
    {
        return view('semester.semester_add', [
            'title' => 'Thêm học kì'
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'semester_name' => 'required|string|max:255',
        ]);
        $semesters = new Semester;
        $semesters->semester_name = $request->semester_name;
        $semesters->save();

        Toastr::success('Thêm học kì thành công!!', 'Success');
        return redirect()->route('semester/list');
    }

    public function edit($id)
    {
        $semesters = DB::table('semesters')->where('id', $id)->get();

        return view('semester.semester_edit',  [
            'title' => 'Chỉnh sửa kì học',
            'semesters' => $semesters
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $semester_name = $request->semester_name;


        $update = [
            'id' => $id,
            'semester_name' => $semester_name,
        ];
        Semester::where('id', $request->id)->update($update);
        Toastr::success('Cập nhật học kì thành công!!', 'Success');
        return redirect()->route('semester/list');
    }

    public function delete($id)
    {
        $delete = Semester::find($id);
        $delete->delete();
        Toastr::success('Xóa học kì thành công!!', 'Success');
        return redirect()->route('semester/list');
    }
}
