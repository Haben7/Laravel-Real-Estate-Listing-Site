<?php
namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index(House $house)
    {
        $images = $house->images()->get();
        return view('images.index', compact('images', 'house'));
    }

    public function create(House $house)
    {
        return view('images.create', compact('house'));
    }

    public function store(Request $request, House $house)
    {
        $data = $request->validate([
            'path' => 'required|image',
        ]);

        $path = $request->file('path')->store('images'); // Assuming image uploads

        $house->images()->create([
            'path' => $path,
        ]);

        return redirect()->route('houses.images.index', $house->id);
    }

    public function show(House $house, Image $image)
    {
        return view('images.show', compact('image', 'house'));
    }

    public function destroy(House $house, Image $image)
    {
        $image->delete();

        return redirect()->route('houses.images.index', $house->id);
    }
}