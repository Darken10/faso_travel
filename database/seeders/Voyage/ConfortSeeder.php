<?php

namespace Database\Seeders\Voyage;

use App\Models\Voyage\Confort;
use App\Models\User;
use Illuminate\Database\Seeder;

class ConfortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get an admin user for ownership
        $adminUser = User::whereIn('role', ['admin', 'root'])->first()
            ?? User::first();

        $conforts = [
            [
                'title' => 'Climatisation',
                'description' => 'Véhicule équipé d\'air conditionné pour plus de confort'
            ],
            [
                'title' => 'WiFi',
                'description' => 'Accès WiFi gratuit pendant le trajet'
            ],
            [
                'title' => 'Siège Premium',
                'description' => 'Sièges spacieux et confortables avec repose-tête'
            ],
            [
                'title' => 'Service à Bord',
                'description' => 'Service de boissons et en-cas pendant le voyage'
            ],
            [
                'title' => 'USB & Prise',
                'description' => 'Port USB et prise secteur pour chaque passager'
            ],
            [
                'title' => 'Film & Divertissement',
                'description' => 'Écran individuel avec films et divertissements'
            ],
            [
                'title' => 'Repas Inclus',
                'description' => 'Repas ou collation inclus dans le trajet'
            ],
            [
                'title' => 'Toilettes Bord',
                'description' => 'Toilettes disponibles à bord du véhicule'
            ],
            [
                'title' => 'Bagages Premium',
                'description' => 'Bagage supplémentaire inclus sans frais'
            ],
            [
                'title' => 'Conducteur Expérimenté',
                'description' => 'Conducteur professionnel expérimenté et courtois'
            ]
        ];

        if ($adminUser) {
            foreach ($conforts as $confort) {
                Confort::create([
                    'title' => $confort['title'],
                    'description' => $confort['description'],
                    'user_id' => $adminUser->id
                ]);
            }
        }
    }
}
