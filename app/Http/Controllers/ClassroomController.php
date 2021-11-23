<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class ClassroomController extends Controller
{
    public function index()
    {
        $classroomShow = DB::table('classrooms')->get();
        return view('classroom.classroom_all', compact('classroomShow'), [
            'title' => 'Classroom Dashboard'
        ]);
    }

    public function create()
    {
        return view('classroom.classroom_add', [
            'title' => 'Room Add'
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'classroom_name' => 'required|string|max:255',
        ]);
        $classrooms = new Classroom;
        $classrooms->classroom_name = $request->classroom_name;
        $classrooms->save();

        Toastr::success('Classroom add successfully!!', 'Success');
        return redirect()->route('classroom/list');
    }

    public function edit($id)
    {
        $classrooms = DB::table('classrooms')->where('id', $id)->get();
        return view('classroom.classroom_edit', compact('classrooms'), [
            'title' => 'Classroom Edit'
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $classroom_name = $request->classroom_name;

        $update = [
            'id' => $id,
            'classroom_name' => $classroom_name
        ];
        Classroom::where('id', $request->id)->update($update);
        Toastr::success('Classroom updated successfully!!', 'Success');
        return redirect()->route('classroom/list');
    }

    public function delete($id)
    {
        $delete = Classroom::find($id);
        $delete->delete();
        Toastr::success('Classroom deleted successfully!!', 'Success');
        return redirect()->route('classroom/list');
    }
}
