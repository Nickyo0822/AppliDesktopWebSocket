<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalonsController extends Controller
{
    public function create()
    {
        return view('salons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);

        $salon = new Salons();
        $salon->name = $request->name;
        $salon->image = $imageName;
        $salon->user_id = auth()->id();
        $salon->save();

        Salons::create([
            'name' => 'test'
        ])

        return redirect()->route('salons.index')->with('success','Salon créé avec succès.');
    }

    public function index()
    {
        $salons = salons::all();
        return view('salons.index', compact('salons'));
    }
}
