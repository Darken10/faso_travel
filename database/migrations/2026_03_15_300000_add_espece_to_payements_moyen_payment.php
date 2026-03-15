<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE payements MODIFY COLUMN moyen_payment ENUM('Orange Money','Moov Money','LigdiCash','Carte Visa','Coris Money','Wave','Espèce') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE payements MODIFY COLUMN moyen_payment ENUM('Orange Money','Moov Money','LigdiCash','Carte Visa','Coris Money','Wave') NOT NULL");
    }
};
