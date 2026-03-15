<?php

namespace Database\Seeders\Voyage;

use App\Models\Voyage\Classe;
use App\Models\Voyage\Confort;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get an admin user for ownership
        $adminUser = User::whereIn('role', ['admin', 'root'])->first()
            ?? User::first();

        if (!$adminUser) {
            $this->command->warn('No users found. Please run UserSeeder first.');
            return;
        }

        // Get all comfort IDs
        $confortIds = Confort::pluck('id')->toArray();

        if (empty($confortIds)) {
            $this->command->warn('No conforts found. Please run ConfortSeeder first.');
            return;
        }

        $classes = [
            [
                'name' => 'Classe Économique',
                'description' => 'Option budgétaire avec équipements de base'
            ],
            [
                'name' => 'Classe Standard',
                'description' => 'Confort standard avec services essentiels'
            ],
            [
                'name' => 'Classe Affaires',
                'description' => 'Classe haut de gamme avec services premium'
            ],
            [
                'name' => 'Classe VIP',
                'description' => 'Classe de luxe avec tous les services disponibles'
            ]
        ];

        // Map classes to comfort levels by percentage of available conforts
        $classComfortMapping = [
            0 => [0, 1],  // Économique: Climatisation, WiFi
            1 => [0, 1, 2, 4],  // Standard: AC, WiFi, Siège, USB
            2 => [0, 1, 2, 3, 4, 5, 9],  // Affaires: AC, WiFi, Siège, Service, USB, Film, Conducteur
            3 => range(0, count($confortIds) - 1)  // VIP: tous les conforts
        ];

        foreach ($classes as $classIndex => $classData) {
            $classe = Classe::create([
                'name' => $classData['name'],
                'description' => $classData['description'] ?? '',
                'user_id' => $adminUser->id
            ]);

            // Attach conforts (use only valid indices)
            $comfortIndices = $classComfortMapping[$classIndex] ?? [0, 1];
            $comfortIdsToSync = [];
            foreach ($comfortIndices as $idx) {
                if (isset($confortIds[$idx])) {
                    $comfortIdsToSync[] = $confortIds[$idx];
                }
            }

            if (!empty($comfortIdsToSync)) {
                $classe->conforts()->sync($comfortIdsToSync);
            }
        }
    }
}
