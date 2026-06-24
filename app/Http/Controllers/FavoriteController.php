<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Request $request, Property $property)
    {
        $user = Auth::user();
        $shouldReturnJson = $request->expectsJson() || $request->isJson();

        $favorite = $user->favorites()->where('property_id', $property->id)->first();

        if ($favorite) {
            $favorite->delete();

            if ($shouldReturnJson) {
                return response()->json([
                    'favorited' => false,
                    'message' => 'Annonce retiree des favoris.',
                ]);
            }

            return back()->with('success', 'Annonce retiree des favoris.');
        }

        $user->favorites()->create(['property_id' => $property->id]);

        if ($shouldReturnJson) {
            return response()->json([
                'favorited' => true,
                'message' => 'Annonce ajoutee aux favoris.',
            ]);
        }

        return back()->with('success', 'Annonce ajoutee aux favoris.');
    }

    public function index()
    {
        $favorites = Auth::user()->favorites()->with('property')->latest()->get();
        return view('client.favorites', compact('favorites'));
    }
}

