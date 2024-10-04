<?php

namespace Database\Seeders;

use App\Models\Statut;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $table = ['Activer','Désactiver','Pause','Bloquer'];
        foreach ($table as $key => $value) {
            Statut::create([
                'name'=> $value
            ]);
        }
    }
}
