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
        Schema::table('gares', function (Blueprint $table) {
            // null compagnie_id = default gare available to everyone
            $table->boolean('is_default')->default(false)->after('compagnie_id');
            // Allow compagnie_id to be nullable for shared/default gares
            $table->foreignId('compagnie_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('gares', function (Blueprint $table) {
            $table->dropColumn('is_default');
            $table->foreignId('compagnie_id')->nullable(false)->change();
        });
    }
};
