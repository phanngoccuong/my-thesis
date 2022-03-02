<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
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
            ->orderBy('id', 'desc')
            ->paginate(10);
        $classes = Classes::orderBy('class_name', 'asc')->get();
        return view(
            'lesson.lesson_all',
            [
                'title' => 'Quản lý tiết học',
                'lessons' => $lessons,
                'classes' => $classes
            ]
        );
    }

    public function create()
    {
        $courses = Course::all();
        $classes = Classes::orderBy('class_name', 'asc')->get();
        $teachers = Teacher::all();
        $classrooms = Classroom::all();
        $days = Day::all();
        $times = Time::all();
        $semesters = Semester::orderBy('id', 'desc')->get();

        return view(
            'lesson.lesson_add',
            compact('courses', 'classes', 'teachers', 'classrooms', 'days', 'times', 'semesters'),
            [
                'title' => 'Thêm tiết học'
            ]
        );
    }
    public function store(LessonRequest $request)
    {
        $lesson =
            Lesson::where('semester_id',  $request->semester_id)
            ->where('class_id',  $request->class_id)
            ->where('time_id',  $request->time_id)
            ->where('day_id', $request->day_id)
            ->first();
        if ($lesson) {
            Toastr::error('Trùng tiết học!!', 'Thất bại');
            return redirect()->back();
        }
        $teacher =
            Lesson::where('semester_id',  $request->semester_id)
            ->where('teacher_id',  $request->teacher_id)
            ->where('time_id',  $request->time_id)
            ->where('day_id', $request->day_id)
            ->first();
        if ($teacher) {
            Toastr::error('Trùng giáo viên!!', 'Thất bại');
            return redirect()->back();
        }
        $lessons = new Lesson;
        $lessons->course_id = $request->course_id;
        $lessons->class_id = $request->class_id;
        $lessons->teacher_id = $request->teacher_id;
        $lessons->classroom_id = $request->classroom_id;
        $lessons->day_id = $request->day_id;
        $lessons->time_id = $request->time_id;
        $lessons->semester_id = $request->semester_id;
        $lessons->save();

        Toastr::success('Thêm tiết học thành công!!', 'Thành công');
        return redirect()->route('lesson.list');
    }

    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);

        $courses = Course::all();
        $classes = Classes::orderBy('class_name', 'asc')->get();
        $teachers = Teacher::all();
        $classrooms = Classroom::all();
        $days = Day::all();
        $times = Time::all();
        $semesters = Semester::orderBy('id', 'desc')->get();


        return view(
            'lesson.lesson_edit',
            compact('courses', 'classes', 'teachers', 'classrooms', 'days', 'times', 'semesters', 'lesson'),
            [
                'title' => 'Sửa thông tin tiết học'
            ]
        );
    }

    public function update(LessonRequest $request)
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
        Toastr::success('Cập nhật tiết học thành công!!', 'Success');
        return redirect()->route('lesson.list');
    }

    public function delete($id)
    {
        $delete = Lesson::find($id);
        $delete->delete();
        Toastr::success('Xóa tiết học thành công!!', 'Success');
        return redirect()->route('lesson.list');
    }

    public function search(Request $request)
    {
        if ($request->course) {
            $lessons = DB::table('lessons')
                ->join('courses', 'courses.id', '=', 'lessons.course_id')
                ->join('classes', 'classes.id', '=', 'lessons.class_id')
                ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
                ->join('days', 'days.id', '=', 'lessons.day_id')
                ->join('times', 'times.id', '=', 'lessons.time_id')
                ->join('classrooms', 'classrooms.id', '=', 'lessons.classroom_id')
                ->join('semesters', 'semesters.id', '=', 'lessons.semester_id')
                ->where('courses.course_name', 'LIKE', '%' . $request->course . '%')
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
                ->orderBy('semester_id', 'asc')->paginate(10);
        }
        if ($request->teacher) {
            $lessons = DB::table('lessons')
                ->join('courses', 'courses.id', '=', 'lessons.course_id')
                ->join('classes', 'classes.id', '=', 'lessons.class_id')
                ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
                ->join('days', 'days.id', '=', 'lessons.day_id')
                ->join('times', 'times.id', '=', 'lessons.time_id')
                ->join('classrooms', 'classrooms.id', '=', 'lessons.classroom_id')
                ->join('semesters', 'semesters.id', '=', 'lessons.semester_id')
                ->where('teachers.teacher_name', 'LIKE', '%' . $request->teacher . '%')
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
                ->orderBy('semester_id', 'asc')->paginate(10);
        }
        if ($request->class_id) {
            $lessons = DB::table('lessons')
                ->join('courses', 'courses.id', '=', 'lessons.course_id')
                ->join('classes', 'classes.id', '=', 'lessons.class_id')
                ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
                ->join('days', 'days.id', '=', 'lessons.day_id')
                ->join('times', 'times.id', '=', 'lessons.time_id')
                ->join('classrooms', 'classrooms.id', '=', 'lessons.classroom_id')
                ->join('semesters', 'semesters.id', '=', 'lessons.semester_id')
                ->where('lessons.class_id', $request->class_id)
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
                ->orderBy('semester_id', 'asc')->paginate(10);
        }
        $classes = Classes::orderBy('id', 'asc')->get();
        return view('lesson.lesson_search', compact('lessons', 'classes'), [
            'title' => 'Danh sách tiết học',
        ]);
    }
}
