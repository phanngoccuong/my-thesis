<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\YearSession;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = DB::table('users')->count();
        $students = DB::table('students')->count();

        $teachers = DB::table('teachers')->count();
        $year_session = YearSession::latest()->first();
        return view('dashboard.main_dashboard', [
            'title' => 'Admin Dashboard',
            // 'users' => $users,
            // 'students' => $students,
            // 'teachers' => $teachers,
            // 'year_session' => $year_session
        ]);
    }
}
