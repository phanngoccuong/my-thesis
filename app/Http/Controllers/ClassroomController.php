<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class ClassroomController extends Controller
{
    public function index()
    {
        $classroomShow = DB::table('classrooms')->orderBy('classroom_name', 'asc')->paginate(10);
        return view('classroom.classroom_all',  [
            'title' => 'Quản lý phòng học',
            'classroomShow' => $classroomShow
        ]);
    }

    public function create()
    {
        return view('classroom.classroom_add', [
            'title' => 'Thêm phòng học'
        ]);
    }
    public function store(ClassroomRequest $request)
    {
        $classrooms = new Classroom;
        $classrooms->classroom_name = $request->classroom_name;
        $classrooms->save();
        Toastr::success('Thêm phòng học thành công!!', 'Success');
        return redirect()->route('classroom.list');
    }

    public function edit($id)
    {
        $classrooms = Classroom::findOrFail($id);
        return view('classroom.classroom_edit', [
            'title' => 'Chỉnh sửa phòng học',
            'classrooms' => $classrooms
        ]);
    }

    public function update(ClassroomRequest $request)
    {
        $id = $request->id;
        $classroom_name = $request->classroom_name;

        $update = [
            'id' => $id,
            'classroom_name' => $classroom_name
        ];
        Classroom::where('id', $request->id)->update($update);
        Toastr::success('Cập nhật phòng học thành công!!', 'Success');
        return redirect()->route('classroom.list');
    }

    public function delete($id)
    {
        $delete = Classroom::find($id);
        $delete->delete();
        Toastr::success('Xóa phòng học thành công!!', 'Success');
        return redirect()->route('classroom.list');
    }
}
