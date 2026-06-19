<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{

    public function run(): void
    {
        $manager = User::firstWhere('email', 'manager@immo.com');
        $agent1 = User::firstWhere('email', 'agent@immo.com');
        $client1 = User::firstWhere('email', 'client@immo.com');
        $client3 = User::firstWhere('email', 'client3@immo.com');

        if (! $manager || ! $agent1 || ! $client1 || ! $client3) {
            return;
        }

        $notifications = [
            [
                'user_id' => $agent1->id,
                'message' => 'Une nouvelle propriété a été attribuée pour validation.',
                'type'    => 'info',
                'read'    => false,
            ],
            [
                'user_id' => $manager->id,
                'message' => 'Un agent a été réaffecté à un nouveau client.',
                'type'    => 'success',
                'read'    => true,
            ],
            [
                'user_id' => $client1->id,
                'message' => 'Votre demande de visite a été validée.',
                'type'    => 'success',
                'read'    => false,
            ],
            [
                'user_id' => $client3->id,
                'message' => 'Un agent va bientôt vous contacter pour confirmer votre visite.',
                'type'    => 'info',
                'read'    => false,
            ],
        ];

        foreach ($notifications as $notification) {
            Notification::updateOrCreate(
                [
                    'user_id' => $notification['user_id'],
                    'message' => $notification['message'],
                ],
                $notification
            );
        }
    }
}
