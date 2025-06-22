<?php

use App\Models\User;
use App\Models\Voyage\Classe;
use App\Models\Voyage\Trajet;
use App\Models\Compagnie\Care;
use App\Models\Compagnie\Compagnie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('voyages', function (Blueprint $table) {
            $table->id();
            $table->time('heure');
            $table->unsignedBigInteger('prix')->default(0);
            $table->unsignedBigInteger('prix_aller_retour')->default(0);
            $table->boolean('is_quotidient')->default(true);
            $table->time('temps')->nullable();
            $table->json('days')->nullable();
            $table->foreignIdFor(Trajet::class)->constrained()->restrictOnDelete();
            $table->foreignIdFor(User::class)->constrained()->restrictOnDelete();
            $table->foreignIdFor(Compagnie::class)->constrained()->restrictOnDelete();
            $table->foreignIdFor(Classe::class)->default(1)->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voyages');
    }
};
