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
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Ticket\AutrePersonne::class)->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_my_ticket')->default(true);
            $table->dateTime('transferer_at')->nullable();
            $table->bigInteger('valider_by_id')->nullable();
            $table->dateTime('valider_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('is_my_ticket');
            $table->dropColumn('transferer_at');
            $table->dropColumn('autre_personne_id');
            $table->dropColumn('valider_by_id');
            $table->dropColumn('valider_at');
        });
    }
};
