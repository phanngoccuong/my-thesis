<?php

namespace App\Http\Controllers;

use App\Http\Requests\DayRequest;
use App\Models\Day;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;


class DayController extends Controller
{
    public function index()
    {
        $days = DB::table('days')
            ->orderBy('day_name', 'asc')
            ->paginate(10);
        return view('day.day_all', [
            'title' => 'Quản lý ngày học',
            'days' => $days
        ]);
    }

    public function create()
    {
        return view('day.day_add', [
            'title' => 'Thêm ngày học'
        ]);
    }
    public function store(DayRequest $request)
    {

        $days = new Day;
        $days->day_name = $request->day_name;
        $days->save();

        Toastr::success('Thêm ngày học thành công!!', 'Success');
        return redirect()->route('day.list');
    }

    public function edit($id)
    {
        $days = Day::findOrFail($id);
        // $courseStatus = DB::table('course_types')->get();
        return view('day.day_edit',  [
            'title' => 'Chỉnh sửa ngày học',
            'days' => $days
        ]);
    }

    public function update(DayRequest $request)
    {
        $id = $request->id;
        $day_name = $request->day_name;

        $update = [
            'id' => $id,
            'day_name' => $day_name,
        ];
        Day::where('id', $request->id)->update($update);
        Toastr::success('Cập nhật ngày học thành công!!', 'Success');
        return redirect()->route('day.list');
    }

    public function delete($id)
    {
        $delete = Day::find($id);
        $delete->delete();
        Toastr::success('Xóa ngày học thành công!!', 'Success');
        return redirect()->route('day.list');
    }
}
