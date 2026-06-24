<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table : favorites
     * Favoris d'un client — table pivot users ↔ properties
     * Exigences : EF-B2
     *
     * Utilisation Eloquent :
     *   $client->favorites()->toggle($propertyId);
     *   $client->favoriteProperties()->where('status','publiee')->get();
     */
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('property_id')
                  ->constrained('properties')
                  ->cascadeOnDelete();

            $table->timestamp('created_at')->useCurrent();

            // Un client ne met en favori qu'une seule fois la même propriété
            $table->unique(['user_id', 'property_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
