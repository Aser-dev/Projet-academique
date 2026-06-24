<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table : activity_logs
     * Journal d'audit des actions importantes du système
     * Exigences : EF-D7 (stats dashboard), ENF-8 (traçabilité)
     *
     * Événements à logger :
     *  - property.created, property.validated, property.refused, property.withdrawn
     *  - visit.requested, visit.validated, visit.refused
     *  - user.created, user.suspended, user.deleted
     *  - client.assigned, client.reassigned
     *
     * Exemples de requêtes dashboard (EF-D7) :
     *  - Visites par mois :
     *      ActivityLog::where('event','visit.requested')
     *                 ->whereMonth('created_at', now()->month)->count();
     *  - Annonces en attente :
     *      Property::where('status','en_attente')->count();
     *  - Propriétés par type :
     *      Property::groupBy('type')->selectRaw('type, count(*) as total')->get();
     */
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            // Qui a fait l'action (NULL = système)
            $table->foreignId('causer_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            // Sur quoi (polymorphisme : Property, User, VisitRequest...)
            $table->string('subject_type')->nullable()->index();
            $table->unsignedBigInteger('subject_id')->nullable()->index();

            // Type d'événement (ex: 'property.validated')
            $table->string('event', 100)->index();

            // Description lisible
            $table->text('description')->nullable();

            // Données avant/après (pour audit complet)
            $table->json('properties')->nullable();

            // Métadonnées techniques
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 500)->nullable();

            // Pas d'updated_at (les logs ne se modifient jamais)
            $table->timestamp('created_at')->useCurrent()->index();

            // Index composite pour les stats par période
            $table->index(['event', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
