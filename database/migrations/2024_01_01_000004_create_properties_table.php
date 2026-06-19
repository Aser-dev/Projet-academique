<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table : properties
     * Annonces immobilières — cœur du système
     * Exigences : EF-C1, EF-C2, EF-C3, EF-C4, EF-D1, EF-D4, EF-D8, EF-B1, EF-E1, EF-E2
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            // Propriétaire de l'annonce (bailleur ou agence via agent)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Informations principales (EF-C1)
            $table->string('title', 200);
            $table->enum('type', ['terrain', 'batiment', 'appartement', 'villa', 'commerce']);
            $table->enum('option', ['location', 'vente']);
            $table->string('location', 200)->index();            // zone géographique (EF-B1)
            $table->decimal('superficie', 10, 2)->nullable();    // m²
            $table->decimal('price', 12, 2);

            // Caractéristiques complémentaires (EF-E2)
            $table->unsignedTinyInteger('rooms')->nullable();    // nombre de pièces
            $table->unsignedTinyInteger('floor')->nullable();    // étage (appartements)
            $table->boolean('furnished')->default(false);        // meublé (location)
            $table->text('description')->nullable();

            // Workflow de publication (EF-C2, EF-D1, EF-D8)
            $table->enum('status', ['en_attente', 'publiee', 'retiree'])
                  ->default('en_attente')
                  ->index();

            // Annonce agence sans validation (EF-D4)
            $table->boolean('is_agency')->default(false);

            // Audit validation (EF-D1)
            $table->foreignId('validated_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->timestamp('validated_at')->nullable();
            $table->text('rejection_reason')->nullable();       // motif de refus au bailleur

            // Stats (EF-D7 dashboard)
            $table->unsignedInteger('views_count')->default(0);

            $table->timestamps();

            // Index composites pour les filtres EF-B1
            $table->index(['type', 'option', 'status']);
            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
