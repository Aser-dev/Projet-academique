<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidationController extends Controller
{
    public function index()
    {
        $properties = Property::where('status', 'en_attente')->paginate(10);
        return view('agent.validations', compact('properties'));
    }

    public function validate(Property $property)
    {
        $property->update([
            'status'       => 'publiee',
            'validated_by' => Auth::id(),
        ]);
        return back()->with('success', 'Annonce publiée.');
    }

    public function reject(Request $request, Property $property)
    {
        $request->validate(['reason' => 'required|string|max:500']);
        $property->update([
            'status'           => 'retiree',
            'rejection_reason' => $request->reason,
            'validated_by'     => Auth::id(),
        ]);
        return back()->with('success', 'Annonce refusée.');
    }
}