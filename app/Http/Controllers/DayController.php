<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;


class DayController extends Controller
{
    public function index()
    {
        $days = DB::table('days')->get();
        return view('day.day_all', [
            'title' => 'Day Dashboard',
            'days' => $days
        ]);
    }

    public function create()
    {
        return view('day.day_add', [
            'title' => 'Day Add'
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'day_name' => 'required|string|max:255',
        ]);
        $days = new Day;
        $days->day_name = $request->day_name;
        $days->save();

        Toastr::success('Day add successfully!!', 'Success');
        return redirect()->route('day/list');
    }

    public function edit($id)
    {
        $days = DB::table('days')->where('id', $id)->get();
        // $courseStatus = DB::table('course_types')->get();
        return view('day.day_edit',  [
            'title' => 'Day Edit',
            'days' => $days
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $day_name = $request->day_name;

        $update = [
            'id' => $id,
            'day_name' => $day_name,
        ];
        Day::where('id', $request->id)->update($update);
        Toastr::success('Day updated successfully!!', 'Success');
        return redirect()->route('day/list');
    }

    public function delete($id)
    {
        $delete = Day::find($id);
        $delete->delete();
        Toastr::success('Day deleted successfully!!', 'Success');
        return redirect()->route('day/list');
    }
}
