<?php

namespace App\Http\Controllers;

use App\Models\RealEstate;
use Illuminate\Http\Request;

class RealEstateController extends Controller
{
    public function index()
    {
        $realEstates = RealEstate::with('owner')->get();
        return view('realestates.index', compact('realEstates'));
    }

    public function create()
    {
        return view('realestates.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'location' => 'required',
            'owner_id' => 'required',
        ]);

        RealEstate::create($data);

        return redirect()->route('realestates.index');
    }

    public function show(RealEstate $realEstate)
    {
        return view('realestates.show', compact('realEstate'));
    }

    public function edit(RealEstate $realEstate)
    {
        return view('realestates.edit', compact('realEstate'));
    }

    public function update(Request $request, RealEstate $realEstate)
    {
        $data = $request->validate([
            'title' => 'required',
            'location' => 'required',
        ]);

        $realEstate->update($data);

        return redirect()->route('realestates.index');
    }

    public function destroy(RealEstate $realEstate)
    {
        $realEstate->delete();
        return redirect()->route('realestates.index');
    }
}
