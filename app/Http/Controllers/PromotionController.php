<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Promotion;
use App\Services\PromotionService;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PromotionController extends Controller
{
    public function index(Request $request, PromotionService $promotionService)
    {
        $classes = Classes::where('group_id', '!=', 5)->get();
        $previousYear = $promotionService->getPreviousSession();
        $previousSessionClasses = $promotionService->getClasses($previousYear['id']);
        // dd($previousSessionClasses);
        return view('promtion.index', [
            'title' => 'Học sinh lên lớp',
            'classes' => $classes,
            'previousSessionClasses' => $previousSessionClasses
        ]);
    }

    public function create(Request $request, PromotionService $promotionService)
    {
        $class_id = $request->class_id;
        $previousYear = $promotionService->getPreviousSession();
        $latestYear = $promotionService->getLatestSession();

        $datas = Promotion::with('student', 'classes')
            ->where('session_id', '=', $previousYear['id'])
            ->where('class_id', $class_id)
            ->get();

        $currentGroup = Classes::where('id', $class_id)->select('group_id')->first();
        $newClass = Classes::where('group_id', '=', $currentGroup->group_id + 1)->get();

        return view('promtion.create', [
            'title' => 'Học sinh lên lớp',
            'datas' => $datas,
            'newClass' => $newClass,
            'latestYearId' => $latestYear->id,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'class_id.*' => 'required',
            'student_id' => 'required',
            'session_id' => 'required'
        ], [
            'class_id.*.required' => 'Vui lòng nhập lớp'
        ]);
        $studentPromo =
            Promotion::where('session_id',  $request->session_id)
            ->where('student_id', $request->student_id)
            ->first();
        // dd($request->student_id);
        if ($studentPromo) {
            Toastr::error('Học sinh đã được lên lớp!!', 'Thất bại');
            return redirect()->back();
        }
        $studentRequest = $request->student_id;
        foreach ($studentRequest as $key => $value) {
            $save = [
                'student_id' => $request->student_id[$key],
                'class_id' => $request->class_id[$key],
                'session_id' => $request->session_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('promotions')->insert($save);
        }
        Toastr::success('Lên lớp thành công!!', 'Success');
        return redirect()->route('promotion.index');
    }
}
