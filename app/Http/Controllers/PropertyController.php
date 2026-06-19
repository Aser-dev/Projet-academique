<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyPhoto;
use App\Models\PropertyUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class PropertyController extends Controller
{
    // Liste publique
    public function index(Request $request)
    {
        $query = Property::where('status', 'publiee')->with('photos');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                  ->orWhere('location', 'like', '%'.$request->search.'%')
                  ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }
        if ($request->filled('type'))   $query->where('type', $request->type);
        if ($request->filled('option')) $query->where('option', $request->option);
        if ($request->filled('location')) $query->where('location', 'like', '%'.$request->location.'%');
        if ($request->filled('usage')) {
            $query->whereHas('usages', fn($q) => $q->where('usage', $request->usage));
        }
        if ($request->filled('price_range')) $query->where('price', '<=', $request->price_range);
        if ($request->filled('beds'))  $query->where('rooms', '>=', $request->beds);

        $properties = $query->latest()->paginate(12);
        return view('properties.index', compact('properties'));
    }

    // Fiche détaillée
    public function show(Property $property)
    {
        $property->increment('views_count');
        return view('properties.show', compact('property'));
    }

    // Mes annonces (bailleur)
    public function myProperties()
    {
        $properties = Property::where('user_id', Auth::id())->latest()->get();
        return view('bailleur.index', compact('properties'));
    }

    // Formulaire de création
    public function create()
    {
        return view('bailleur.create');
    }

    // Enregistrement
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:200',
            'description'  => 'required',
            'price'        => 'required|numeric',
            'superficie'   => 'required|numeric',
            'location'     => 'required|string|max:200',
            'type'         => 'required|in:terrain,batiment,appartement,villa,commerce',
            'option'       => 'required|in:location,vente',
            'rooms'        => 'nullable|integer',
            'floor'        => 'nullable|integer',
            'furnished'    => 'boolean',
            'usages'       => 'required|array|min:1',
            'usages.*'     => 'string|in:residence,bureau,commerce,agriculture',
            'photos'       => 'required|array|min:1|max:5',
            'photos.*'     => 'image|max:2048',
        ]);

        $data['user_id'] = Auth::id();
        $data['status'] = 'en_attente';
        $property = Property::create($data);

        foreach ($request->usages as $usage) {
            PropertyUsage::create(['property_id' => $property->id, 'usage' => $usage]);
        }

        foreach ($request->file('photos') as $photo) {
            $path = $photo->store('property_photos', 'public');
            PropertyPhoto::create(['property_id' => $property->id, 'path' => $path]);
        }

        return redirect()->route('bailleur.properties')->with('success', 'Annonce déposée.');
    }

    // Modification (simplifiée)
    public function edit(Property $property)
    {
        if ($property->user_id !== Auth::id()) abort(403);
        return view('bailleur.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        if ($property->user_id !== Auth::id()) abort(403);
        $data = $request->validate([
            'title'        => 'required|string|max:200',
            'description'  => 'required',
            'price'        => 'required|numeric',
            'superficie'   => 'required|numeric',
            'location'     => 'required|string|max:200',
            'type'         => 'required|in:terrain,batiment,appartement,villa,commerce',
            'option'       => 'required|in:location,vente',
            'rooms'        => 'nullable|integer',
            'floor'        => 'nullable|integer',
            'furnished'    => 'boolean',
        ]);
        $property->update($data);
        return redirect()->route('bailleur.properties')->with('success', 'Annonce modifiée.');
    }

    public function destroy(Property $property)
    {
        if ($property->user_id !== Auth::id()) abort(403);
        foreach ($property->photos as $photo) {
            Storage::disk('public')->delete($photo->path);
        }
        $property->delete();
        return redirect()->route('bailleur.properties')->with('success', 'Annonce supprimée.');
    }
}