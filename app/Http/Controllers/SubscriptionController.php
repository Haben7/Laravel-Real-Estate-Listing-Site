<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscription = auth()->user()->subscription; // Fetch subscription data
        return view('owner.subscriptions.index', compact('subscription'));
    }

    public function upgrade(Request $request)
    {
        // Upgrade logic here
        return redirect()->route('subscriptions.index')->with('success', 'Subscription Upgraded');
    }

    public function history()
    {
        $history = auth()->user()->subscriptionHistory; // Fetch payment history
        return view('owner.subscriptions.history', compact('history'));
    }
}
