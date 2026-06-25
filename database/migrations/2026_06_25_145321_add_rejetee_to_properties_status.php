<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Ajouter 'rejetee' dans l'ENUM status
            $table->enum('status', ['en_attente', 'publiee', 'rejetee', 'retiree'])
                ->default('en_attente')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Retirer 'rejetee' de l'ENUM status
            $table->enum('status', ['en_attente', 'publiee', 'retiree'])
                ->default('en_attente')
                ->change();
        });
    }
};

