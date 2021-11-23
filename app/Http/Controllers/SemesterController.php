<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = DB::table('semesters')->get();
        return view('semester.semester_all', compact('semesters'), [
            'title' => 'Semester Dashboard'
        ]);
    }

    public function create()
    {
        return view('semester.semester_add', [
            'title' => 'Semester Add'
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'semester_name' => 'required|string|max:255',
        ]);
        $semesters = new Semester;
        $semesters->semester_name = $request->semester_name;
        $semesters->save();

        Toastr::success('Semester add successfully!!', 'Success');
        return redirect()->route('semester/list');
    }

    public function edit($id)
    {
        $semesters = DB::table('semesters')->where('id', $id)->get();
        // $courseStatus = DB::table('course_types')->get();
        return view('semester.semester_edit', compact('semesters'), [
            'title' => 'Semester Edit'
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $semester_name = $request->semester_name;


        $update = [
            'id' => $id,
            'semester_name' => $semester_name,
        ];
        Semester::where('id', $request->id)->update($update);
        Toastr::success('Semester updated successfully!!', 'Success');
        return redirect()->route('semester/list');
    }

    public function delete($id)
    {
        $delete = Semester::find($id);
        $delete->delete();
        Toastr::success('Semester deleted successfully!!', 'Success');
        return redirect()->route('semester/list');
    }
}
