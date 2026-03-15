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
        Schema::table('classes', function (Blueprint $table) {
            // nullable compagnie_id: null = default class (all companies), set = company-specific
            $table->foreignId('compagnie_id')->nullable()->after('user_id')->constrained('compagnies')->nullOnDelete();
            $table->boolean('is_default')->default(false)->after('compagnie_id');
        });
    }

    public function down(): void
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('compagnie_id');
            $table->dropColumn('is_default');
        });
    }
};
