<?php

use App\Models\User;
use App\Models\Statut;
use App\Models\Ville\Ville;
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
        Schema::create('gares', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('lng');
            $table->double('lat');
            $table->foreignIdFor(Ville::class)->constrained()->restrictOnDelete();
            $table->foreignIdFor(Statut::class)->constrained()->restrictOnDelete();
            $table->foreignIdFor(User::class)->constrained()->restrictOnDelete();
            $table->foreignIdFor(Compagnie::class)->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gares');
    }
};
