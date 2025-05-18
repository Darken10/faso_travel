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
        // migration
        Schema::create('compagnie_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compagnie_id')->constrained()->onDelete('cascade');
            $table->string('key'); // exemple : "paiement_en_ligne"
            $table->string('value'); // exemple : "true", "2", etc.
            $table->string('type')->default('string'); // "bool", "int", "json", etc.
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compagnie_settings');
    }
};
