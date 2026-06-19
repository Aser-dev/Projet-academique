<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        $manager = User::firstWhere('email', 'manager@immo.com');
        $agent1 = User::firstWhere('email', 'agent@immo.com');
        $client2 = User::firstWhere('email', 'client2@immo.com');

        if (! $manager || ! $agent1 || ! $client2) {
            return;
        }

        $actions = [
            [
                'causer_id'   => $manager->id,
                'event'       => 'client.assigned',
                'description' => 'Affectation du client Client Ndiaye à Agent Dupont.',
            ],
            [
                'causer_id'   => $agent1->id,
                'event'       => 'property.validated',
                'description' => 'Validation de l’annonce Villa moderne avec piscine.',
            ],
            [
                'causer_id'   => $client2->id,
                'event'       => 'visit.requested',
                'description' => 'Demande de visite pour un appartement F3 meublé.',
            ],
        ];

        foreach ($actions as $log) {
            ActivityLog::updateOrCreate(
                [
                    'causer_id' => $log['causer_id'],
                    'event'     => $log['event'],
                ],
                $log
            );
        }
    }
}
