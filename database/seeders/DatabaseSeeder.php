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
                'photos'      => ['propriete/villas/villa f3.jpg',
                                  'propriete/villas/villa f31.webp',
                                  'propriete/villas/f3.jpg',
                                 
                         
           
                ],
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
                'photos'      => [
                                  'propriete/immeubles/R.jpg',
                                  'propriete/immeubles/R2.jpg',
                                  'propriete/immeubles/R3.jpg',
                                  'propriete/immeubles/R4.jpg',
                                  'propriete/immeubles/R5.jpg',
                ],
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
                'photos'      => ['propriete/terrains/terrain.jpg'],
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
                'photos'      => ['propriete/commerces/local commercial.jpeg'

                ],
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
                'photos'      => ['propriete/bureaux/bureau.jpg',
                                  'propriete/bureaux/bureau 1.webp',
                                  'propriete/bureaux/bureau 2.webp',
                                  
                ],
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
                'photos'      => ['propriete/villas/villa basse.png',
                                  'propriete/villas/villa basse 1.png',
                                  'propriete/villas/villa basse 2.jpg',],
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
                'photos'      => ['propriete/appartements/WhatsAppAppart1.jpeg',
                                  'propriete/appartements/WhatsAppAppart2.jpeg',
                                  'propriete/appartements/WhatsAppAppart3.jpeg',
                                  ],
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
                'photos'      => ['propriete/divers/WhatsAppStudio1.jpeg',
                                  'propriete/divers/WhatsAppStudio2.jpeg',
                                  'propriete/divers/studio meublé.jpg',],
            ],

            // ── Ajouts vides (à remplir) ───────────────────────────────
            [
                'user_id'     => $bailleur1->id,
                'title'       => 'UN TRIPLEX DE HAUT STANDING EN LOCATION A OUAGA 2000 ZONE C',
                'type'        => 'Appartement', // villa|appartement|terrain|commerce|batiment
                'option'      => 'vente', // vente|location
                'location'    => 'Ouagadougou,  zone C de Ouaga 2000',
                'superficie'  => 900.00,
                'price'       => 22000000,
                'rooms'       => 16,
                'floor'       => 5,
                'furnished'   => false,
                'description' => 'luxueuse résidence, dotée de finitions impeccables, située dans la zone C de Ouaga 2000. Idéalement implantée à proximité de l’ONASER Ouaga 2000, cette propriété se trouve dans un quartier résidentiel très calme.',
                'status'      => 'publiee',
                'is_agency'   => false,
                'validated_by'=> $agent1->id,
                'views_count' => 0,
                'usages'      => ['residence'],
                'photos'      => ['propriete/appartements/triplex1.jpg',
                                  'propriete/appartements/triplex2.jpg',
                                  'propriete/appartements/triplex3.jpg',
                                  'propriete/appartements/triplex4.jpg',
                                  'propriete/appartements/triplex5.jpg',],
          ],
            [
                'user_id'     => $bailleur1->id,
                'title'       => 'Terrain agricole aménagé de 5 hectares à vendre',
                'type'        => 'terrain', // villa|appartement|terrain|commerce|batiment
                'option'      => 'vente', // vente|location
                'location'    => 'Bagré, Centre-Est',
                'superficie'  =>  50000.00,
                'price'       =>  15000000,
                'rooms'       => 0,
                'floor'       => 0,
                'furnished'   => false,
                'description' => 'Grand terrain agricole de 5 hectares situé dans une zone fertile et facilement accessible. Idéal pour les cultures maraîchères, céréalières ou les projets agro-pastoraux. Présence d’un point d’eau à proximité et accès par piste praticable toute l’année. Documents administratifs disponibles.',
                'status'      => 'publiee',
                'is_agency'   => false,
                'validated_by'=> $agent1->id,
                'views_count' => 0,
                'usages'      => ['residence'],
                'photos'      => ['propriete/terrains/terrain3.JPG'],
            ],
           [
            'user_id'     => $bailleur1->id,
            'title'       => 'Local commercial spacieux en bordure de voie',
            'type'        => 'commerce',
            'option'      => 'location',
            'location'    => 'Ouagadougou, Zone du Bois',
            'superficie'  => 120.00,
            'price'       => 350000,
            'rooms'       => 4,
            'floor'       => 0,
            'furnished'   => false,
            'description' => 'Local commercial de 120 m² idéalement situé en bordure d’une voie très fréquentée. Convient pour une boutique, un showroom, une pharmacie, une agence ou tout autre commerce. Le bâtiment dispose d’un espace d’accueil, de plusieurs pièces de travail, d’un parking et d’un accès facile pour la clientèle.',
            'status'      => 'publiee',
            'is_agency'   => false,
            'validated_by'=> $agent1->id,       
            'views_count' => 0,
            'usages'      => ['commerce'],
            'photos'      => [
                'propriete/commerces/commerce1.jpg',
                'propriete/commerces/commerce2.webp',
               
            ],
],
        ];

        $createdProperties = [];
        foreach ($properties as $data) {
            $usages = $data['usages'];
            unset($data['usages']);

            $photos = $data['photos'] ?? [];
            unset($data['photos']);

            $property = Property::create($data);
            $createdProperties[] = $property;

            // Usages
            foreach ($usages as $usage) {
                PropertyUsage::create(['property_id' => $property->id, 'usage' => $usage]);
            }

            // Photos
            if (!empty($photos)) {
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
        ClientAgent::updateOrCreate(
            ['client_id' => $client1->id],
            ['agent_id' => $agent1->id, 'assigned_by' => $manager->id]
        );
        ClientAgent::updateOrCreate(
            ['client_id' => $client2->id],
            ['agent_id' => $agent2->id, 'assigned_by' => $manager->id]
        );
        $client1->update(['assigned_agent_id' => $agent1->id]);
        $client2->update(['assigned_agent_id' => $agent2->id]);

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

