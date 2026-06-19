<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table : users
     * Acteurs : Client, Bailleur, Agent, Manager
     * Exigences : EF-A2, EF-A3, EF-A4, ENF-5, ENF-8, EF-D5
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Identité
            $table->string('name', 100);
            $table->string('email', 150)->unique();
            $table->string('password');                          // hashé bcrypt (ENF-5)
            $table->enum('role', ['client', 'bailleur', 'agent', 'manager']);

            // Profil
            $table->string('phone', 20)->nullable();
            $table->string('avatar', 500)->nullable();           // chemin fichier (ENF-11)
            $table->string('address', 300)->nullable();

            // Statut du compte
            $table->boolean('is_active')->default(true)->index(); // suspension sans suppression (EF-D5)

            // Laravel auth
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // Index pour les filtres fréquents
            $table->index('role');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
