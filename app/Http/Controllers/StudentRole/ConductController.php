<?php

namespace App\Http\Controllers\StudentRole;

use App\Http\Controllers\Controller;
use App\Models\Conduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class ConductController extends Controller
{
    public function index()
    {
        $currentUserEmail = Auth::user()->email;
        $student = Student::where('email', '=', $currentUserEmail)
            ->first();
        $data = Conduct::where('student_id', $student->id)->orderBy('semester_id', 'asc')->get();
        return view('RoleStudent.conduct.conduct_all', [
            'title' => 'Hạnh kiểm',
            'data' => $data,
        ]);
    }
}
