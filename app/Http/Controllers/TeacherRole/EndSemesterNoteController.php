<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Semester;
use App\Models\Teacher;
use App\Models\AssignTeacher;
use App\Models\Promotion;
use App\Models\Classes;
use App\Models\end_semester_note;
use App\Models\Student;
use App\Models\YearSession;
use Brian2694\Toastr\Facades\Toastr;

class EndSemesterNoteController extends Controller
{
    public function search()
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->first();
        $teacher_id = $info->id;
        $years = AssignTeacher::with('year')->where('teacher_id', $teacher_id)->get();
        return view('RoleTeacher.note_search', [
            'title' => 'Sổ liên lạc',
            'years' => $years
        ]);
    }

    public function getSemesterByYear(Request $request)
    {
        $year_request = $request->session_id;
        $data = Semester::where('session_id', $year_request)->get();
        return response()->json($data);
    }
    public function getClassByYear(Request $request)
    {
        $year_request = $request->session_id;
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->first();
        $teacher_id = $info->id;
        $data = AssignTeacher::with('class')->where('teacher_id', $teacher_id)
            ->where('session_id', $year_request)
            ->get();
        return response()->json($data);
    }

    public function getStudentByYear(Request $request)
    {
        $year_id = $request->session_id;
        $class_id = $request->class_id;
        $semester_id = $request->semester_id;
        $semester = Semester::where('id', $semester_id)->first();
        $class = Classes::where('id', $class_id)->first();
        $year = YearSession::where('id', $year_id)->first();
        $students = Promotion::with('student')
            ->where('class_id', $class_id)
            ->where('session_id', $year_id)->paginate(10);
        return view('RoleTeacher.student_list_by_year', [
            'title' => 'Sổ liên lạc',
            'students' => $students,
            'class' => $class,
            'year' => $year,
            'semester' => $semester
        ]);
    }

    public function create($id, $semester)
    {
        $student = Student::findOrFail($id);
        $semesters = Semester::where('semester_name', $semester)->first();
        return view('RoleTeacher.note_add', [
            'title' => 'Sổ liên lạc',
            'student' => $student,
            'semesters' => $semesters
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'semester_id' => 'required|integer',
            'comment' => 'required',
            'conduct' => 'required|string',
            'student_type' => 'required|string'
        ], [
            'comment.required' => 'Vui lòng nhập nhận xét của giáo viên',
            'conduct.required' => 'Vui lòng chọn loại hạnh kiểm',
            'student_type.required' => 'Vui lòng xếp loại học sinh'
        ]);
        $note = new end_semester_note;
        $note->student_id = $request->student_id;
        $note->semester_id = $request->semester_id;
        $note->student_type = $request->student_type;
        $note->conduct = $request->conduct;
        $note->comment = $request->comment;
        $note->save();
        Toastr::success('Ghi sổ liên lạc thành công', 'Thành công!!');
        return redirect()->route('note.student.show');
    }
    public function show($id, $semester)
    {
        $semesters = Semester::where('semester_name', $semester)->first();
        $data = end_semester_note::with('student')
            ->where('student_id', $id)->where('semester_id', $semesters->id)->first();
        return view('RoleTeacher.note_edit', [
            'title' => 'Sổ liên lạc',
            'data' => $data,
            'semesters' => $semesters
        ]);
    }
    public function update(Request $request)
    {
        $update = [
            'id' => $request->id,
            'student_id' => $request->student_id,
            'semester_id' => $request->semester_id,
            'student_type' => $request->student_type,
            'conduct' => $request->conduct,
            'comment' => $request->comment,
        ];
        end_semester_note::where('id', $request->id)->update($update);
        Toastr::success('Cập nhật sổ liên lạc thành công', 'Thành công!!');
        return redirect()->back();
    }
}
