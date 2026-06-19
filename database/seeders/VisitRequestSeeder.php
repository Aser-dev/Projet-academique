<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use App\Models\VisitRequest;
use Illuminate\Database\Seeder;

class VisitRequestSeeder extends Seeder
{
    public function run(): void
    {
        $client3 = User::firstWhere('email', 'client3@immo.com');
        $client4 = User::firstWhere('email', 'client4@immo.com');
        $agent1 = User::firstWhere('email', 'agent@immo.com');
        $agent2 = User::firstWhere('email', 'agent2@immo.com');
        $agent3 = User::firstWhere('email', 'agent3@immo.com');

        if (! $client3 || ! $client4 || ! $agent1 || ! $agent2 || ! $agent3) {
            return;
        }

        $properties = Property::where('status', 'publiee')->take(6)->get();
        if ($properties->count() < 4) {
            return;
        }

        $requests = [
            [
                'client_id'     => $client3->id,
                'property_id'   => $properties[0]->id,
                'agent_id'      => $agent3->id ?? $agent1->id,
                'visit_date'    => now()->addDays(2)->format('Y-m-d'),
                'visit_time'    => '09:30:00',
                'status'        => 'en_attente',
                'message'       => 'Je souhaite visiter rapidement avant la fin de la semaine.',
            ],
            [
                'client_id'     => $client3->id,
                'property_id'   => $properties[1]->id,
                'agent_id'      => $agent1->id,
                'visit_date'    => now()->addDays(5)->format('Y-m-d'),
                'visit_time'    => '16:00:00',
                'status'        => 'validee',
                'message'       => 'Je veux voir cet appartement après le travail.',
                'processed_at'  => now(),
            ],
            [
                'client_id'     => $client4->id,
                'property_id'   => $properties[2]->id,
                'agent_id'      => $agent2->id,
                'visit_date'    => now()->addDays(4)->format('Y-m-d'),
                'visit_time'    => '11:00:00',
                'status'        => 'refusee',
                'message'       => 'Cette villa m’intéresse beaucoup.',
                'refusal_reason'=> 'Le bien n’est plus disponible à cette date.',
                'processed_at'  => now(),
            ],
            [
                'client_id'     => $client4->id,
                'property_id'   => $properties[3]->id,
                'agent_id'      => $agent2->id,
                'visit_date'    => now()->addDays(8)->format('Y-m-d'),
                'visit_time'    => '15:00:00',
                'status'        => 'en_attente',
                'message'       => 'J’ai besoin de voir l’espace de bureau.',
            ],
        ];

        foreach ($requests as $request) {
            VisitRequest::updateOrCreate(
                [
                    'client_id'   => $request['client_id'],
                    'property_id' => $request['property_id'],
                ],
                $request
            );
        }
    }
}
