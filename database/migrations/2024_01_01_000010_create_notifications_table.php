<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table : notifications
     * Notifications internes (Laravel Notifications — Notifiable trait)
     * Exigences : EF-C2, EF-C4, EF-B4, EF-D1, EF-D2
     *
     * Cas d'usage :
     *  - Bailleur notifié quand son annonce est validée ou refusée (EF-D1)
     *  - Client notifié quand sa demande de visite est traitée (EF-D2)
     *  - Bailleur notifié quand son annonce est retirée (EF-D8)
     *
     * Utilisation :
     *   $bailleur->notify(new AnnonceValideeNotification($property));
     *   $user->unreadNotifications->count();
     *   $user->notifications()->markAsRead();
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            // UUID comme PK (standard Laravel)
            $table->uuid('id')->primary();

            // Type de notification (nom de classe complet)
            $table->string('type');

            // Polymorphisme : peut notifier n'importe quel modèle
            $table->string('notifiable_type');
            $table->unsignedBigInteger('notifiable_id');

            // Contenu JSON flexible selon le type de notification
            $table->json('data');

            // NULL = non lu, timestamp = lu à cette date
            $table->timestamp('read_at')->nullable()->index();

            $table->timestamps();

            // Index pour récupérer les notifs d'un user rapidement
            $table->index(['notifiable_type', 'notifiable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
