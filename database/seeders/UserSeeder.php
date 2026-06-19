<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'email'     => 'agent3@immo.com',
                'name'      => 'Agent Kaboré',
                'role'      => 'agent',
                'phone'     => '+226 77 000 0008',
                'address'   => 'Zone du Bois, Ouagadougou',
            ],
            [
                'email'     => 'client3@immo.com',
                'name'      => 'Client Zida',
                'role'      => 'client',
                'phone'     => '+226 77 000 0009',
                'address'   => 'Secteur 29, Ouagadougou',
            ],
            [
                'email'     => 'client4@immo.com',
                'name'      => 'Client Bonkoungou',
                'role'      => 'client',
                'phone'     => '+226 77 000 0010',
                'address'   => 'Sekt 21, Ouagadougou',
            ],
            [
                'email'     => 'bailleur3@immo.com',
                'name'      => 'Bailleur Ouedraogo',
                'role'      => 'bailleur',
                'phone'     => '+226 77 000 0011',
                'address'   => 'Kossodo, Ouagadougou',
            ],
            [
                'email'     => 'bailleur4@immo.com',
                'name'      => 'Bailleur Traoré',
                'role'      => 'bailleur',
                'phone'     => '+226 77 000 0012',
                'address'   => 'Ziniaré',
            ],
            [
                'email'     => 'visiteur@immo.com',
                'name'      => 'Visiteur Samba',
                'role'      => 'visiteur',
                'phone'     => '+226 77 000 0013',
                'address'   => 'Ouagadougou',
            ],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                array_merge($data, [
                    'password'  => Hash::make('password'),
                    'is_active' => true,
                ])
            );
        }
    }
}
