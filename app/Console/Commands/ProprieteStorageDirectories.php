<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ProprieteStorageDirectories extends Command
{
    /** @var string */
    protected $signature = 'propriete:storage-directories';

    /** @var string */
    protected $description = 'Crée la structure de dossiers de stockage pour les photos de propriétés (storage/app/public/propriete/*) et ajoute des .gitkeep.';

    public function handle(): int
    {
        $disk = Storage::disk('public');

        $directories = [
            'propriete/villas',
            'propriete/appartements',
            'propriete/terrains',
            'propriete/bureaux',
            'propriete/commerces',
            'propriete/immeubles',
            'propriete/avatars',
            'propriete/divers',
        ];

        foreach ($directories as $dir) {
            $disk->makeDirectory($dir);

            // On utilise put() pour garantir la création même si le dossier vient d'être créé.
            // .gitkeep est vide.
            $disk->put($dir . '/.gitkeep', '');
        }

        $this->info('✅ Dossiers propriete créés dans disk public avec .gitkeep.');

        return self::SUCCESS;
    }
}

