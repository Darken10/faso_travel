<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('retour_validate_by')->nullable();
            $table->foreign('retour_validate_by')->references('id')->on('users')->nullOnDelete()->cascadeOnUpdate();
            $table->dateTime('retour_validate_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('retour_validate_by');
            $table->dropColumn('retour_validate_at');
        });
    }
};
