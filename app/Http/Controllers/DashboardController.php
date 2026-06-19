<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\VisitRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function client(): View
    {
        $favorites = Auth::user()->favorites()->with('property.photos')->latest('favorites.created_at')->get();
        $visits = Auth::user()->visitRequests()->with('property')->latest()->get();
        return view('dashboard.client', compact('favorites', 'visits'));
    }

    public function bailleur(): View
    {
        $properties = Auth::user()->properties()->with('photos')->latest()->get();
        return view('dashboard.bailleur', compact('properties'));
    }

    public function agent(): View
    {
        $pendingValidations = Property::where('status', 'en_attente')->count();
        $pendingVisits = VisitRequest::whereNull('agent_id')
                            ->orWhere('agent_id', Auth::id())
                            ->where('status', 'en_attente')
                            ->count();
        return view('dashboard.agent', compact('pendingValidations', 'pendingVisits'));
    }

    public function manager(): View|RedirectResponse
    {
        return redirect()->route('manager.dashboard');
    }
}