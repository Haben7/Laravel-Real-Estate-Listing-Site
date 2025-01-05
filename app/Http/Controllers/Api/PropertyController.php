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
        $limit = $request->query('limit', 5); // Default limit to 5

        // Paginate houses with necessary relationships
        $houses = House::with(['images', 'site.owner'])->paginate($limit);

        // Return the paginated data with the resource collection
        return response()->json([
            'data' => HouseResource::collection($houses->items()), // Current page data
            'totalPages' => $houses->lastPage(), // Total number of pages
            'currentPage' => $houses->currentPage(), // Current page number
            'totalItems' => $houses->total(), // Total number of houses
        ]);
    }
}
