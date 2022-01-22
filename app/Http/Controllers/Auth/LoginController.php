<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock'
        ]);
    }


    public function login()
    {

        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $email    = $request->email;
        $password = $request->password;

        $remember_me    =   $request->has('remember_me') ? true : false;
        if (auth()->attempt(['email' => $email, 'password' => $password], $remember_me)) {
            $user = auth()->user();
        } else {
            Toastr::error('fail, Sai email hoặc mật khẩu!!', 'Error');
            return back();
        }

        $dt         = Carbon::now();
        $todayDate  = $dt->toDayDateTimeString();

        // $activityLog = [

        //     'name'        => $email,
        //     'email'       => $email,
        //     'description' => 'has log in',
        //     'date_time'   => $todayDate,
        // ];
        if (Auth::attempt(['email' => $email, 'password' => $password,])) {

            // DB::table('activity_logs')->insert($activityLog);
            Toastr::success('Đăng nhập thành công!!', 'Success');
            if (Auth::user()->role_name == 'Admin') {
                return redirect()->route('home');
            }
            if (Auth::user()->role_name == 'Student') {
                return redirect()->route('homeStudent');
            }
            if (Auth::user()->role_name == 'Teacher') {
                return   redirect()->route('homeTeacher');
            }
            // return redirect()->intended('home');


        } else {
            Toastr::error('Sai email hoặc mật khẩu!!', 'Error');
            return redirect('login');
        }
    }

    public function logout()
    {
        $user = Auth::User();
        Session::put('user', $user);
        $user = Session::get('user');

        $name       = $user->name;
        $email      = $user->email;
        $dt         = Carbon::now();
        $todayDate  = $dt->toDayDateTimeString();

        // $activityLog = [

        //     'name'        => $name,
        //     'email'       => $email,
        //     'description' => 'has logged out',
        //     'date_time'   => $todayDate,
        // ];
        // DB::table('activity_logs')->insert($activityLog);
        Auth::logout();
        Toastr::success('Đăng xuất thành công!!', 'Success');
        return redirect('login');
    }
}
