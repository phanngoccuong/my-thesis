<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use App\Models\StudentAttendances;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Course;
use App\Models\Classes;
use App\Models\Semester;

class AttendanceController extends Controller
{
    public function create()
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->first();
        $teacher_id = $info->id;

        $semesters = DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->join('semesters', 'semesters.id', '=', 'lessons.semester_id')
            ->select('semesters.*')
            ->distinct()
            ->get();

        return view('RoleTeacher.attendance_view', [
            'title' => 'Điểm danh',
            'semesters' => $semesters,
        ]);
    }

    public function getAttendanceStudent(Request $request)
    {
        $class_id = $request->class_id;
        $semester_id = $request->semester_id;
        $data = DB::table('students')
            ->join('promotions', 'promotions.student_id', '=', 'students.id')
            ->join('semesters', 'semesters.session_id', '=', 'promotions.session_id')
            ->where('promotions.class_id', '=', $class_id)
            ->where('semesters.id', '=', $semester_id)
            ->select('students.*')
            ->orderBy('first_name', 'asc')
            ->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $insert =  [
                    'student_id' => $request->student_id[$i],
                    'class_id' => $request->class_id,
                    'course_id' => $request->course_id,
                    'semester_id' => $request->semester_id,
                    'date' => $request->date,
                    'status' => $request->status[$i]
                ];
                DB::table('student_attendances')->insert($insert);
                DB::commit();
            }
            Toastr::success('Điểm  danh thành công!!', 'Thành công');
            return redirect()->back();
        } catch (
            \Exception
            $err
        ) {
            DB::rollBack();
            Toastr::error('Vui lòng điểm danh cho tất cả học sinh!!', 'Thất bại');
            return redirect()->back();
        }
    }

    public function show()
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->first();
        $teacher_id = $info->id;

        $semesters = DB::table('lessons')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->where('teachers.id', '=', $teacher_id)
            ->join('semesters', 'semesters.id', '=', 'lessons.semester_id')
            ->select('semesters.*')
            ->distinct()
            ->get();

        return view('RoleTeacher.attendance_edit', [
            'title' => 'Điểm danh',
            'semesters' => $semesters,
        ]);
    }

    public function getDate(Request $request)
    {
        $class_id = $request->class_id;
        $course_id = $request->course_id;
        $semester_id = $request->semester_id;
        $data = StudentAttendances::where('class_id', '=', $class_id)
            ->where('semester_id', '=', $semester_id)
            ->where('course_id', '=', $course_id)
            ->select('date')
            ->distinct()
            ->get();
        return response()->json($data);
    }

    public function getAtten(Request $request)
    {
        $class_id = $request->class_id;
        $course_id = $request->course_id;
        $semester_id = $request->semester_id;
        $date = $request->date;
        $semester = Semester::where('id', $semester_id)->first();
        $class = Classes::where('id', $class_id)->first();
        $course = Course::where('id', $course_id)->first();

        $datas = StudentAttendances::with('student', 'course', 'classes', 'semester')
            ->where('class_id', '=', $class_id)
            ->where('semester_id', '=', $semester_id)
            ->where('course_id', '=', $course_id)
            ->where('date', '=', $date)
            ->orderBy('id', 'asc')
            ->get();

        return view('RoleTeacher.attendance_details', [
            'title' => 'Điểm danh',
            'datas' => $datas,
            'semester' => $semester,
            'course' => $course,
            'class' => $class,
            'date' => $date
        ]);
    }
}
