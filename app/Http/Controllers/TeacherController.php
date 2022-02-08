<?php

namespace App\Http\Controllers;

use App\Exports\TeacherExport;
use App\Http\Requests\TeacherControllerRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = DB::table('teachers')
            ->orderBy('teacher_name', 'asc')
            ->paginate(10);
        return view('teacher.teacher_all',  [
            'title' => 'Danh sách giáo viên',
            'teachers' => $teachers
        ]);
    }

    public function create()
    {
        return view('teacher.teacher_add', [
            'title' => 'Thêm giáo viên'
        ]);
    }
    public function store(TeacherControllerRequest $request)
    {


        // $image = time() . '.' . $request->upload->extension();
        // $request->upload->move(public_path('images'), $image);

        $teachers = new Teacher;
        $teachers->teacher_name = $request->teacher_name;
        $teachers->email = $request->email;
        $teachers->gender  = $request->gender;
        $teachers->mobileNumber = $request->mobileNumber;
        $teachers->dateOfBirth = $request->dateOfBirth;
        $teachers->address = $request->address;
        // $teachers->upload  = $image;
        $teachers->save();

        Toastr::success('Thêm giáo viên thành công!!', 'Success');
        return redirect()->route('teacher.list');
    }

    public function edit($id)
    {
        $teachers = Teacher::findOrFail($id);
        return view('teacher.teacher_edit', [
            'title' => 'Chỉnh sửa thông tin giáo viên',
            'teachers' => $teachers
        ]);
    }

    public function update(TeacherControllerRequest $request)
    {
        $id                  = $request->id;
        $teacher_name        = $request->teacher_name;
        $email               = $request->email;
        $gender              = $request->gender;
        $mobileNumber        = $request->mobileNumber;
        $dateOfBirth         = $request->dateOfBirth;
        $address             = $request->address;

        // $old_image = Teacher::find($id);
        // $image_name = $request->hidden_image;
        // $image = $request->file('upload');

        // if ($image != '') {
        //     $image_name = rand() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $image_name);
        // }

        $update = [
            'id'                  => $id,
            'teacher_name'        => $teacher_name,
            'email'               => $email,
            'gender'              => $gender,
            'mobileNumber'        => $mobileNumber,
            'dateOfBirth'         => $dateOfBirth,
            'address'             => $address,
            // 'upload'              => $image_name,

        ];
        Teacher::where('id', $request->id)->update($update);
        Toastr::success('Cập nhật thông tin giáo viên thành công!!', 'Success');
        return redirect()->route('teacher.list');
    }

    public function delete($id)
    {
        $delete = Teacher::find($id);
        $delete->delete();
        Toastr::success('Xóa giáo viên thành công!!', 'Success');
        return redirect()->route('teacher.list');
    }

    public function PDFGenerate(Request $request)
    {
        $teachers = Teacher::all();
        $exportPDF = PDF::loadView('teacher.pdf_view', ['teachers' => $teachers]);
        $exportPDF->setPaper(
            'A4',
            'landscape'
        );
        $exportPDF->stream();
        return $exportPDF->download('danh_sach_giao_vien.pdf');
    }

    public function ExcelExport()
    {
        return Excel::download(new TeacherExport, 'giaovien.xlsx');
    }

    // public function ExcelExport_xls()
    // {
    //     return Excel::download(new Teacher_Export, 'giaovien.xls');
    // }
}
