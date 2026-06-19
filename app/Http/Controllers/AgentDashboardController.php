<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\VisitRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Endpoint JSON pour rafraîchir dynamiquement le tableau de bord Agent.
 */


class AgentDashboardController extends Controller
{
    public function stats(Request $request): JsonResponse
    {
        $agentId = Auth::id();

        $pendingValidations = Property::where('status', 'en_attente')->count();

        $pendingVisits = VisitRequest::where('status', 'en_attente')
            ->where(function ($q) use ($agentId) {
                // Même logique que VisitRequestController@agentIndex :
                // - soit la demande est déjà assignée à l'agent
                // - soit elle n'a pas encore d'agent
                //
                // IMPORTANT: dans votre app, l'agent ne devrait voir QUE les demandes
                // qu'il a potentiellement à traiter : celles assignées à lui OU sans agent.
                $q->where('agent_id', $agentId)
                    ->orWhereNull('agent_id');
            })
            ->count();

        // NOTE: same logic as current Blade (properties of current user)
        $propertiesCount = Property::where('user_id', $agentId)->count();

        return response()->json([
            'pendingValidations' => $pendingValidations,
            'pendingVisits' => $pendingVisits,
            'propertiesCount' => $propertiesCount,
        ]);
    }
}

