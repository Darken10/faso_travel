<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('caisses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('compagnie_id')->constrained('compagnies')->cascadeOnDelete();
            $table->unsignedBigInteger('montant_ouverture')->default(0);
            $table->unsignedBigInteger('montant_fermeture')->nullable();
            $table->unsignedBigInteger('montant_attendu')->nullable();
            $table->string('statut')->default('ouverte');
            $table->timestamp('opened_at');
            $table->timestamp('closed_at')->nullable();
            $table->text('note_ouverture')->nullable();
            $table->text('note_fermeture')->nullable();
            $table->timestamps();
        });

        // Link tickets to a cash register session
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreignId('caisse_id')->nullable()->constrained('caisses')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropConstrainedForeignId('caisse_id');
        });
        Schema::dropIfExists('caisses');
    }
};
