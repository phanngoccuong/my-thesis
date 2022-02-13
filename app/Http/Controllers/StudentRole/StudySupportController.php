<?php

namespace App\Http\Controllers\StudentRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Course;
use App\Models\LessonDocument;
use App\Models\LessonNote;
use App\Models\Semester;
use App\Models\LessonPlan;
use App\Models\Lesson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class StudySupportController extends Controller
{
    public function getCoursePlan($semester, $class, $course)
    {
        $semesterPlan = Semester::findOrFail($semester);
        $classPlan = Classes::findOrFail($class);
        $coursePlan = Course::findOrFail($course);
        $details = LessonPlan::where('semester_id', $semesterPlan->id)
            ->where('class_id', $classPlan->id)
            ->where('course_id', $coursePlan->id)->orderBy('date', 'asc')->get();
        $notes = LessonNote::where('semester_id', $semesterPlan->id)
            ->where('class_id', $classPlan->id)
            ->where('course_id', $coursePlan->id)->orderBy('id', 'asc')->get();
        return view('RoleStudent.study-support.lesson_plan', [
            'title' => 'Kế hoạch học tập',
            'semesterPlan' => $semesterPlan,
            'classPlan' => $classPlan,
            'coursePlan' => $coursePlan,
            'details' => $details,
            'notes' => $notes
        ]);
    }
    public function getDocument($semester, $class, $course)
    {
        $semesterDoc = Semester::findOrFail($semester);
        $classDoc = Classes::findOrFail($class);
        $courseDoc = Course::findOrFail($course);
        $documents = LessonDocument::where('semester_id', $semesterDoc->id)
            ->where('class_id', $classDoc->id)
            ->where('course_id', $courseDoc->id)->orderBy('id', 'asc')->get();
        return view('RoleStudent.study-support.document', [
            'title' => 'Tài liệu học tập',
            'semesterDoc' => $semesterDoc,
            'classDoc' => $classDoc,
            'courseDoc' => $courseDoc,
            'documents' => $documents,
        ]);
    }
    public function searchSemester()
    {
        $currentUserEmail = Auth::user()->email;
        $semesters = Student::where('email', '=', $currentUserEmail)
            ->join('promotions', 'promotions.student_id', '=', 'students.id')
            ->join('semesters', 'semesters.session_id', '=', 'promotions.session_id')
            ->select('semesters.*')
            ->distinct()
            ->get();

        return view('RoleStudent.study-support.semester_search', [
            'title' => 'Hỗ trợ học tập',
            'semesters' => $semesters
        ]);
    }
    public function getCourse(Request $request)
    {
        $currentUserEmail = Auth::user()->email;
        $semester_id = $request->semester_id;
        $semester = Semester::where('id', $semester_id)->first();
        $class = DB::table('students')->where('email', '=', $currentUserEmail)
            ->join('promotions', 'promotions.student_id', '=', 'students.id')
            ->join('semesters', 'semesters.session_id', '=', 'promotions.session_id')
            ->where('semesters.id', '=', $semester_id)
            ->select('promotions.class_id')
            ->first();

        $datas = Lesson::with('classes', 'teachers', 'day', 'time', 'course', 'room')
            ->where('semester_id', '=', $semester_id)
            ->where('class_id', '=', $class->class_id)
            ->select('course_id', 'teacher_id')
            ->distinct()
            ->orderBy('day_id', 'asc')
            ->get();
        return view('RoleStudent.study-support.course_list', [
            'title' => 'Thời khóa biểu chi tiết',
            'datas' => $datas,
            'semester' => $semester,
            'class' => $class
        ]);
    }
}
