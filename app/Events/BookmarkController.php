<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookmark;
use App\Models\House;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'house_id' => 'required|exists:houses,id',
    //     ]);

    //     $bookmark = Bookmark::firstOrCreate([
    //         'user_id' => Auth::id(),
    //         'house_id' => $request->house_id,
    //     ]);

    //     return response()->json(['message' => 'House bookmarked', 'bookmark' => $bookmark], 201);
    // }

    // public function index()
    // {
    //     $bookmarks = Auth::user()->bookmarks()->with('house')->get();
    //     return response()->json($bookmarks);
    // }

    // public function destroy(House $house)
    // {
    //     $bookmark = Bookmark::where('user_id', Auth::id())
    //                         ->where('house_id', $house->id)
    //                         ->first();

    //     if ($bookmark) {
    //         $bookmark->delete();
    //         return response()->json(['message' => 'Bookmark removed'], 200);
    //     }

    //     return response()->json(['message' => 'Bookmark not found'], 404);
    // }



    public function toggleBookmark(Request $request)
    {
        $request->validate([
            'house_id' => 'required|exists:houses,id',
        ]);

        $houseId = $request->house_id;
        $userId = auth()->id(); // Assuming user authentication is in place

        // Check if the bookmark already exists
        $bookmark = Bookmark::where('user_id', $userId)
                            ->where('house_id', $houseId)
                            ->first();

        if ($bookmark) {
            // If the bookmark exists, delete it (unbookmark)
            $bookmark->delete();
            return response()->json(['message' => 'House unbookmarked successfully']);
        } else {
            // If the bookmark doesn't exist, create it
            Bookmark::create([
                'user_id' => $userId,
                'house_id' => $houseId,
            ]);
            return response()->json(['message' => 'House bookmarked successfully']);
        }
    }
}

