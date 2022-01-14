<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        return view('dashboard.teacher_dashboard', [
            'title' => 'Teacher Dashboard'
        ]);
    }
}
