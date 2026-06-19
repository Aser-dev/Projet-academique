<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajouter assigned_agent_id pour EF-D6 : Affectation client-agent
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'assigned_agent_id')) {
                $table->unsignedBigInteger('assigned_agent_id')->nullable()->after('is_active');
                $table->foreign('assigned_agent_id')->references('id')->on('users')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'assigned_agent_id')) {
                $table->dropForeign(['assigned_agent_id']);
                $table->dropColumn('assigned_agent_id');
            }
        });
    }
};
