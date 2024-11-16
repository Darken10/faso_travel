<?php

use App\Models\Compagnie\Care;
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
        Schema::create('care_voyage', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Care::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Voyage::class)->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('care_voyage');
    }
};
