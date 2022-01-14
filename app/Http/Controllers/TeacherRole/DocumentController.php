<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\LessonDocument;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function create($id)
    {
        $lesson = Lesson::with('course', 'classes')->findOrFail($id);

        return view('RoleTeacher.document_upload', [
            'title' => 'Gửi tài liệu',
            'lesson' => $lesson
        ]);
    }

    public function storeDocument(Request $request)
    {
        $path = Storage::disk('public')->put('syllabi', $request['file']);
        try {
            $upload = new LessonDocument;
            $upload->document_name = $request->document_name;
            $upload->document_file_path = $path;
            $upload->lesson_id = $request->lesson_id;
            $upload->save();
            Toastr::success('Gửi thành công', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Gửi thất bại', 'Failed');
            return redirect()->back();
        }
    }
    public function getDocumentList($id)
    {
        $documents = LessonDocument::with('lesson')->where('lesson_id', $id)->get();
        return view('RoleTeacher.document_list', [
            'title' => 'Danh sách tài liệu',
            'documents' => $documents
        ]);
    }
}
