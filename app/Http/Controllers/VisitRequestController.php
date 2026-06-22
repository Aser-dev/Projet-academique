<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\VisitRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VisitRequestController extends Controller
{
    public function store(Request $request, Property $property)
    {
        if ($property->status !== 'publiee') {
            abort(403, 'Cette annonce n\'est pas disponible pour une visite.');
        }

        $data = $request->validate([
            'visit_date' => 'required|date|after:today',
            'visit_time' => 'required',
        ]);

        VisitRequest::create([
            'client_id'   => Auth::id(),
            'property_id' => $property->id,
            'agent_id'    => Auth::user()->assigned_agent_id,
            'visit_date'  => $data['visit_date'],
            'visit_time'  => $data['visit_time'],
            'status'      => 'en_attente',
        ]);

        return back()->with('success', 'Demande de visite envoyée.');
    }

    public function clientHistory(): View
    {
        $visits = VisitRequest::where('client_id', Auth::id())
            ->with('property')
            ->latest()
            ->paginate(10);

        return view('client.visits-history', compact('visits'));
    }

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

    public function updateStatus(Request $request, VisitRequest $visit)
    {
        $agentId = Auth::id();

        if ($visit->agent_id !== null && $visit->agent_id !== $agentId) {
            abort(403, 'Cette demande est assignée à un autre agent.');
        }

        $request->validate(['status' => 'required|in:validee,refusee']);

        $visit->update([
            'status'   => $request->status,
            'agent_id' => $visit->agent_id ?? $agentId,
        ]);

        return back()->with('success', 'Demande mise à jour.');
    }
}
