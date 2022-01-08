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
            'group_id' => 'required|integer',
            'is_point' => 'required|integer'
        ]);
        $courses = new Course;
        $courses->course_name = $request->course_name;
        $courses->group_id = $request->group_id;
        $courses->is_point = $request->is_point;
        $courses->save();

        Toastr::success('Thêm môn học thành công!!', 'Success');
        return redirect()->route('course/list');
    }

    public function edit($id)
    {
        $courses = DB::table('courses')->where('id', $id)->first();

        return view('course.course_edit',  [
            'title' => 'Chỉnh sửa môn học',
            'courses' => $courses
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $course_name = $request->course_name;
        $group_id = $request->group_id;
        $is_point = $request->is_point;


        $update = [
            'id' => $id,
            'course_name' => $course_name,
            'group_id' => $group_id,
            'is_point' => $is_point
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
