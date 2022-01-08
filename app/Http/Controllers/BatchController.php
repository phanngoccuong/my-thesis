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
            'title' => 'Quản lý niên khóa'
        ]);
    }

    public function create()
    {
        return view('batches.batch_add', [
            'title' => 'Thêm niên khóa'
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

        Toastr::success('Thêm thành công!!', 'Success');
        return redirect()->route('batch/list');
    }

    public function edit($id)
    {
        $batches = DB::table('batches')->where('id', $id)->get();
        return view('batches.batch_edit', compact('batches'), [
            'title' => 'Chỉnh sửa niên khóa'
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
        Toastr::success('Cập nhật thành công!!', 'Success');
        return redirect()->route('batch/list');
    }

    public function delete($id)
    {
        $delete = Batch::find($id);
        $delete->delete();
        Toastr::success('Xóa thành công!!', 'Success');
        return redirect()->route('batch/list');
    }
}
