<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalonsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Salons;
use Illuminate\Support\Facades\Auth;

class SalonsController extends Controller
{
    public function create()
    {
        return view('salons.create');
    }

    public function store(SalonsRequest $request)
{

    if ($image = $request->file('salonimage')){
            $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('images/salons', $imageName);

        Salons::create([
            'name' => $request->validated()['salonname'],
            'image' => $imageName,
            'user_id' => Auth::id(),
        ]);
    }

    return redirect()->route('salons.index')->with('success', 'Salon créé avec succès.');
}


public function index()
{
    $salons = Salons::all();
    return view('index', compact('salons'));
}

public function update(SalonsRequest $request, $id)
{
    $salon = Salons::findOrFail($id);

    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/salons'), $imageName);
        $salon->image = $imageName;
    }

    $salon->name = $request->name;
    $salon->save();

    return redirect()->route('salons.index')->with('success', 'Salon mis à jour avec succès.');
}


}
