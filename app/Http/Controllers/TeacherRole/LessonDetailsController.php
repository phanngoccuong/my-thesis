<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonDetailsRequest;
use App\Models\Lesson;
use App\Models\LessonDetails;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LessonDetailsController extends Controller
{
    public function index($lesson)
    {
        $schoolLesson = Lesson::findOrFail($lesson);
        $details = LessonDetails::orderBy('date', 'asc')->get();
        return view('RoleTeacher.lesson-details.add_page', [
            'title' => 'Chi tiết môn học',
            'schoolLesson' => $schoolLesson,
            'details' => $details
        ]);
    }
    public function store(LessonDetailsRequest $request)
    {
        $details = new LessonDetails;
        $details->lesson_id = $request->lesson_id;
        $details->date = $request->date;
        $details->lesson_title = $request->lesson_title;
        $details->save();
        Toastr::success('Thêm thành công', 'Thành công');
        return redirect()->back();
    }
    public function edit($id)
    {
        $data = LessonDetails::findOrFail($id);
        return view('RoleTeacher.lesson-details.edit', [
            'title' => 'Chỉnh sửa tiết học',
            'data' => $data,
        ]);
    }

    public function update(LessonDetailsRequest $request)
    {

        $update = [
            'id'                => $request->id,
            'lesson_id'         => $request->lesson_id,
            'date'              => $request->date,
            'lesson_title'      => $request->lesson_title,
        ];

        LessonDetails::where('id', $request->id)->update($update);
        Toastr::success('Cập nhật thành công!!', 'Success');
        return redirect()->route('teacher.lesson-details.add', ['lesson' => $request->lesson_id]);
    }
    public function delete($id)
    {
        $delete = LessonDetails::find($id);
        $delete->delete();
        Toastr::success('Xóa thành công!!', 'Thành công');
        return redirect()->back();
    }
}
