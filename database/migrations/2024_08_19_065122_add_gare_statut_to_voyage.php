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
        Schema::table('voyages', function (Blueprint $table) {
            $table->bigInteger('depart_id')->unsigned()->nullable();
            $table->foreign('depart_id')->references('id')->on('gares')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('arrive_id')->unsigned()->nullable();
            $table->foreign('arrive_id')->references('id')->on('gares')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Statut::class)->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('voyages', function (Blueprint $table) {
            $table->dropForeign('voyages_depart_id_foreign');
            $table->dropForeign('voyages_arrive_id_foreign');
        });
    }
};
