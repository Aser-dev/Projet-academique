<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\PropertyPhoto;
use App\Models\PropertyUsage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $bailleur3 = User::firstWhere('email', 'bailleur3@immo.com');
        $bailleur4 = User::firstWhere('email', 'bailleur4@immo.com');
        $agent1 = User::firstWhere('email', 'agent@immo.com');
        $agent2 = User::firstWhere('email', 'agent2@immo.com');
        $agent3 = User::firstWhere('email', 'agent3@immo.com');

        if (! $bailleur3 || ! $bailleur4 || ! $agent1 || ! $agent2 || ! $agent3) {
            return;
        }

        $properties = [
            [
                'user_id'     => $bailleur3->id,
                'title'       => 'Maison de campagne avec verger - Bobo-Dioulasso',
                'type'        => 'villa',
                'option'      => 'vente',
                'location'    => 'Bobo-Dioulasso',
                'superficie'  => 320.00,
                'price'       => 98000000,
                'rooms'       => 5,
                'floor'       => 0,
                'furnished'   => true,
                'description' => 'Belle maison de campagne avec verger, piscine naturelle et dépendance. Calme et verdure.',
                'status'      => 'publiee',
                'is_agency'   => false,
                'validated_by'=> $agent3->id,
                'views_count' => 172,
                'usages'      => ['residence'],
            ],
            [
                'user_id'     => $bailleur4->id,
                'title'       => 'Local logistique à louer - Zone industrielle',
                'type'        => 'commerce',
                'option'      => 'location',
                'location'    => 'Zone industrielle, Ouagadougou',
                'superficie'  => 420.00,
                'price'       => 950000,
                'rooms'       => null,
                'floor'       => 0,
                'furnished'   => false,
                'description' => 'Grand local logistique avec accès poids lourds et quais de déchargement.',
                'status'      => 'publiee',
                'is_agency'   => false,
                'validated_by'=> $agent2->id,
                'views_count' => 125,
                'usages'      => ['commerce'],
            ],
            [
                'user_id'     => $bailleur3->id,
                'title'       => 'Terrain agricole en bordure de rivière - Koupéla',
                'type'        => 'terrain',
                'option'      => 'vente',
                'location'    => 'Koupéla',
                'superficie'  => 1500.00,
                'price'       => 23000000,
                'rooms'       => null,
                'floor'       => null,
                'furnished'   => false,
                'description' => 'Terrain agricole à proximité d’un cours d’eau, idéal pour maraîchage ou élevage.',
                'status'      => 'en_attente',
                'is_agency'   => false,
                'validated_by'=> null,
                'views_count' => 0,
                'usages'      => ['agriculture'],
            ],
            [
                'user_id'     => $bailleur4->id,
                'title'       => 'Maison familiale retirée - Koudougou',
                'type'        => 'villa',
                'option'      => 'vente',
                'location'    => 'Koudougou',
                'superficie'  => 260.00,
                'price'       => 36000000,
                'rooms'       => 4,
                'floor'       => 0,
                'furnished'   => true,
                'description' => 'Villa familiale avec jardin clos, 4 chambres et garage. Propriété retirée du marché pour révision.',
                'status'      => 'retiree',
                'is_agency'   => false,
                'validated_by'=> $agent1->id,
                'views_count' => 48,
                'usages'      => ['residence'],
            ],
        ];

        $photosByType = [
            'villa' => [
                'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800&q=80',
                'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800&q=80',
            ],
            'commerce' => [
                'https://images.unsplash.com/photo-1462396245925-4eb0f4c6b5f5?w=800&q=80',
            ],
            'terrain' => [
                'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=800&q=80',
            ],
        ];

        $this->ensureDefaultPropertyImage();

        foreach ($properties as $data) {
            $usages = $data['usages'];
            unset($data['usages']);

            $property = Property::updateOrCreate(
                ['title' => $data['title']],
                $data
            );

            foreach ($usages as $usage) {
                PropertyUsage::updateOrCreate([
                    'property_id' => $property->id,
                    'usage'       => $usage,
                ]);
            }

            $photos = $photosByType[$property->type] ?? ['properties/default.jpg'];
            foreach ($photos as $index => $path) {
                if (str_starts_with($path, 'http')) {
                    $downloadedPath = $this->downloadRemoteImage($path, "properties/{$property->id}");
                    $path = $downloadedPath ?? 'properties/default.jpg';
                }

                PropertyPhoto::updateOrCreate(
                    [
                        'property_id'   => $property->id,
                        'path'          => $path,
                    ],
                    [
                        'original_name' => basename($path),
                        'mime_type'     => 'image/jpeg',
                        'is_main'       => $index === 0,
                        'sort_order'    => $index,
                    ]
                );
            }
        }
    }

    protected function downloadRemoteImage(string $url, string $directory): ?string
    {
        try {
            $response = Http::withoutVerifying()->timeout(30)->get($url);
            if (! $response->successful()) {
                return null;
            }

            $pathInfo = pathinfo(parse_url($url, PHP_URL_PATH) ?: '');
            $filename = Str::slug($pathInfo['filename'] ?? 'image', '-');
            $extension = $pathInfo['extension'] ?? 'jpg';
            $extension = preg_match('/^[a-z0-9]+$/i', $extension) ? $extension : 'jpg';
            $filename = $filename ?: 'image';
            $filename = $filename . '-' . substr(md5($url), 0, 10) . '.' . $extension;

            $path = trim($directory, '/') . '/' . $filename;
            Storage::disk('public')->put($path, $response->body());

            return $path;
        } catch (\Throwable $exception) {
            return null;
        }
    }

    protected function ensureDefaultPropertyImage(): void
    {
        $defaultPath = 'properties/default.jpg';

        if (Storage::disk('public')->exists($defaultPath)) {
            return;
        }

        $jpeg = base64_decode(
            '/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAP//////////////////////////////////////////////////////////////////////////////////////2wBDAf//////////////////////////////////////////////////////////////////////////////////////wAARCAABAAEDASIAAhEBAxEB/8QAFwAAAwEAAAAAAAAAAAAAAAAAAAUGB//EABQBAQAAAAAAAAAAAAAAAAAAAAD/2gAMAwEAAhADEAAAAJwP/8QAFBABAAAAAAAAAAAAAAAAAAAAAP/aAAgBAQABPwA//8QAFBABAAAAAAAAAAAAAAAAAAAAAP/aAAgBAgEBPwA//8QAFBABAAAAAAAAAAAAAAAAAAAAAP/aAAgBAwEBPwA//9k='
        );

        Storage::disk('public')->put($defaultPath, $jpeg);
    }
}
