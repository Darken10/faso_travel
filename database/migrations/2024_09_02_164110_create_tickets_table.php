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
            $table->json("bagages")->nullable();
            $table->date('date');
            $table->enum('type',TypeTicket::values());
            $table->enum('statut',StatutTicket::values());
            $table->string('code_ticket');
            $table->string('code_qr')->nullable();
            $table->string('ticket_image')->nullable();
            $table->string('ticket_pdf')->nullable();
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
