<?php

use App\Models\Voyage\Confort;
use App\Models\Voyage\Voyage;
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
        Schema::create('confort_voyage', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Confort::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Voyage::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confort_voyage');
    }
};
