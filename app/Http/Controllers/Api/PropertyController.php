<?php

// namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
// use App\Http\Resources\HouseResource;
// use App\Models\Property;
// use App\Models\House;
// use Illuminate\Http\Request;

// class PropertyController extends Controller
// {
//     public function index()
//     {
//         $houses = House::with('images')->get(); // Fetch houses with images

//         if ($houses->isNotEmpty()) { // Check if the collection is not empty
//             return HouseResource::collection($houses);
//         } else {
//             return response()->json(['message' => 'No record available'], 200);
//         }
//     }

    
// }
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HouseResource;
use App\Models\House;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        // Get 'page' and 'limit' from the request, with default values
        $page = $request->query('page', 1);  // Default page is 1
        $limit = $request->query('limit', 5);  // Default limit per page is 10

        // Paginate the houses
        $houses = House::with('images')->paginate($limit);

        if ($houses->isNotEmpty()) {
            return response()->json([
                'data' => HouseResource::collection($houses),
                'totalPages' => $houses->lastPage(),
                'currentPage' => $houses->currentPage(),
            ]);
        } else {
            return response()->json(['message' => 'No record available'], 200);
        }
    }
}


