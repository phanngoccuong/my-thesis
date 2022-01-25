<?php

namespace App\Http\Controllers;

use App\Http\Requests\YearRequest;
use App\Models\YearSession;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class YearSessionController extends Controller
{
    public function index()
    {
        $years = YearSession::orderBy('session_name', 'asc')->paginate(10);
        return view('year_session.session_all', [
            'title' => 'Quản lý năm học',
            'years' => $years
        ]);
    }
    public function create()
    {
        return view('year_session.session_add', [
            'title' => 'Quản lý năm học'
        ]);
    }
    public function store(YearRequest $request)
    {

        $year_session = new YearSession;
        $year_session->session_name = $request->session_name;
        $year_session->save();
        Toastr::success('Thêm năm học mới thành công!!', 'Success');
        return redirect()->route('session.list');
    }
    public function edit($id)
    {
        $years = YearSession::findOrFail($id);
        return view('year_session.session_edit',  [
            'title' => 'Chỉnh sửa năm học ',
            'years' => $years
        ]);
    }

    public function update(YearRequest $request)
    {
        $id = $request->id;
        $session_name = $request->session_name;

        $update = [
            'id' => $id,
            'session_name' => $session_name,
        ];
        YearSession::where('id', $request->id)->update($update);
        Toastr::success('Cập nhật  thành công!!', 'Success');
        return redirect()->route('session.list');
    }

    public function delete($id)
    {
        $delete = YearSession::find($id);
        $delete->delete();
        Toastr::success('Xóa thành công!!', 'Success');
        return redirect()->route('session.list');
    }
}
