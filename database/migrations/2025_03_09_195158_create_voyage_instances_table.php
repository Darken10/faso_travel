<?php

use App\Models\Compagnie\Care;
use App\Models\Compagnie\Chauffer;
use App\Models\Voyage\Voyage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('voyage_instances', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignIdFor(Voyage::class);
            $table->foreignIdFor(Care::class)->nullable();
            $table->foreignIdFor(Chauffer::class)->nullable();
            $table->date("date");
            $table->time("heure");
            $table->unsignedInteger("nb_place");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voyage_instances');
    }
};
