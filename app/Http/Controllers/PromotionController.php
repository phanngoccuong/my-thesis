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
    public function index()
    {
        $classes = Classes::where('group_id', '!=', 5)->get();

        return view('promtion.index', [
            'title' => 'Học sinh lên lớp',
            'classes' => $classes,
        ]);
    }

    public function create(Request $request, PromotionService $promotionService)
    {
        $class_id = $request->class_id;
        $previousYear = $promotionService->getPreviousSession();
        $latestYear = $promotionService->getLatestSession();
        if ($previousYear) {
            $datas = Promotion::with('student', 'classes')
                ->where('session_id', '=', $previousYear['id'])
                ->where('class_id', $class_id)
                ->get();
        } else
            $datas = '';


        $currentGroup = Classes::where('id', $class_id)->select('group_id')->first();
        $newClass = Classes::where('group_id', '=', $currentGroup->group_id + 1)->get();

        return view('promtion.create', [
            'title' => 'Học sinh lên lớp',
            'datas' => $datas,
            'newClass' => $newClass,
            'latestYear' => $latestYear,
            'previousYear' => $previousYear
        ]);
    }
}
