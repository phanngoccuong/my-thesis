<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromotionRequest;
use App\Models\Classes;
use App\Models\Promotion;
use App\Models\Student;
use App\Services\PromotionService;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class PromotionController extends Controller
{
    public function index(PromotionService $promotionService)
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
    public function store(PromotionRequest $request)
    {
        $studentPromo =
            Promotion::where('session_id',  $request->session_id)
            ->where('student_id', $request->student_id)
            ->first();
        if ($studentPromo) {
            Toastr::error('Học sinh đã được lên lớp!!', 'Thất bại');
            return redirect()->back();
        }


        // $latestYear = $promotionService->getLatestSession();

        // $classRequest = $request->class_id;
        // $students = Student::all();

        // foreach ($request->datas as $student_id => $class_id) {
        //     $student = $students->find($student_id);
        //     $session_id = $latestYear->id;
        //     $student->classes()->attach($class_id, ['session_id' => $session_id]);
        // }

        $studentRequest = $request->student_id;

        if ($studentRequest) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $promo = new Promotion;
                $promo->student_id = $request->student_id[$i];
                $promo->class_id = $request->class_id[$i];
                $promo->session_id = $request->session_id;
                $promo->save();
            }
            Toastr::success('Lên lớp thành công!!', 'Success');
            return redirect()->route('promotion.index');
        }
    }
}
