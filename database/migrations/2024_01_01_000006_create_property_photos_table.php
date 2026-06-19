<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table : property_photos
     * Photos liées à une annonce — seul le chemin est stocké (ENF-11)
     * Exigences : ENF-11, EF-C1, EF-E2
     *
     * Stockage physique : storage/app/public/properties/{property_id}/
     * Accès via : asset('storage/properties/...')
     */
    public function up(): void
    {
        Schema::create('property_photos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('property_id')
                  ->constrained('properties')
                  ->cascadeOnDelete();

            // ENF-11 : chemin filesystem uniquement, jamais le binaire
            $table->string('path', 500);
            $table->string('original_name', 255)->nullable();   // nom d'origine du fichier
            $table->string('mime_type', 50)->nullable();         // image/jpeg, image/png...
            $table->unsignedInteger('size')->nullable();         // taille en octets

            // Photo principale affichée sur la liste (EF-E1, EF-E2)
            $table->boolean('is_main')->default(false);

            // Ordre d'affichage dans la galerie
            $table->unsignedTinyInteger('sort_order')->default(0);

            $table->timestamp('created_at')->useCurrent();

            $table->index(['property_id', 'is_main']);
            $table->index(['property_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_photos');
    }
};
