<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Form;
use App\Rules\MatchOldPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserManagementController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_name == 'Admin') {
            $data = User::paginate(10);
            return view('usermanagement.user_control',  [
                'title' => 'User All',
                'data' => $data
            ]);
        } else {
            return redirect()->route('home');
        }
    }
    // view detail
    public function viewDetail($id)
    {
        if (Auth::user()->role_name == 'Admin') {
            $data = User::findOrFail($id);

            return view('usermanagement.view_users', compact('data'), [
                'title' => 'User Detail'
            ]);
        } else {
            return redirect()->route('main_dashboard');
        }
    }

    // // activity log
    // public function activityLogInLogOut()
    // {
    //     $activityLog = DB::table('activity_logs')->get();
    //     return view('usermanagement.activity_log', compact('activityLog'), [
    //         'title' => 'User activity'
    //     ]);
    // }

    // profile user
    public function profile()
    {
        return view('usermanagement.profile_user', [
            'title' => 'User profile'
        ]);
    }

    // add new user
    public function addNewUser()
    {
        return view('usermanagement.add_new_user', [
            'title' => 'User Add'
        ]);
    }

    // save new user
    public function addNewUserSave(Request $request)
    {

        $request->validate([
            'name'      => 'required|string|max:255',
            'role_name' => 'required|string|max:255',
            'password'  => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        // $image = time() . '.' . $request->image->extension();
        // $request->image->move(public_path('/assets/images/'), $image);

        $user = new User;
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->role_name    = $request->role_name;
        $user->password     = Hash::make($request->password);

        $user->save();

        Toastr::success('Create new account successfully!!', 'Success');
        return redirect()->route('userManagement');
    }

    // update
    public function update(Request $request)
    {
        $id           = $request->id;
        $name         = $request->name;
        $email        = $request->email;
        $role_name    = $request->role_name;

        $dt       = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();

        // $old_image = User::find($id);

        // $image_name = $request->hidden_image;
        // $image = $request->file('image');

        // if ($old_image->avatar == 'photo_defaults.jpg') {
        //     if ($image != '') {
        //         $image_name = rand() . '.' . $image->getClientOriginalExtension();
        //         $image->move(public_path('images'), $image_name);
        //     }
        // } else {

        //     if ($image != '') {
        //         $image_name = rand() . '.' . $image->getClientOriginalExtension();
        //         $image->move(public_path('images'), $image_name);
        //         unlink('images/' . $old_image->avatar);
        //     }
        // }


        $update = [
            'id'           => $id,
            'name'         => $name,
            'email'        => $email,
            'role_name'    => $role_name,
        ];

        User::where('id', $request->id)->update($update);
        Toastr::success('Cập nhật tài khoản thành công', 'Success');
        return redirect()->route('userManagement');
    }
    // delete
    public function delete($id)
    {
        $user = Auth::User();
        Session::put('user', $user);
        $user = Session::get('user');

        $fullName     = $user->name;
        $email        = $user->email;
        $role_name    = $user->role_name;

        $dt       = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();

        $delete = User::find($id);
        unlink('assets/images/' . $delete->avatar);
        $delete->delete();
        Toastr::success('User deleted successfully :)', 'Success');
        return redirect()->route('userManagement');
    }

    // view change password
    public function changePasswordView()
    {
        return view('usermanagement.change_password', [
            'title' => 'User password change'
        ]);
    }

    // change password in db
    public function changePasswordDB(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        Toastr::success('User change successfully :)', 'Success');
        return redirect()->route('dashboard.main_dashboard');
    }
}
