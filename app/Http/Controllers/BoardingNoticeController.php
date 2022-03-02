<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\SchoolBoarding;
use Illuminate\Http\Request;
use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;

class BoardingNoticeController extends Controller
{
    public function index()
    {
        $data = Auth::user()->notifications->take(8);

        return view('boarding-notice.boarding_list', [
            'title' => 'Thông báo nhà trường',
            'data' => $data
        ]);
    }

    public function create()
    {
        return view('boarding-notice.boarding_add', [
            'title' => 'Thông báo nhà trường'
        ]);
    }

    public function store(Request $request)
    {
        $users = User::all();
        $data = $request->only([
            'title',
            'content',
        ]);
        foreach ($users as $user) {
            $user->notify(new SchoolBoarding($data));
        }
        return redirect()->route('boarding.list');
    }
    public function readNotice()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->route('boarding.list');
    }
}
