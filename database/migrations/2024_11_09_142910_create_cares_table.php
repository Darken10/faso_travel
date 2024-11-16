<?php

use App\Enums\StatutCare;
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
        Schema::create('cares', function (Blueprint $table) {
            $table->id();
            $table->string('immatrculation');
            $table->unsignedSmallInteger('number_place')->default(1);
            $table->enum('statut',StatutCare::values());
            $table->unsignedSmallInteger('etat')->default(1)->min(0)->max(10);
            $table->string('image_uri');
            $table->foreignIdFor(App\Models\Compagnie\Compagnie::class)->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cares');
    }
};
