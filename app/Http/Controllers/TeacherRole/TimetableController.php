<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\LessonNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\Semester;
use Brian2694\Toastr\Facades\Toastr;
use Svg\Tag\Rect;

class TimetableController extends Controller
{
    public function timetableSearch()
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

        return view('RoleTeacher.teacher_timetable_search', [
            'title' => 'Thời khóa biểu',
            'semesters' => $semesters,
        ]);
    }

    public function showTimetable(Request $request)
    {
        $currentUserEmail = Auth::user()->email;
        $info = Teacher::where('email', '=', $currentUserEmail)
            ->first();
        $teacher_id = $info->id;

        $semesterRequest = $request->semester_id;
        $semester = Semester::where('id', $semesterRequest)->first();
        $datas = Lesson::with('classes', 'teachers', 'day', 'time', 'course', 'room', 'note')
            ->where('teacher_id', $teacher_id)
            ->orderBy('day_id', 'asc')
            ->get();


        return view('RoleTeacher.teacher_timetable_details', [
            'title' => 'Thời khóa biểu',
            'datas' => $datas,
            'semester' => $semester
        ]);
    }

    public function addNoteView($id)
    {
        $lesson = Lesson::findOrFail($id);

        return view('RoleTeacher.timetable_note_add', [
            'title' => 'Thời khóa biểu',
            'lesson' => $lesson
        ]);
    }
    // them ma lop online
    public function addNote(Request $request)
    {
        $request->validate([
            'lesson_code' => 'required'
        ]);
        try {
            $note = new LessonNote;
            $note->lesson_id = $request->lesson_id;
            $note->lesson_code = $request->lesson_code;
            $note->save();
            Toastr::success('Thêm thành công!!', 'Success');
            return redirect()->route('teacher.timetable.search');
        } catch (\Exception $err) {
            Toastr::error('Thêm thất bại!!', 'Failed');
            return redirect()->back();
        }
    }
    public function editNote($id)
    {
        $lesson = Lesson::findOrFail($id);
        $note = LessonNote::where('lesson_id', $id)->first();
        return view('RoleTeacher.timetable_note_edit', [
            'title' => 'Ghi chú của giáo viên',
            'lesson' => $lesson,
            'note' => $note
        ]);
    }
    public function updateNote(Request $request)
    {
        $update = [
            'lesson_id' => $request->lesson_id,
            'lesson_code' => $request->lesson_code
        ];
        LessonNote::where('lesson_id', $request->lesson_id)->update($update);
        Toastr::success('Cập nhật thành công!!', 'Success');
        return redirect()->route('teacher.timetable.search');
    }
}
