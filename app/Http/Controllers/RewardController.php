<?php

namespace App\Http\Controllers;

use App\Imports\RewardImport;
use App\Models\Reward;
use App\Models\Semester;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::with('student', 'classes', 'semester')->orderBy('semester_id', 'desc')->paginate(10);
        $semesters = Semester::orderBy('id', 'desc')->get();
        return view('reward.reward_list', [
            'title' => 'Quản lý khen thưởng',
            'rewards' => $rewards,
            'semesters' => $semesters
        ]);
    }
    public function ImportExcel(Request $request)
    {
        $file = $request->file('file')->getRealPath();
        Excel::import(new RewardImport, $file);
        Toastr::success('Nhập khen thưởng thành công', 'Thành công');
        return redirect()->route('reward.list');
    }
    public function delete($id)
    {
        $delete = Reward::find($id);
        $delete->delete();
        Toastr::success('Xóa  thành công!!', 'Success');
        return redirect()->route('reward.list');
    }
    public function PDFGenerate(Request $request)
    {
        $rewards = Reward::with('student', 'classes', 'semester')->orderBy('semester_id', 'desc')->get();
        $exportPDF = PDF::loadView('reward.pdf_view', ['rewards' => $rewards]);
        $exportPDF->setPaper(
            'A4',
            'landscape'
        );
        $exportPDF->stream();
        return $exportPDF->download('danh_sach_khen_thuong.pdf');
    }
    public function search(Request $request)
    {
        if ($request->semester_id) {
            $rewards = Reward::where('semester_id', $request->semester_id)
                ->orderBy('student_id', 'asc')->paginate(10);
        }
        $semesters = Semester::orderBy('id', 'desc')->get();
        return view('reward.reward_search', compact('rewards'), [
            'title' => 'Danh sách học sinh',
            'semesters' => $semesters
        ]);
    }
}
