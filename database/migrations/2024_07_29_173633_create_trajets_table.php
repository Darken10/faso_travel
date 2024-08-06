<?php

use App\Models\User;
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
        Schema::create('trajets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->unsignedBigInteger('depart_id');
            $table->unsignedBigInteger('arriver_id');
            $table->integer('distance',unsigned:True)->nullable()->default(0);
            $table->time('temps')->nullable();
            $table->tinyInteger('etat')->nullable()->min(0)->max(10);
            $table->foreign('depart_id')->on('villes')->references('id');
            $table->foreign('arriver_id')->on('villes')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trajets');
    }
};
