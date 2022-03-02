<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use App\Http\Requests\StudentRequest;
use App\Models\Batch;
use App\Models\Classes;

use Illuminate\Http\Request;
use App\Models\Student;

use App\Models\YearSession;

use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

use Maatwebsite\Excel\Facades\Excel;



class StudentController extends Controller
{
    public function index()
    {
        $studentShow = Student::with('batches')
            ->orderBy('first_name', 'asc')->paginate(10);

        return view('student.student_all', [
            'title' => 'Danh sách học sinh',
            'studentShow' => $studentShow
        ]);
    }
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('student.student_show', [
            'title' => 'Profile Học sinh',
            'student' => $student
        ]);
    }
    public function create()
    {
        $currentYearSession = YearSession::latest()->first();
        $classes = Classes::all();
        $batches = Batch::all();

        return view('student.student_add', [
            'title' => 'Thêm học sinh mới',
            'classes' => $classes,
            'batches' => $batches,
            'currentYearSession_id' => $currentYearSession->id
        ]);
    }
    public function store(StudentRequest $request)
    {

        DB::beginTransaction();
        $student = new Student;
        $student->first_name          = $request->first_name;
        $student->last_name           = $request->last_name;
        $student->email               = $request->email;
        $student->batch_id            = $request->batch_id;
        $student->gender              = $request->gender;
        $student->father_name         = $request->father_name;
        $student->father_number       = $request->father_number;
        $student->mother_name         = $request->mother_name;
        $student->mother_number       = $request->mother_number;
        $student->dateOfBirth         = $request->dateOfBirth;
        $student->address             = $request->address;
        $student->save();
        $promo = [
            'student_id'    => $student->id,
            'class_id'      => $request->class_id,
            'session_id'    => $request->session_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('promotions')->insert($promo);
        DB::commit();
        Toastr::success('Thêm học sinh thành công!!', 'Success');
        return redirect()->route('student.list');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $classes = Classes::all();
        $batches = Batch::all();
        return view('student.student_edit', [
            'title' => 'Chỉnh sửa thông tin học sinh',
            'student' => $student,
            'classes' => $classes,
            'batches' => $batches
        ]);
    }

    public function update(StudentRequest $request)
    {
        $id                  = $request->id;
        $first_name          = $request->first_name;
        $last_name           = $request->last_name;
        $email               = $request->email;
        $batch_id            = $request->batch_id;
        $gender              = $request->gender;
        $father_name         = $request->father_name;
        $father_number       = $request->father_number;
        $mother_name         = $request->mother_name;
        $mother_number       = $request->mother_number;
        $dateOfBirth         = $request->dateOfBirth;
        $address             = $request->address;


        // $old_image = Student::find($id);
        // $image_name = $request->hidden_image;
        // $image = $request->file('upload');

        // if ($image != '') {
        //     $image_name = rand() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $image_name);
        // }

        $update = [

            'id'                  => $id,
            'first_name'          => $first_name,
            'last_name'          => $last_name,
            'email'               => $email,
            'batch_id'            => $batch_id,
            'gender'              => $gender,
            'father_name'         => $father_name,
            'father_number'       => $father_number,
            'mother_name'         => $mother_name,
            'mother_number'       => $mother_number,
            'dateOfBirth'         => $dateOfBirth,
            'address'             => $address,
            // 'upload'              => $image_name,
        ];

        Student::where('id', $request->id)->update($update);
        Toastr::success('Cập nhật thành công!!', 'Success');
        return redirect()->route('student.list');
    }

    public function delete($id)
    {
        $delete = Student::find($id);
        $delete->delete();
        Toastr::success('Xóa học sinh thành công!!', 'Success');
        return redirect()->route('student.list');
    }
    public function search(Request $request)
    {
        if ($request->first_name) {
            $studentShow = Student::where('first_name', 'LIKE', '%' . $request->first_name . '%')
                ->orderBy('first_name', 'asc')->paginate(10);
        }
        if ($request->email) {
            $studentShow = Student::where('email', 'LIKE', '%' . $request->email . '%')
                ->orderBy('first_name', 'asc')->paginate(10);
        }
        return view('student.student_search', compact('studentShow'), [
            'title' => 'Danh sách học sinh',
        ]);
    }

    public function PDFGenerate()
    {
        $students = Student::with('batches')
            ->orderBy('first_name', 'asc')->get();
        $exportPDF = PDF::loadView('student.pdf_view', ['students' => $students]);
        $exportPDF->setPaper(
            'A4',
            'landscape'
        );
        $exportPDF->stream();
        return $exportPDF->download('danh_sach_hoc_sinh.pdf');
    }
    public function ExcelExport()
    {
        return Excel::download(new StudentExport, 'hocsinh.xlsx');
    }
}
