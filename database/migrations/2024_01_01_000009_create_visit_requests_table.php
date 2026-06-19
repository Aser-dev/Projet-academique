<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table : visit_requests
     * Cycle complet d'une demande de visite
     * Exigences : EF-B3, EF-B4, EF-D2
     *
     * Workflow : en_attente → validee | refusee
     * agent_id nullable = demande reçue avant affectation du client
     */
    public function up(): void
    {
        Schema::create('visit_requests', function (Blueprint $table) {
            $table->id();

            // Acteurs
            $table->foreignId('client_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('property_id')
                  ->constrained('properties')
                  ->cascadeOnDelete();

            // NULL si client pas encore affecté à un agent
            $table->foreignId('agent_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            // Statut du workflow (EF-B4)
            $table->enum('status', ['en_attente', 'validee', 'refusee'])
                  ->default('en_attente')
                  ->index();

            // Contenu de la demande
            $table->text('message')->nullable();                  // message du client
            $table->date('visit_date')->nullable();               // date souhaitée
            $table->time('visit_time')->nullable();               // heure souhaitée

            // Traitement par l'agent (EF-D2)
            $table->text('refusal_reason')->nullable();           // motif de refus
            $table->timestamp('processed_at')->nullable();        // quand traité

            $table->timestamps();

            // Index pour les requêtes dashboard (EF-D7)
            $table->index(['agent_id', 'status']);
            $table->index(['client_id', 'status']);
            $table->index(['status', 'created_at']);             // stats par mois
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visit_requests');
    }
};
