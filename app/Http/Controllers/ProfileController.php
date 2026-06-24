<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $stats = [];

        switch ($user->role) {
            case 'client':
                $stats = [
                    'Favoris' => $user->favorites()->count(),
                    'Demandes de visite' => $user->visitRequests()->count(),
                    'Agent assigné' => $user->assignedAgent ? $user->assignedAgent->name : 'Aucun agent',
                ];
                break;
            case 'bailleur':
                $stats = [
                    'Annonces publiées' => $user->properties()->where('status', 'publiee')->count(),
                    'Vues totales' => $user->properties()->sum('views_count'),
                    'Demandes de visite' => \App\Models\VisitRequest::whereIn('property_id', $user->properties()->pluck('id'))->count(),
                ];
                break;
            case 'agent':
                $stats = [
                    'Validations en attente' => \App\Models\Property::where('status', 'en_attente')->count(),
                    'Visites assignées' => \App\Models\VisitRequest::where('agent_id', $user->id)->count(),
                    'Clients suivis' => $user->agentAffectations()->count(),
                ];
                break;
            case 'manager':
                $stats = [
                    'Utilisateurs actifs' => \App\Models\User::where('is_active', true)->count(),
                    'Clients' => \App\Models\User::where('role', 'client')->count(),
                    'Agents' => \App\Models\User::where('role', 'agent')->count(),
                ];
                break;
        }

        return view('profile.edit', [
            'user' => $user,
            'stats' => $stats,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
