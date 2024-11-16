<?php

use App\Models\Compagnie\Care;
use App\Models\Compagnie\Compagnie;
use App\Models\User;
use App\Models\Voyage\Classe;
use App\Models\Voyage\Trajet;
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
        Schema::create('voyages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Trajet::class)->constrained()->restrictOnDelete();
            $table->foreignIdFor(User::class)->constrained()->restrictOnDelete();
            $table->time('heure');
            $table->foreignIdFor(Compagnie::class)->constrained()->restrictOnDelete();
            $table->unsignedBigInteger('prix')->default(0);
            $table->foreignIdFor(Classe::class)->default(1)->constrained()->restrictOnDelete();
            $table->foreignIdFor(Care::class)->nullable()->constrained()->nullOnDelete();
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
