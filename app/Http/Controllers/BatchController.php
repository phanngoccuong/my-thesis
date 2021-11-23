<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
{
    public function index()
    {
        $batchShow = DB::table('batches')->get();
        return view('batches.batch_all', compact('batchShow'), [
            'title' => 'Batch Dashboard'
        ]);
    }

    public function create()
    {
        return view('batches.batch_add', [
            'title' => 'Batch Add'
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'batch_name' => 'required|string|max:255',
        ]);
        $batches = new Batch;
        $batches->batch_name = $request->batch_name;
        $batches->save();

        Toastr::success('Batch add successfully!!', 'Success');
        return redirect()->route('batch/list');
    }

    public function edit($id)
    {
        $batches = DB::table('batches')->where('id', $id)->get();
        return view('batches.batch_edit', compact('batches'), [
            'title' => 'Batch Edit'
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $batch_name = $request->batch_name;

        $update = [
            'id' => $id,
            'batch_name' => $batch_name
        ];
        Batch::where('id', $request->id)->update($update);
        Toastr::success('Batch updated successfully!!', 'Success');
        return redirect()->route('batch/list');
    }

    public function delete($id)
    {
        $delete = Batch::find($id);
        $delete->delete();
        Toastr::success('Batch deleted successfully!!', 'Success');
        return redirect()->route('batch/list');
    }
}
