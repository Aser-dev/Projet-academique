<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table : client_agent
     * Affectation d'un client à un agent par le manager
     * Exigences : EF-D6, EF-D3
     *
     * UNIQUE(client_id) garantit qu'un client a un seul agent à la fois.
     * Pour réaffecter : UPDATE client_agent SET agent_id = ? WHERE client_id = ?
     *
     * Utilisation Eloquent :
     *   $manager->affectClient($clientId, $agentId);
     *   $agent->clients()->get();
     *   $client->agent;
     */
    public function up(): void
    {
        Schema::create('client_agent', function (Blueprint $table) {
            $table->id();

            // Client affecté (un seul agent à la fois)
            $table->foreignId('client_id')
                  ->unique()                                      // UNIQUE → un client = un agent max
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Agent responsable
            $table->foreignId('agent_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Manager qui a fait l'affectation (audit)
            $table->foreignId('assigned_by')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->timestamp('assigned_at')->useCurrent();

            $table->index('agent_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_agent');
    }
};
