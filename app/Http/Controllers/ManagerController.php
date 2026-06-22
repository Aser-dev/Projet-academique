<?php

namespace App\Http\Controllers;

use App\Models\ClientAgent;
use App\Models\User;
use App\Models\Property;
use App\Models\VisitRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    // EF-D7: Dashboard statistique
    public function dashboard()
    {
        $totalProperties = (int) Property::count();

        $stats = [
            'total_properties' => $totalProperties,
            'published_properties' => Property::where('status', 'publiee')->count(),
            'pending_validations' => Property::where('status', 'en_attente')->count(),
            'properties_by_type' => Property::select('type')
                ->selectRaw('count(*) as count')
                ->groupBy('type')
                ->orderByRaw('count(*) desc')
                ->get(),
            'visits_requested' => VisitRequest::count(),
            'total_clients' => User::where('role', 'client')->count(),
            'total_bailheurs' => User::where('role', 'bailleur')->count(),
            'total_agents' => User::where('role', 'agent')->count(),
            'recent_visits' => VisitRequest::with(['client:id,name', 'property:id,title,status'])
                ->latest()
                ->limit(10)
                ->get(),
        ];

        return view('manager.dashboard', compact('stats'));
    }

    // EF-D7: Page statistiques détaillées
    public function stats()
    {
        $stats = [
            'total_users'        => User::count(),
            'total_properties'   => Property::count(),
            'published'          => Property::where('status', 'publiee')->count(),
            'pending_validation' => Property::where('status', 'en_attente')->count(),
            'visits_today'       => VisitRequest::whereDate('created_at', today())->count(),
        ];
        return view('manager.stats', compact('stats'));
    }

    // EF-D5: Gestion des utilisateurs
    public function users(Request $request)
    {
        $query = User::query()->where('role', '!=', 'manager');

        if ($request->filled('q')) {
            $q = $request->string('q')->trim();
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', '%' . $q . '%')
                    ->orWhere('email', 'like', '%' . $q . '%');
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->string('role'));
        }

        if ($request->filled('is_active')) {
            $isActive = $request->boolean('is_active');
            $query->where('is_active', $isActive);
        }

        $users = $query->orderByDesc('id')->paginate(15)->withQueryString();
        return view('manager.users', compact('users'));
    }

    // EF-D5: Créer utilisateur
    public function createUser()
    {
        return view('manager.users.create');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:client,bailleur,agent',
            'phone' => 'nullable|string|max:20',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);

        return redirect()->route('manager.users')->with('success', 'Utilisateur créé avec succès');
    }

    // EF-D5: Éditer utilisateur
    public function editUser(User $user)
    {
        return view('manager.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:client,bailleur,agent',
            'phone' => 'nullable|string|max:20',
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8|confirmed']);
            $validated['password'] = bcrypt($request->password);
        }

        $user->update($validated);
        return redirect()->route('manager.users')->with('success', 'Utilisateur modifié');
    }

    // EF-D5: Supprimer utilisateur
    public function deleteUser(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        if ($user->role === 'manager') {
            return back()->with('error', 'Impossible de supprimer un manager.');
        }

        $user->delete();

        return redirect()->route('manager.users')->with('success', 'Utilisateur supprimé');
    }

    public function toggleActive(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Vous ne pouvez pas suspendre votre propre compte.');
        }

        if ($user->role === 'manager') {
            return back()->with('error', 'Impossible de suspendre un manager.');
        }

        $user->update(['is_active' => ! $user->is_active]);

        return back()->with('success', 'Statut modifié.');
    }

    // EF-D6: Affecter client à agent
    public function affectClient(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:users,id,role,client',
            'agent_id'  => 'required|exists:users,id,role,agent',
        ]);

        $client = User::findOrFail($request->client_id);
        $client->update(['assigned_agent_id' => $request->agent_id]);

        ClientAgent::updateOrCreate(
            ['client_id' => $client->id],
            [
                'agent_id'    => $request->agent_id,
                'assigned_by' => Auth::id(),
            ]
        );

        return back()->with('success', 'Client affecté à l\'agent.');
    }

    // EF-D8: Retirer une annonce
    public function withdrawProperty(Property $property)
    {
        $property->update(['status' => 'retiree']);
        return back()->with('success', 'Annonce retirée.');
    }

}