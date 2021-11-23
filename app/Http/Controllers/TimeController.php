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
            ->get();

        return view('time.time_all', compact('times'), [
            'title' => 'Time Dashboard'
        ]);
    }

    public function create()
    {
        return view('time.time_add', [
            'title' => 'Time Add'
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

        Toastr::success('Time add successfully!!', 'Success');
        return redirect()->route('time/list');
    }

    public function edit($id)
    {
        $times = DB::table('times')->where('id', $id)->get();
        // $courseStatus = DB::table('course_types')->get();
        return view('time.time_edit', compact('times'), [
            'title' => 'Time Edit'
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
        Toastr::success('Time updated successfully!!', 'Success');
        return redirect()->route('time/list');
    }

    public function delete($id)
    {
        $delete = Time::find($id);
        $delete->delete();
        Toastr::success('Time deleted successfully!!', 'Success');
        return redirect()->route('time/list');
    }
}
