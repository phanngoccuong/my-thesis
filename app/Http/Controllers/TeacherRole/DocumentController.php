<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\LessonDocument;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use App\Models\Semester;
use App\Models\Classes;
use App\Models\Course;

class DocumentController extends Controller
{
    public function storeDocument(Request $request)
    {
        $path = Storage::disk('public')->put('syllabi', $request['file']);
        try {
            $upload = new LessonDocument;
            $upload->document_name = $request->document_name;
            $upload->document_file_path = $path;
            $upload->semester_id = $request->semester_id;
            $upload->class_id = $request->class_id;
            $upload->course_id = $request->course_id;
            $upload->save();
            Toastr::success('Gửi thành công', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Gửi thất bại', 'Failed');
            return redirect()->back();
        }
    }
    public function getDocumentList($semester, $class, $course)
    {
        $semesterLess = Semester::findOrFail($semester);
        $classLess = Classes::findOrFail($class);
        $courseLess = Course::findOrFail($course);
        $documents = LessonDocument::where('semester_id', $semesterLess->id)
            ->where('class_id', $classLess->id)
            ->where('course_id', $courseLess->id)
            ->get();
        return view('RoleTeacher.lesson-document.document_list', [
            'title' => 'Danh sách tài liệu',
            'documents' => $documents,
            'semesterLess' => $semesterLess,
            'classLess' => $classLess,
            'courseLess' => $courseLess,
        ]);
    }
    public function delete($id)
    {
        $delete = LessonDocument::find($id);
        $delete->delete();
        Toastr::success('Xóa tài liệu thành công!!', 'Success');
        return redirect()->back();
    }
}
