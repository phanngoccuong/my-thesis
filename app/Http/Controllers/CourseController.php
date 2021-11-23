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
        $courses = DB::table('courses')->get();
        return view('course.course_all', compact('courses'), [
            'title' => 'Course Dashboard'
        ]);
    }

    public function create()
    {
        return view('course.course_add', [
            'title' => 'Course Add'
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
        ]);
        $courses = new Course;
        $courses->course_name = $request->course_name;
        $courses->status = $request->status;
        $courses->save();

        Toastr::success('Course add successfully!!', 'Success');
        return redirect()->route('course/list');
    }

    public function edit($id)
    {
        $courses = DB::table('courses')->where('id', $id)->get();
        // $courseStatus = DB::table('course_types')->get();
        return view('course.course_edit', compact('courses'), [
            'title' => 'Course Edit'
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $course_name = $request->course_name;
        $status = $request->status;

        $update = [
            'id' => $id,
            'course_name' => $course_name,
            'status'  => $status,
        ];
        Course::where('id', $request->id)->update($update);
        Toastr::success('Course updated successfully!!', 'Success');
        return redirect()->route('course/list');
    }

    public function delete($id)
    {
        $delete = Course::find($id);
        $delete->delete();
        Toastr::success('Course deleted successfully!!', 'Success');
        return redirect()->route('course/list');
    }
}
