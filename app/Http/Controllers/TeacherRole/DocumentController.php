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
            LessonDocument::create([
                'document_name'           => $request['document_name'],
                'document_file_path'      => $path,
                'lesson_id'              => $request['lesson_id']
            ]);
            Toastr::success('Gửi thành công', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Gửi thất bại', 'Failed');
            return redirect()->back();
        }
    }
}
