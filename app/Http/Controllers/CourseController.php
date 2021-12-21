<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        $courses = DB::table('courses')
            ->orderBy('course_name', 'asc')
            ->paginate(10);
        return view('course.course_all', [
            'title' => 'Quản lý môn học',
            'courses' => $courses
        ]);
    }

    public function create()
    {
        return view('course.course_add', [
            'title' => 'Thêm môn học'
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
        ]);
        $courses = new Course;
        $courses->course_name = $request->course_name;
        $courses->save();

        Toastr::success('Thêm môn học thành công!!', 'Success');
        return redirect()->route('course/list');
    }

    public function edit($id)
    {
        $courses = DB::table('courses')->where('id', $id)->get();

        return view('course.course_edit',  [
            'title' => 'Chỉnh sửa môn học',
            'courses' => $courses
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $course_name = $request->course_name;


        $update = [
            'id' => $id,
            'course_name' => $course_name,

        ];
        Course::where('id', $request->id)->update($update);
        Toastr::success('Cập nhật môn học thành công!!', 'Success');
        return redirect()->route('course/list');
    }

    public function delete($id)
    {
        $delete = Course::find($id);
        $delete->delete();
        Toastr::success('Xóa môn học thành công!!', 'Success');
        return redirect()->route('course/list');
    }
}
