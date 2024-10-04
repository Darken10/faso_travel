<?php

namespace Database\Seeders\Compagnie;

use Illuminate\Database\Seeder;
use App\Models\Compagnie\Compagnie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompagnieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $compagnies = [
            [ 'name' => 'Saramaya Transport', 'sigle' => 'SARAMAYA', 'slogant' => 'Toujours plus rapide', 'description' => 'Un description bref Saramaya', 'logo_uri' => '', 'user_id' => 1, ],
            [ 'name' => 'Elitice Transport', 'sigle' => 'ELITISE', 'slogant' => 'Toujours dans le confort', 'description' => 'Un description bref Elitis', 'logo_uri' => '', 'user_id' => 1, ],
            [ 'name' => 'Rayimo Transport', 'sigle' => 'RAYIMO', 'slogant' => 'Le confort et la rapiditer est au rendez-vous', 'description' => 'Un description bref Rayimo', 'logo_uri' => '', 'user_id' => 1, ],
        ];

        foreach($compagnies as $compagnie){
            Compagnie::create($compagnie);
        }
    }
}
