<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications; // Fetch notifications
        return view('owner.notifications.index', compact('notifications'));
    }
}
