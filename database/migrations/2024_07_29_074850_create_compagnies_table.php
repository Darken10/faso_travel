<?php

use App\Models\User;
use App\Models\Statut;
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
        Schema::create('compagnies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('sigle')->unique();
            $table->string('slogant')->nullable();
            $table->text('description')->nullable();
            $table->string('logo_uri')->nullable();
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Statut::class)->default(2)->constrained()->noActionOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compagnies');
    }
};
