<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = auth()->user()->inquiries; // Fetch inquiries for this owner
        return view('owner.inquiries.index', compact('inquiries'));
    }

    public function show($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        return view('owner.inquiries.show', compact('inquiry'));
    }

    public function reply(Request $request, $id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $request->validate(['reply' => 'required|string']);


        return redirect()->route('inquiries.index')->with('success', 'Reply sent');
    }
}
