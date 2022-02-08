<?php

namespace App\Http\Controllers;

use App\Http\Requests\SemesterRequest;
use App\Models\Semester;
use App\Models\YearSession;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = DB::table('semesters')
            ->orderBy('semester_name', 'asc')
            ->paginate(10);
        return view('semester.semester_all',  [
            'title' => 'Quản lý học kì',
            'semesters' => $semesters
        ]);
    }

    public function create()
    {
        $latest_session = YearSession::latest()->first();
        return view('semester.semester_add', [
            'title' => 'Thêm học kì',
            'latest_session_id' => $latest_session->id
        ]);
    }
    public function store(SemesterRequest $request)
    {
        $semesters = new Semester;
        $semesters->semester_name = $request->semester_name;
        $semesters->session_id = $request->session_id;
        $semesters->start_date = $request->start_date;
        $semesters->end_date = $request->end_date;
        $semesters->save();

        Toastr::success('Thêm học kì thành công!!', 'Success');
        return redirect()->route('semester.list');
    }

    public function edit($id)
    {
        $semesters = Semester::findOrFail($id);

        return view('semester.semester_edit',  [
            'title' => 'Chỉnh sửa kì học',
            'semesters' => $semesters
        ]);
    }

    public function update(SemesterRequest $request)
    {
        $id = $request->id;
        $semester_name = $request->semester_name;


        $update = [
            'id' => $id,
            'semester_name' => $semester_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ];
        Semester::where('id', $request->id)->update($update);
        Toastr::success('Cập nhật học kì thành công!!', 'Success');
        return redirect()->route('semester.list');
    }

    public function delete($id)
    {
        $delete = Semester::find($id);
        $delete->delete();
        Toastr::success('Xóa học kì thành công!!', 'Success');
        return redirect()->route('semester.list');
    }
}
