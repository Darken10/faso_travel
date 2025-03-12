<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('chauffers', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("first_name");
            $table->string("last_name");
            $table->date("date_naissance");
            $table->string("genre");
            $table->foreignId("compagnie_id");
            $table->string("statut");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chauffers');
    }
};
