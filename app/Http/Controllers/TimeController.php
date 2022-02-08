<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeRequest;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class TimeController extends Controller
{
    public function index()
    {
        $times = DB::table('times')
            ->orderBy('id', 'asc')
            ->paginate(10);
        return view('time.time_all', [
            'title' => 'Danh sách giờ học',
            'times' => $times
        ]);
    }

    public function create()
    {
        return view('time.time_add', [
            'title' => 'Thêm giờ học'
        ]);
    }
    public function store(TimeRequest $request)
    {

        $times = new Time;
        $times->time = $request->time;
        $times->save();

        Toastr::success('Thêm giờ học thành công!!', 'Success');
        return redirect()->route('time.list');
    }

    public function edit($id)
    {
        $times = Time::findOrFail($id);
        return view('time.time_edit',  [
            'title' => 'Chỉnh sửa giờ học',
            'times' => $times
        ]);
    }

    public function update(TimeRequest $request)
    {
        $id = $request->id;
        $time = $request->time;

        $update = [
            'id' => $id,
            'time' => $time,
        ];
        Time::where('id', $request->id)->update($update);
        Toastr::success('Cập nhật giờ học thành công!!', 'Success');
        return redirect()->route('time.list');
    }

    public function delete($id)
    {
        $delete = Time::find($id);
        $delete->delete();
        Toastr::success('Xóa giờ học thành công!!', 'Success');
        return redirect()->route('time.list');
    }
}
