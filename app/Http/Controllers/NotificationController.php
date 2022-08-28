<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function index(Request $request)

    {
        $notifications = auth()->user()->unreadNotifications;
        $user = Auth::user();
        return view('notification',compact('notifications','user'));

    }


    public function update(Request $request, DatabaseNotification $notification)
    {
        $notification->markAsRead();

        return redirect()->route('dashboard');
    }




}
