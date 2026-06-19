<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyPhoto;
use App\Models\PropertyUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AgencyPropertyController extends Controller
{
    public function index()
    {
        $properties = Property::where('is_agency', true)
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get();
        return view('agent.properties', compact('properties'));
    }

    public function create()
    {
        return view('agent.create_agency_property');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:200',
            'description'  => 'required|string',
            'price'        => 'required|numeric|min:0',
'superficie'   => 'required|numeric|min:0',

            // Le formulaire envoie `localisation`
            // mais la colonne DB s'appelle `location`
            'localisation' => 'required|string|max:300',
            'type'         => 'required|in:terrain,batiment,appartement,villa,commerce',
            'option_type'  => 'required|in:location,vente',
            'rooms'        => 'nullable|integer|min:0',
            'floor'        => 'nullable|integer|min:0',
            'furnished'    => 'nullable|boolean',
            'usages'       => 'required|array|min:1',
            'usages.*'     => 'string|in:residence,bureau,commerce,agriculture',
            'photos'       => 'required|array|min:1|max:5',
            'photos.*'     => 'image|max:2048',
        ]);

        $data['user_id']   = Auth::id();
        $data['is_agency'] = true;
$data['status']    = 'publiee';

        // La colonne DB s'appelle `location`.
        // Le formulaire envoie `localisation`.
        $data['location'] = $data['localisation'] ?? null;
        unset($data['localisation']);

        $property = Property::create($data);

        foreach ($request->usages as $usage) {
            PropertyUsage::create(['property_id' => $property->id, 'usage' => $usage]);
        }

        foreach ($request->file('photos') as $photo) {
            $path = $photo->store('property_photos', 'public');
            PropertyPhoto::create(['property_id' => $property->id, 'path' => $path]);
        }

        return redirect()->route('agent.properties')
            ->with('success', 'Annonce agence publiée avec succès.');
    }
}