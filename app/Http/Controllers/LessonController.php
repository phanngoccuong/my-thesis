<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Course;
use App\Models\Classes;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\Day;
use App\Models\Lesson;
use App\Models\Time;
use App\Models\Semester;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = DB::table('lessons')
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->join('classes', 'classes.id', '=', 'lessons.class_id')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->join('days', 'days.id', '=', 'lessons.day_id')
            ->join('times', 'times.id', '=', 'lessons.time_id')
            ->join('classrooms', 'classrooms.id', '=', 'lessons.classroom_id')
            ->join('semesters', 'semesters.id', '=', 'lessons.semester_id')
            ->select(
                'courses.course_name',
                'classes.class_name',
                'days.day_name',
                'times.time',
                'classrooms.classroom_name',
                'semesters.semester_name',
                'lessons.*',
                'teachers.teacher_name'
            )
            ->get();
        // dd($lessons);

        return view(
            'lesson.lesson_all',
            compact('lessons'),
            [
                'title' => 'Lesson Dashboard'
            ]
        );
    }

    public function create()
    {
        $courses = Course::all();
        $classes = Classes::all();
        $teachers = Teacher::all();
        $classrooms = Classroom::all();
        $days = Day::all();
        $times = Time::all();
        $semesters = Semester::all();

        return view(
            'lesson.lesson_add',
            compact('courses', 'classes', 'teachers', 'classrooms', 'days', 'times', 'semesters'),
            [
                'title' => 'Lesson Add'
            ]
        );
    }
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|integer',
            'class_id' => 'required|integer',
            'teacher_id' => 'required|integer',
            'classroom_id' => 'required|integer',
            'day_id' => 'required|integer',
            'time_id' => 'required|integer',
            'semester_id' => 'required|integer',
        ]);

        $lessons = new Lesson;
        $lessons->course_id = $request->course_id;
        $lessons->class_id = $request->class_id;
        $lessons->teacher_id = $request->teacher_id;
        $lessons->classroom_id = $request->classroom_id;
        $lessons->day_id = $request->day_id;
        $lessons->time_id = $request->time_id;
        $lessons->semester_id = $request->semester_id;
        $lessons->save();

        Toastr::success('Lesson add successfully!!', 'Success');
        return redirect()->route('lesson/list');
    }

    public function edit($id)
    {
        $lesson = DB::table('lessons')->where('id', $id)->get();

        $courses = Course::all();
        $classes = Classes::all();
        $teachers = Teacher::all();
        $classrooms = Classroom::all();
        $days = Day::all();
        $times = Time::all();
        $semesters = Semester::all();


        return view(
            'lesson.lesson_edit',
            compact('courses', 'classes', 'teachers', 'classrooms', 'days', 'times', 'semesters', 'lesson'),
            [
                'title' => 'Lesson Edit'
            ]
        );
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $course_id = $request->course_id;
        $class_id = $request->class_id;
        $teacher_id = $request->teacher_id;
        $classroom_id = $request->classroom_id;
        $day_id = $request->day_id;
        $time_id = $request->time_id;
        $semester_id = $request->semester_id;

        $update = [
            'id'                => $id,
            'course_id'         => $course_id,
            'class_id'          => $class_id,
            'teacher_id'        => $teacher_id,
            'classroom_id'      => $classroom_id,
            'day_id'            => $day_id,
            'time_id'           => $time_id,
            'semester_id'       => $semester_id
        ];

        Lesson::where('id', $request->id)->update($update);
        Toastr::success('Lesson updated successfully!!', 'Success');
        return redirect()->route('lesson/list');
    }

    public function delete($id)
    {
        $delete = Lesson::find($id);
        $delete->delete();
        Toastr::success('Lesson deleted successfully!!', 'Success');
        return redirect()->route('lesson/list');
    }
}
