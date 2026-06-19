<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table : property_usages
     * Remplace le JSON usages — respecte la 1NF et 3NF
     * Un bien peut avoir plusieurs usages : résidence, bureau, commerce, agriculture
     * Exigences : EF-C1, EF-B1
     *
     * Utilisation Eloquent :
     *   $property->usages  → collection
     *   Property::whereHas('usages', fn($q) => $q->where('usage', 'bureau'))->get()
     */
    public function up(): void
    {
        Schema::create('property_usages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('property_id')
                  ->constrained('properties')
                  ->cascadeOnDelete();

            $table->enum('usage', ['residence', 'bureau', 'commerce', 'agriculture']);

            $table->timestamp('created_at')->useCurrent();

            // Un bien ne peut pas avoir deux fois le même usage
            $table->unique(['property_id', 'usage']);

            $table->index('usage'); // filtre EF-B1
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_usages');
    }
};
