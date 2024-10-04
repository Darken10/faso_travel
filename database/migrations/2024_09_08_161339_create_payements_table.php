<?php

use App\Enums\MoyenPayment;
use App\Enums\StatutPayement;
use App\Enums\StatutTicket;
use App\Models\Ticket\Ticket;
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
        Schema::create('payements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ticket::class)->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('numero_payment')->nullable();
            $table->unsignedBigInteger('montant')->default(0);
            $table->string("trans_id")->nullable();
            $table->string("token")->nullable();
            $table->unsignedBigInteger('code_otp')->nullable();
            $table->enum('statut', StatutPayement::values())->default(StatutTicket::EnAttente);
            $table->enum('moyen_payment', MoyenPayment::values());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payements');
    }
};
