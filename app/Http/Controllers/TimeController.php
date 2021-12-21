<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $request->validate([
            'time' => 'required|string|max:255',
        ]);
        $times = new Time;
        $times->time = $request->time;
        $times->save();

        Toastr::success('Thêm giờ học thành công!!', 'Success');
        return redirect()->route('time/list');
    }

    public function edit($id)
    {
        $times = DB::table('times')->where('id', $id)->get();
        return view('time.time_edit',  [
            'title' => 'Chỉnh sửa giờ học',
            'times' => $times
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $time = $request->time;

        $update = [
            'id' => $id,
            'time' => $time,
        ];
        Time::where('id', $request->id)->update($update);
        Toastr::success('Cập nhật giờ học thành công!!', 'Success');
        return redirect()->route('time/list');
    }

    public function delete($id)
    {
        $delete = Time::find($id);
        $delete->delete();
        Toastr::success('Xóa giờ học thành công!!', 'Success');
        return redirect()->route('time/list');
    }
}
