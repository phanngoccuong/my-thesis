<?php

namespace App\Http\Controllers\TeacherRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        return view('dashboard.teacher_dashboard', [
            'title' => 'Teacher Dashboard'
        ]);
    }
}
