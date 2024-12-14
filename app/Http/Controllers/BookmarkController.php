<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function store(Request $request)
    {
        // Validate and process the incoming data
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'house_id' => 'required|integer',
        ]);

        // Save the bookmark
        $bookmark = Bookmark::create($validated);

        return response()->json(['message' => 'Bookmark created successfully!', 'bookmark' => $bookmark], 201);
    }
}
