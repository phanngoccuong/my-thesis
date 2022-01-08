<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Day;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class ClassesController extends Controller
{
    public function index()
    {
        $class1s = Classes::where('group_id', '=', 1)
            ->orderBy('class_name', 'asc')
            ->paginate(10);
        $class2s = Classes::where('group_id', '=', 2)
            ->orderBy('class_name', 'asc')
            ->paginate(10);
        $class3s = Classes::where('group_id', '=', 3)
            ->orderBy('class_name', 'asc')
            ->paginate(10);
        $class4s = Classes::where('group_id', '=', 4)
            ->orderBy('class_name', 'asc')
            ->paginate(10);
        $class5s = Classes::where('group_id', '=', 5)
            ->orderBy('class_name', 'asc')
            ->paginate(10);
        return view('classes.classes_all', [
            'title' => 'Quản lý lớp',
            'class1s' => $class1s,
            'class2s' => $class2s,
            'class3s' => $class3s,
            'class4s' => $class4s,
            'class5s' => $class5s
        ]);
    }

    public function create()
    {
        $teachers = Teacher::all();
        return view('classes.classes_add', [
            'title' => 'Thêm lớp',
            'teachers' => $teachers
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'group_id' => 'required|integer'
        ]);
        $classes = new Classes;
        $classes->class_name = $request->class_name;
        $classes->group_id = $request->group_id;
        $classes->save();

        Toastr::success('Thêm lớp thành công!!', 'Success');
        return redirect()->route('classes/list');
    }

    public function edit($id)
    {

        $classes = DB::table('classes')->where('id', $id)->first();
        return view('classes.classes_edit', [
            'title' => 'Chỉnh sửa lớp',
            'classes' => $classes,
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $class_name = $request->class_name;
        $group_id = $request->group_id;

        $update = [
            'id' => $id,
            'class_name' => $class_name,
            'group_id' => $group_id
        ];
        Classes::where('id', $request->id)->update($update);
        Toastr::success('Cập nhật lớp thành công!!', 'Success');
        return redirect()->route('classes/list');
    }

    public function delete($id)
    {
        $delete = Classes::find($id);
        $delete->delete();
        Toastr::success('Xóa lớp thành công!!', 'Success');
        return redirect()->route('classes/list');
    }

    // public function show($id)
    // {
    //     $classStudents = DB::table('classes')
    //         ->join('students', 'students.class_id', '=', 'classes.id')
    //         ->where('classes.id', '=', $id)
    //         ->select('students.*', 'classes.class_name')
    //         ->orderBy('name', 'asc')
    //         ->paginate(10);
    //     $classes = Classes::with('formTeacher')
    //         ->find($id);
    //     $totalStudent = Student::where('class_id', '=', $id)->count();
    //     $maleTotal =
    //         Student::where('class_id', '=', $id)
    //         ->where('gender', '=', 1)
    //         ->count();
    //     $femaleTotal =
    //         Student::where('class_id', '=', $id)
    //         ->where('gender', '=', 2)
    //         ->count();
    //     return view('classes.classes_about', [
    //         'title' => 'Thông tin lớp',
    //         'classStudents' => $classStudents,
    //         'classes' => $classes,
    //         'totalStudent' => $totalStudent,
    //         'maleTotal' => $maleTotal,
    //         'femaleTotal' => $femaleTotal
    //     ]);
    // }
}
