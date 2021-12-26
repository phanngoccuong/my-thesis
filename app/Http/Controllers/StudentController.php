<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Batch;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Notifications\EditStudent;
use App\Notifications\Student as NotificationsStudent;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;


class StudentController extends Controller
{
    // view list all students
    public function index()
    {
        $studentShow = Student::with('classes')->paginate(10);
        return view('student.student_all', [
            'title' => 'Quản lý học sinh',
            'studentShow' => $studentShow
        ]);
    }


    public function about()
    {
        return view('student.student_about', [
            'title' => 'Student About'
        ]);
    }
    // student add
    public function create()

    {
        $classes = Classes::all();
        $batches = Batch::all();
        return view('student.student_add', [
            'title' => 'Thêm học sinh mới',
            'classes' => $classes,
            'batches' => $batches
        ]);
    }
    // student save
    public function store(StudentRequest $request)
    {

        $image = time() . '.' . $request->upload->extension();
        $request->upload->move(public_path('images'), $image);

        $student = new Student;
        $student->name                = $request->name;
        $student->email               = $request->email;
        $student->batch_id            = $request->batch_id;
        $student->class_id            = $request->class_id;
        $student->gender              = $request->gender;
        $student->father_name         = $request->father_name;
        $student->father_number       = $request->father_number;
        $student->mother_name         = $request->mother_name;
        $student->mother_number       = $request->mother_number;
        $student->dateOfBirth         = $request->dateOfBirth;
        $student->address             = $request->address;
        $student->upload              = $image;
        $student->save();

        Toastr::success('Thêm học sinh thành công!!', 'Success');
        return redirect()->route('student/list');
    }
    // student edit
    public function edit($id)
    {
        $student = DB::table('students')->where('id', $id)->get();
        $classes = Classes::all();
        $batches = Batch::all();
        return view('student.student_edit', [
            'title' => 'Chỉnh sửa thông tin học sinh',
            'student' => $student,
            'classes' => $classes,
            'batches' => $batches
        ]);
    }
    // student update to db
    public function update(Request $request)
    {
        $id                  = $request->id;
        $name                = $request->name;
        $email               = $request->email;
        $batch_id            = $request->batch_id;
        $class_id            = $request->class_id;
        $gender              = $request->gender;
        $father_name         = $request->father_name;
        $father_number       = $request->father_number;
        $mother_name         = $request->mother_name;
        $mother_number       = $request->mother_number;
        $dateOfBirth         = $request->dateOfBirth;
        $address             = $request->address;


        $old_image = Student::find($id);
        $image_name = $request->hidden_image;
        $image = $request->file('upload');

        if ($image != '') {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
        }

        $update = [

            'id'                  => $id,
            'name'                => $name,
            'email'               => $email,
            'batch_id'            => $batch_id,
            'class_id'            => $class_id,
            'gender'              => $gender,
            'father_name'         => $father_name,
            'father_number'       => $father_number,
            'mother_name'         => $mother_name,
            'mother_number'       => $mother_number,
            'dateOfBirth'         => $dateOfBirth,
            'address'             => $address,
            'upload'              => $image_name,
        ];
        // $user = Auth::user();

        $receiver = User::where('role_name', '=', 'Admin')->get();
        Student::where('id', $request->id)->update($update);
        // Notification::send($receiver, new EditStudent($user, $name));
        Toastr::success('Cập nhật thành công!!', 'Success');
        return redirect()->route('student/list');
    }

    public function delete($id)
    {
        $delete = Student::find($id);
        $delete->delete();
        Toastr::success('Xóa học sinh thành công!!', 'Success');
        return redirect()->route('student/list');
    }

    public function PDFGenerate()
    {
        $students = Student::all();
        $exportPDF = PDF::loadView('student.pdf_view', ['students' => $students]);
        $exportPDF->setPaper(
            'A4',
            'landscape'
        );
        $exportPDF->stream();
        return $exportPDF->download('danh_sach_hoc_sinh.pdf');
    }
}
