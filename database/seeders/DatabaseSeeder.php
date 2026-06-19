<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
use App\Models\PropertyPhoto;
use App\Models\PropertyUsage;
use App\Models\Favorite;
use App\Models\VisitRequest;
use App\Models\ClientAgent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Utilisateurs ──────────────────────────────────────────────
        $manager = User::updateOrCreate([
            'email' => 'manager@immo.com'
        ], [
            'name'     => 'Manager Principal',
            'password' => Hash::make('password'),
            'role'     => 'manager',
            'phone'    => '+226 77 000 0001',
            'is_active'=> true,
        ]);

        $agent1 = User::updateOrCreate([
            'email' => 'agent@immo.com'
        ], [
            'name'     => 'Agent Dupont',
            'password' => Hash::make('password'),
            'role'     => 'agent',
            'phone'    => '+226 77 000 0002',
            'is_active'=> true,
        ]);

        $agent2 = User::updateOrCreate([
            'email' => 'agent2@immo.com'
        ], [
            'name'     => 'Agent Martin',
            'password' => Hash::make('password'),
            'role'     => 'agent',
            'phone'    => '+226 77 000 0003',
            'is_active'=> true,
        ]);

        $bailleur1 = User::updateOrCreate([
            'email' => 'bailleur@immo.com'
        ], [
            'name'     => 'Bailleur Diallo',
            'password' => Hash::make('password'),
            'role'     => 'bailleur',
            'phone'    => '+226 77 000 0004',
            'is_active'=> true,
        ]);

        $bailleur2 = User::updateOrCreate([
            'email' => 'bailleur2@immo.com'
        ], [
            'name'     => 'Bailleur Sow',
            'password' => Hash::make('password'),
            'role'     => 'bailleur',
            'phone'    => '+226 77 000 0005',
            'is_active'=> true,
        ]);

        $client1 = User::updateOrCreate([
            'email' => 'client@immo.com'
        ], [
            'name'     => 'Client Ndiaye',
            'password' => Hash::make('password'),
            'role'     => 'client',
            'phone'    => '+226 77 000 0006',
            'is_active'=> true,
        ]);

        $client2 = User::updateOrCreate([
            'email' => 'client2@immo.com'
        ], [
            'name'     => 'Client Fall',
            'password' => Hash::make('password'),
            'role'     => 'client',
            'phone'    => '+226 77 000 0007',
            'is_active'=> true,
        ]);

        // ── Propriétés publiées ────────────────────────────────────────
        $properties = [
            [
                'user_id'     => $bailleur1->id,
                'title'       => 'Villa moderne avec piscine - Secteur 15, Ouagadougou',
                'type'        => 'villa',
                'option'      => 'vente',
                'location'    => 'Secteur 15, Ouagadougou',
                'superficie'  => 450.00,
                'price'       => 120000000,
                'rooms'       => 6,
                'floor'       => 0,
                'furnished'   => true,
                'description' => 'Magnifique villa de standing avec piscine privée, jardin paysager, 6 chambres et double garage. Quartier résidentiel calme et sécurisé.',
                'status'      => 'publiee',
                'is_agency'   => false,
                'validated_by'=> $agent1->id,
                'views_count' => 245,
                'usages'      => ['residence'],
            ],
            [
                'user_id'     => $bailleur1->id,
                'title'       => 'Appartement F3 meublé - Centre, Ouagadougou',
                'type'        => 'appartement',
                'option'      => 'location',
                'location'    => 'Centre, Ouagadougou',
                'superficie'  => 85.00,
                'price'       => 350000,
                'rooms'       => 3,
                'floor'       => 4,
                'furnished'   => true,
                'description' => 'Bel appartement meublé au 4ème étage avec vue sur la mer. Séjour spacieux, 2 chambres, cuisine équipée, balcon.',
                'status'      => 'publiee',
                'is_agency'   => false,
                'validated_by'=> $agent1->id,
                'views_count' => 132,
                'usages'      => ['residence'],
            ],
            [
                'user_id'     => $bailleur2->id,
                'title'       => 'Terrain constructible - Koudougou',
                'type'        => 'terrain',
                'option'      => 'vente',
                'location'    => 'Koudougou',
                'superficie'  => 600.00,
                'price'       => 15000000,
                'rooms'       => null,
                'floor'       => null,
                'furnished'   => false,
                'description' => 'Terrain viabilisé de 600m² en zone résidentielle. Titre foncier disponible, accès eau et électricité.',
                'status'      => 'publiee',
                'is_agency'   => false,
                'validated_by'=> $agent2->id,
                'views_count' => 89,
                'usages'      => ['residence', 'commerce'],
            ],
            [
                'user_id'     => $bailleur2->id,
                'title'       => 'Local commercial - Gounghin',
                'type'        => 'commerce',
                'option'      => 'location',
                'location'    => 'Gounghin, Ouagadougou',
                'superficie'  => 120.00,
                'price'       => 500000,
                'rooms'       => null,
                'floor'       => 0,
                'furnished'   => false,
                'description' => 'Local commercial idéalement situé en plein cœur de la Médina. Grande vitrine, espace de stockage, toilettes.',
                'status'      => 'publiee',
                'is_agency'   => false,
                'validated_by'=> $agent1->id,
                'views_count' => 178,
                'usages'      => ['commerce'],
            ],
            [
                'user_id'     => $bailleur1->id,
                'title'       => 'Appartement bureau - Zone du Plateau, Ouagadougou',
                'type'        => 'appartement',
                'option'      => 'location',
                'location'    => 'Zone du Plateau, Ouagadougou',
                'superficie'  => 110.00,
                'price'       => 600000,
                'rooms'       => 4,
                'floor'       => 2,
                'furnished'   => true,
                'description' => 'Appartement idéal pour bureaux ou cabinet. Climatisé, fibre optique, parking, sécurité 24h/24.',
                'status'      => 'publiee',
                'is_agency'   => false,
                'validated_by'=> $agent2->id,
                'views_count' => 203,
                'usages'      => ['bureau', 'residence'],
            ],
            [
                'user_id'     => $bailleur2->id,
                'title'       => 'Villa basse à vendre - Banfora',
                'type'        => 'villa',
                'option'      => 'vente',
                'location'    => 'Banfora',
                'superficie'  => 250.00,
                'price'       => 45000000,
                'rooms'       => 4,
                'floor'       => 0,
                'furnished'   => false,
                'description' => 'Belle villa basse de 4 chambres à 500m de la plage. Jardin, citerne, groupe électrogène.',
                'status'      => 'publiee',
                'is_agency'   => false,
                'validated_by'=> $agent1->id,
                'views_count' => 315,
                'usages'      => ['residence'],
            ],
            [
                'user_id'     => $bailleur1->id,
                'title'       => 'Immeuble R+3 - Ouahigouya',
                'type'        => 'batiment',
                'option'      => 'vente',
                'location'    => 'Ouahigouya',
                'superficie'  => 800.00,
                'price'       => 200000000,
                'rooms'       => 12,
                'floor'       => 3,
                'furnished'   => false,
                'description' => 'Immeuble R+3 de 12 appartements en plein centre. Rentabilité assurée, 100% occupé.',
                'status'      => 'publiee',
                'is_agency'   => false,
                'validated_by'=> $agent2->id,
                'views_count' => 421,
                'usages'      => ['residence', 'commerce'],
            ],
            [
                'user_id'     => $bailleur2->id,
                'title'       => 'Studio meublé - Secteur 30, Ouagadougou',
                'type'        => 'appartement',
                'option'      => 'location',
                'location'    => 'Secteur 30, Ouagadougou',
                'superficie'  => 35.00,
                'price'       => 180000,
                'rooms'       => 1,
                'floor'       => 1,
                'furnished'   => true,
                'description' => 'Studio entièrement meublé et équipé. Idéal étudiant ou jeune professionnel. Charges comprises.',
                'status'      => 'publiee',
                'is_agency'   => false,
                'validated_by'=> $agent1->id,
                'views_count' => 98,
                'usages'      => ['residence'],
            ],
        ];

        // Photos Unsplash par type
        $photosByType = [
            'villa' => [
                'https://images.unsplash.com/photo-1613490493576-7fde63acd811?w=800&q=80',
                'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800&q=80',
            ],
            'appartement' => [
                'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800&q=80',
                'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800&q=80',
            ],
            'terrain' => [
                'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=800&q=80',
            ],
            'commerce' => [
                'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&q=80',
            ],
            'batiment' => [
                'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=800&q=80',
                'https://images.unsplash.com/photo-1464082354059-27db6ce50048?w=800&q=80',
            ],
        ];

        $createdProperties = [];
        foreach ($properties as $data) {
            $usages = $data['usages'];
            unset($data['usages']);

            $property = Property::create($data);
            $createdProperties[] = $property;

            // Usages
            foreach ($usages as $usage) {
                PropertyUsage::create(['property_id' => $property->id, 'usage' => $usage]);
            }

            // Photos
            $photos = $photosByType[$property->type] ?? ['properties/default.jpg'];
            foreach ($photos as $i => $path) {
                PropertyPhoto::create([
                    'property_id'   => $property->id,
                    'path'          => $path,
                    'original_name' => basename($path),
                    'mime_type'     => 'image/jpeg',
                    'is_main'       => $i === 0,
                    'sort_order'    => $i,
                ]);
            }
        }

        // ── Propriétés en attente de validation ───────────────────────
        $pending = Property::create([
            'user_id'     => $bailleur1->id,
            'title'       => 'Appartement neuf à valider - Koulouba, Ouagadougou',
            'type'        => 'appartement',
            'option'      => 'vente',
            'location'    => 'Koulouba, Ouagadougou',
            'superficie'  => 95.00,
            'price'       => 55000000,
            'rooms'       => 3,
            'floor'       => 2,
            'furnished'   => false,
            'description' => 'Appartement neuf en attente de validation.',
            'status'      => 'en_attente',
            'is_agency'   => false,
            'views_count' => 0,
        ]);
        PropertyUsage::create(['property_id' => $pending->id, 'usage' => 'residence']);

        // ── Affectation clients → agents ──────────────────────────────
        ClientAgent::create(['client_id' => $client1->id, 'agent_id' => $agent1->id, 'assigned_by' => $manager->id]);
        ClientAgent::create(['client_id' => $client2->id, 'agent_id' => $agent2->id, 'assigned_by' => $manager->id]);

        // ── Favoris ───────────────────────────────────────────────────
        Favorite::create(['user_id' => $client1->id, 'property_id' => $createdProperties[0]->id]);
        Favorite::create(['user_id' => $client1->id, 'property_id' => $createdProperties[2]->id]);
        Favorite::create(['user_id' => $client2->id, 'property_id' => $createdProperties[1]->id]);
        Favorite::create(['user_id' => $client2->id, 'property_id' => $createdProperties[5]->id]);

        // ── Demandes de visites ───────────────────────────────────────
        VisitRequest::create([
            'client_id'   => $client1->id,
            'property_id' => $createdProperties[0]->id,
            'agent_id'    => $agent1->id,
            'visit_date'  => now()->addDays(3)->format('Y-m-d'),
            'visit_time'  => '10:00:00',
            'status'      => 'en_attente',
            'message'     => 'Je souhaite visiter cette villa le matin si possible.',
        ]);

        VisitRequest::create([
            'client_id'   => $client1->id,
            'property_id' => $createdProperties[1]->id,
            'agent_id'    => $agent1->id,
            'visit_date'  => now()->addDays(7)->format('Y-m-d'),
            'visit_time'  => '14:00:00',
            'status'      => 'validee',
            'message'     => 'Disponible l\'après-midi.',
        ]);

        VisitRequest::create([
            'client_id'   => $client2->id,
            'property_id' => $createdProperties[3]->id,
            'agent_id'    => $agent2->id,
            'visit_date'  => now()->addDays(5)->format('Y-m-d'),
            'visit_time'  => '09:00:00',
            'status'      => 'refusee',
            'message'     => 'Je veux louer ce local.',
            'refusal_reason' => 'Créneau non disponible, veuillez recontacter l\'agence.',
        ]);

        VisitRequest::create([
            'client_id'   => $client2->id,
            'property_id' => $createdProperties[4]->id,
            'agent_id'    => null,
            'visit_date'  => now()->addDays(10)->format('Y-m-d'),
            'visit_time'  => '11:00:00',
            'status'      => 'en_attente',
        ]);

        $this->command->info('✅ Seeder terminé avec succès !');
        $this->command->info('');
        $this->command->info('Comptes créés :');
        $this->command->info('  manager@immo.com   / password  (Manager)');
        $this->command->info('  agent@immo.com     / password  (Agent)');
        $this->command->info('  agent2@immo.com    / password  (Agent)');
        $this->command->info('  bailleur@immo.com  / password  (Bailleur)');
        $this->command->info('  bailleur2@immo.com / password  (Bailleur)');
        $this->command->info('  client@immo.com    / password  (Client)');
        $this->command->info('  client2@immo.com   / password  (Client)');
    }
}
