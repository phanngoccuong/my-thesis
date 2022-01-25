<?php

namespace App\Http\Controllers\StudentRole;

use App\Http\Controllers\Controller;
use App\Models\Reward;
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

    public function showProfile()
    {
        $currentUserEmail = Auth::user()->email;
        $currentUser = Student::where('email', '=', $currentUserEmail)->first();

        $studentInfo = Student::where('email', '=', $currentUserEmail)
            ->with('batches')
            ->first();

        $rewards = Reward::where('student_id', $currentUser->id)->get();
        return view('RoleStudent.student_profile', [
            'title' => 'Student Profile',
            'studentInfo' => $studentInfo,
            'rewards' => $rewards
        ]);
    }
}
