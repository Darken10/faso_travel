<?php

use App\Enums\StatutTicket;
use App\Enums\TypeTicket;
use App\Models\User;
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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Voyage::class)->nullable()->constrained()->nullOnDelete();
            $table->boolean("a_bagage")->nullable()->default(false);
            $table->json("bagages_data")->nullable();
            $table->date('date');
            $table->enum('type',TypeTicket::values());
            $table->enum('statut',StatutTicket::values());
            $table->string('numero_ticket');
            $table->unsignedInteger('numero_chaise')->nullable();
            $table->string('code_sms');
            $table->string('code_qr');
            $table->string('image_uri')->nullable();
            $table->string('pdf_uri')->nullable();
            $table->string('code_qr_uri')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
