<?php

namespace App\Http\Controllers;

use App\Http\Requests\BatchRequest;
use App\Models\Batch;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
{
    public function index()
    {
        $batchShow = Batch::orderBy('id', 'desc')->paginate(10);
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
    public function store(BatchRequest $request)
    {
        $batches = new Batch;
        $batches->batch_name = $request->batch_name;
        $batches->save();

        Toastr::success('Thêm thành công!!', 'Success');
        return redirect()->route('batch.list');
    }

    public function edit($id)
    {
        $batches = Batch::findOrFail($id);
        return view('batches.batch_edit', compact('batches'), [
            'title' => 'Chỉnh sửa niên khóa'
        ]);
    }

    public function update(BatchRequest $request)
    {
        $id = $request->id;
        $batch_name = $request->batch_name;

        $update = [
            'id' => $id,
            'batch_name' => $batch_name
        ];
        Batch::where('id', $request->id)->update($update);
        Toastr::success('Cập nhật thành công!!', 'Success');
        return redirect()->route('batch.list');
    }

    public function delete($id)
    {
        $delete = Batch::find($id);
        $delete->delete();
        Toastr::success('Xóa thành công!!', 'Success');
        return redirect()->route('batch.list');
    }
}
