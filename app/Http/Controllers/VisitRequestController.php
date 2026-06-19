<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\VisitRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitRequestController extends Controller
{
    public function store(Request $request, Property $property)
    {
        $data = $request->validate([
            'visit_date' => 'required|date|after:today',
            'visit_time' => 'required',
        ]);

        VisitRequest::create([
            'client_id'   => Auth::id(),
            'property_id' => $property->id,
            'agent_id'    => null,
            'visit_date'  => $data['visit_date'],
            'visit_time'  => $data['visit_time'],
            'status'      => 'en_attente',
        ]);

        return back()->with('success', 'Demande de visite envoyée.');
    }

    // Agent : liste des visites à traiter
    public function agentIndex()
    {
        $agentId = Auth::id();

        $visits = VisitRequest::with(['client:id,name', 'property:id,title,status,type,location'])
            ->where(function ($q) use ($agentId) {
                $q->where('agent_id', $agentId)
                    ->orWhereNull('agent_id');
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('agent.visits', compact('visits'));
    }

    // Agent : accepter / refuser
    public function updateStatus(Request $request, VisitRequest $visit)
    {
        $request->validate(['status' => 'required|in:validee,refusee']);
        $visit->update(['status' => $request->status]);
        return back()->with('success', 'Demande mise à jour.');
    }
}