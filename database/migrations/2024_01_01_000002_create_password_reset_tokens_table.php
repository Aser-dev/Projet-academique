<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table : password_reset_tokens
     * Standard Laravel — réinitialisation sécurisée du mot de passe
     * Exigences : ENF-5, EF-A3
     */
    public function up(): void
    {
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email', 150)->primary();     // un seul token par email
            $table->string('token');                     // token hashé (ENF-5)
            $table->timestamp('created_at')->nullable(); // expire après X minutes
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};
