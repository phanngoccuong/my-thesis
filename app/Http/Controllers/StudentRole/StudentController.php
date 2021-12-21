<?php

namespace App\Http\Controllers\StudentRole;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Day;
use App\Models\StudentMarks;
use App\Models\StudentAttendances;

class StudentController extends Controller
{
    public function index()
    {
        return view('dashboard.student_dashboard', [
            'title' => 'Student Dashboard'
        ]);
    }

    public function showProfile()
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->with('classes', 'batches')
            ->get();
        //dd($studentInfo);
        return view('RoleStudent.student_profile', [
            'title' => 'Student Profile',
            'studentInfo' => $studentInfo
        ]);
    }

    public function showClassInfo()
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->get();
        $class_id = $studentInfo[0]->class_id;
        $classAllInfo = Student::join('classes', 'students.class_id', '=', 'classes.id')
            ->where('classes.id', '=', $class_id)
            ->select('classes.class_name', 'classes.formteacher_id', 'students.*')
            ->get();
        return view('RoleStudent.student_class', [
            'title' => 'Student Class Info',
            'classAllInfo' => $classAllInfo
        ]);
    }

    public function showTimetable()
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->get();
        $class_id = $studentInfo[0]->class_id;
        $days = Day::all();
        $shift1s = DB::table('classes')
            ->join('lessons', 'lessons.class_id', '=', 'classes.id')
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->join('times', 'times.id', '=', 'lessons.time_id')
            ->where('classes.id', '=', $class_id)
            ->where('times.time', '=', '7h20-8h05')
            ->select('courses.course_name')
            ->get();
        $shift2s = DB::table('classes')
            ->join('lessons', 'lessons.class_id', '=', 'classes.id')
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->join('times', 'times.id', '=', 'lessons.time_id')
            ->where('classes.id', '=', $class_id)
            ->where('times.time', '=', '8h15-9h00')
            ->select('courses.course_name')
            ->get();
        $shift3s = DB::table('classes')
            ->join('lessons', 'lessons.class_id', '=', 'classes.id')
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->join('times', 'times.id', '=', 'lessons.time_id')
            ->where('classes.id', '=', $class_id)
            ->where('times.time', '=', '9h20-10h05')
            ->select('courses.course_name')
            ->get();
        $shift4s = DB::table('classes')
            ->join('lessons', 'lessons.class_id', '=', 'classes.id')
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->join('times', 'times.id', '=', 'lessons.time_id')
            ->where('classes.id', '=', $class_id)
            ->where('times.time', '=', '10h15-11h00')
            ->select('courses.course_name')
            ->get();
        return view('RoleStudent.student_timetable', [
            'title' => 'Student Timetable',
            'days' => $days,
            'shift1s' => $shift1s,
            'shift2s' => $shift2s,
            'shift3s' => $shift3s,
            'shift4s' => $shift4s,
        ]);
    }

    public function timetableDetails()
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->get();
        $class_id = $studentInfo[0]->class_id;
        $datas = DB::table('lessons')
            ->join('classes', 'classes.id', '=', 'lessons.class_id')
            ->where('classes.id', '=', $class_id)
            ->join('courses', 'courses.id', '=', 'lessons.course_id')
            ->join('times', 'times.id', '=', 'lessons.time_id')
            ->join('days', 'days.id', '=', 'lessons.day_id')
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->join('classrooms', 'classrooms.id', '=', 'lessons.classroom_id')
            ->select(
                'courses.course_name',
                'classes.class_name',
                'days.day_name',
                'times.time',
                'classrooms.classroom_name',
                'teachers.teacher_name'
            )
            ->orderBy('day_name', 'asc')->get();
        //dd($datas);
        return view('RoleStudent.timetable-details', [
            'title' => 'Timetable Details',
            'datas' => $datas
        ]);
    }

    public function getCourse(Request $request)
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->get();
        $class_id = $studentInfo[0]->class_id;
        $semester_id = $request->semester_id;
        $datas = DB::table('student_marks')
            ->join('semesters', 'semesters.id', '=', 'student_marks.semester_id')
            ->where('semesters.id', '=', $semester_id)
            ->join('courses', 'courses.id', '=', 'student_marks.course_id')
            ->select(
                'courses.*',
            )
            ->distinct()
            ->orderBy('course_name', 'asc')
            ->get();
        return response()->json($datas);
    }

    public function show()
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->get();
        $class_id = $studentInfo[0]->class_id;

        $semesters = DB::table('student_marks')
            ->join('classes', 'classes.id', '=', 'student_marks.class_id')
            ->where('classes.id', '=', $class_id)
            ->join('semesters', 'semesters.id', '=', 'student_marks.semester_id')
            ->select('semesters.*')
            ->distinct()
            ->get();

        return view('RoleStudent.student_mark_view', [
            'title' => 'Điểm học sinh',
            'semesters' => $semesters,
        ]);
    }

    public function getMark(Request $request)
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->get();
        $studentID = $studentInfo[0]->id;
        $semesterRequest = $request->semester_id;

        $data = StudentMarks::with('course')
            ->where('student_id', '=', $studentID)
            ->where('semester_id', '=', $semesterRequest)
            ->get();

        return response()->json($data);
    }

    public function showAttendance()
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->get();
        $class_id = $studentInfo[0]->class_id;

        $semesters = DB::table('student_attendances')
            ->join('classes', 'classes.id', '=', 'student_attendances.class_id')
            ->where('classes.id', '=', $class_id)
            ->join('semesters', 'semesters.id', '=', 'student_attendances.semester_id')
            ->select('semesters.*')
            ->distinct()
            ->get();
        return view('RoleStudent.student_attendance_view', [
            'title' => 'Thông tin điểm danh',
            'semesters' => $semesters,
        ]);
    }

    public function getAttendance(Request $request)
    {
        $currentUserEmail = Auth::user()->email;
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->get();
        $student_id = $studentInfo[0]->id;
        $course = $request->course_id;
        $semester = $request->semester_id;
        $datas = StudentAttendances::with('student', 'course', 'classes', 'semester')
            ->where('semester_id', '=', $semester)
            ->where('course_id', '=', $course)
            ->where('student_id', '=', $student_id)
            ->orderBy('date', 'asc')
            ->paginate(10);

        return view('RoleStudent.student_attendance_view_details', [
            'title' => 'Thông tin điểm danh',
            'datas' => $datas
        ]);
    }
}
