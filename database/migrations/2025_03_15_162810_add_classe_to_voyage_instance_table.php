<?php

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
        Schema::table('voyage_instances', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Voyage\Classe::class)->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('prix')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('voyage_instances', function (Blueprint $table) {
            $table->dropColumn('classe_id');
            $table->dropColumn('prix');
        });
    }
};
