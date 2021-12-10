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
        $classShow = Classes::with('formTeacher')->get();
        return view('classes.classes_all', [
            'title' => 'Class Dashboard',
            'classShow' => $classShow
        ]);
    }

    public function create()

    {
        $teachers = Teacher::all();
        return view('classes.classes_add', [
            'title' => 'Class Add',
            'teachers' => $teachers
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
        ]);
        $classes = new Classes;
        $classes->class_name = $request->class_name;
        $classes->formteacher_id = $request->formteacher_id;
        $classes->save();

        Toastr::success('Class add successfully!!', 'Success');
        return redirect()->route('classes/list');
    }

    public function edit($id)
    {
        $teachers = Teacher::all();
        $classes = DB::table('classes')->where('id', $id)->get();
        return view('classes.classes_edit', [
            'title' => 'Class Edit',
            'classes' => $classes,
            'teachers' => $teachers
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $class_name = $request->class_name;

        $update = [
            'id' => $id,
            'class_name' => $class_name
        ];
        Classes::where('id', $request->id)->update($update);
        Toastr::success('Class updated successfully', 'Success');
        return redirect()->route('classes/list');
    }

    public function delete($id)
    {
        $delete = Classes::find($id);
        $delete->delete();
        Toastr::success('Class deleted successfully!!', 'Success');
        return redirect()->route('classes/list');
    }

    public function show($id)
    {
        $classStudents = DB::table('classes')
            ->join('students', 'students.class_id', '=', 'classes.id')
            ->where('classes.id', '=', $id)
            ->select('students.*', 'classes.class_name')->get();
        $classes = Classes::with('formTeacher')
            ->find($id);
        $totalStudent = Student::where('class_id', '=', $id)->count();
        $maleTotal =
            Student::where('class_id', '=', $id)
            ->where('gender', '=', 1)
            ->count();
        $femaleTotal =
            Student::where('class_id', '=', $id)
            ->where('gender', '=', 2)
            ->count();
        return view('classes.classes_about', [
            'title' => 'Class Info',
            'classStudents' => $classStudents,
            'classes' => $classes,
            'totalStudent' => $totalStudent,
            'maleTotal' => $maleTotal,
            'femaleTotal' => $femaleTotal
        ]);
    }

    public function showTimetable($id)
    {
        $days = Day::all();
        $shift1s = DB::table('classes')
            ->join('lessons', 'lessons.class_id', '=', 'classes.id')
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->join('times', 'times.id', '=', 'lessons.time_id')
            ->where('classes.id', '=', $id)
            ->where('times.time', '=', '7h20-8h05')
            ->select('courses.course_name')
            ->get();
        $shift2s = DB::table('classes')
            ->join('lessons', 'lessons.class_id', '=', 'classes.id')
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->join('times', 'times.id', '=', 'lessons.time_id')
            ->where('classes.id', '=', $id)
            ->where('times.time', '=', '8h15-9h00')
            ->select('courses.course_name')
            ->get();
        $shift3s = DB::table('classes')
            ->join('lessons', 'lessons.class_id', '=', 'classes.id')
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->join('times', 'times.id', '=', 'lessons.time_id')
            ->where('classes.id', '=', $id)
            ->where('times.time', '=', '9h20-10h05')
            ->select('courses.course_name')
            ->get();
        $shift4s = DB::table('classes')
            ->join('lessons', 'lessons.class_id', '=', 'classes.id')
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->join('times', 'times.id', '=', 'lessons.time_id')
            ->where('classes.id', '=', $id)
            ->where('times.time', '=', '10h15-11h00')
            ->select('courses.course_name')
            ->get();
        return view('classes.classes_timetable', [
            'title' => 'Class Timetable',
            'days' => $days,
            'shift1s' => $shift1s,
            'shift2s' => $shift2s,
            'shift3s' => $shift3s,
            'shift4s' => $shift4s,
        ]);
    }
}
