<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Promotion;
use App\Services\PromotionService;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

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
        $studentPromo =
            Promotion::where('session_id',  $request->session_id)
            ->where('student_id', $request->student_id)
            ->get();
        if ($studentPromo) {
            Toastr::error('Học sinh đã được lên lớp!!', 'Failed');
            return redirect()->back();
        }
        try {
            $studentRequest = $request->student_id;
            if ($studentRequest) {
                for ($i = 0; $i < count($request->student_id); $i++) {
                    $data = new Promotion();
                    $data->student_id = $request->student_id[$i];
                    $data->class_id = $request->class_id[$i];
                    $data->session_id = $request->session_id;
                    $data->save();
                }
                Toastr::success('Chuyển lớp thành công!!', 'Success');
                return redirect()->back();
            }
        } catch (
            \Exception
            $err
        ) {
            Toastr::error('Vui lòng nhập lớp mới của tất cả học sinh!!', 'Thất bại');
            return redirect()->back();
        }
    }
}
