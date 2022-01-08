<?php

namespace App\Http\Controllers\StudentRole;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Models\Student;
use App\Services\PromotionService;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    public function index()
    {
        return view('dashboard.student_dashboard', [
            'title' => 'Student Dashboard'
        ]);
    }

    public function showProfile(PromotionService $promotionService)
    {
        $currentUserEmail = Auth::user()->email;
        $currentYear = $promotionService->getLatestSession();
        $currentYearId = $currentYear['id'];
        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->join('promotions', 'promotions.student_id', '=', 'students.id')
            ->where('promotions.session_id', $currentYearId)
            ->with('batches')
            ->join('classes', 'classes.id', '=', 'promotions.class_id')
            ->select('classes.class_name', 'students.*')
            ->first();
        // dd($studentInfo);
        return view('RoleStudent.student_profile', [
            'title' => 'Student Profile',
            'studentInfo' => $studentInfo
        ]);
    }
}
