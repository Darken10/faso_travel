<?php

namespace Database\Seeders;

use App\Models\Compagnie\Gare;
use App\Models\User;
use App\Models\Voyage\Classe;
use Illuminate\Database\Seeder;

class DefaultsSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::whereIn('role', ['root', 'admin'])->first() ?? User::first();
        $userId = $adminUser?->id ?? 1;

        // ── Default Classes ──────────────────────────────────────────────
        $defaultClasses = [
            ['name' => 'Économique',   'description' => 'Classe standard — sièges simples rembourrés'],
            ['name' => 'Confort',       'description' => 'Classe intermédiaire — sièges spacieux avec repose-pieds'],
            ['name' => 'VIP',           'description' => 'Classe premium — sièges inclinables, climatisation renforcée'],
            ['name' => 'Affaires',      'description' => 'Classe business — sièges larges, service personnalisé'],
        ];

        foreach ($defaultClasses as $data) {
            Classe::withoutGlobalScopes()->firstOrCreate(
                ['name' => $data['name'], 'is_default' => true],
                [
                    'description' => $data['description'],
                    'user_id'     => $userId,
                    'compagnie_id' => null,
                    'is_default'  => true,
                ]
            );
        }

        // ── Default Gares (principales gares routières du Burkina Faso) ──
        // We skip them if no statut exists (statut_id required on Gare)
        $statut = \App\Models\Statut::first();
        if (!$statut) {
            $this->command->warn('Aucun statut trouvé — gares par défaut non créées. Créez d\'abord un statut.');
            return;
        }

        $defaultGares = [
            // Ouagadougou
            ['name' => 'Gare Routière de Ouagadougou (Nord)',    'ville' => 'Ouagadougou'],
            ['name' => 'Gare Routière de Ouagadougou (Est)',     'ville' => 'Ouagadougou'],
            ['name' => 'Gare Routière de Ouagadougou (Ouest)',   'ville' => 'Ouagadougou'],
            // Bobo-Dioulasso
            ['name' => 'Gare Routière de Bobo-Dioulasso',        'ville' => 'Bobo-Dioulasso'],
            // Autres villes
            ['name' => 'Gare Routière de Koudougou',             'ville' => 'Koudougou'],
            ['name' => 'Gare Routière de Banfora',               'ville' => 'Banfora'],
            ['name' => 'Gare Routière de Dédougou',              'ville' => 'Dédougou'],
            ['name' => 'Gare Routière de Fada N\'Gourma',        'ville' => 'Fada N\'Gourma'],
            ['name' => 'Gare Routière de Ouahigouya',            'ville' => 'Ouahigouya'],
            ['name' => 'Gare Routière de Tenkodogo',             'ville' => 'Tenkodogo'],
            ['name' => 'Gare Routière de Kaya',                  'ville' => 'Kaya'],
            ['name' => 'Gare Routière de Manga',                 'ville' => 'Manga'],
            ['name' => 'Gare Routière de Dori',                  'ville' => 'Dori'],
            ['name' => 'Gare Routière de Ziniaré',               'ville' => 'Ziniaré'],
            ['name' => 'Gare Routière de Kongoussi',             'ville' => 'Kongoussi'],
            ['name' => 'Gare Routière de Réo',                   'ville' => 'Réo'],
            ['name' => 'Gare Routière de Léo',                   'ville' => 'Léo'],
            ['name' => 'Gare Routière de Pô',                    'ville' => 'Pô'],
            ['name' => 'Gare Routière de Gaoua',                 'ville' => 'Gaoua'],
            ['name' => 'Gare Routière de Diébougou',             'ville' => 'Diébougou'],
        ];

        foreach ($defaultGares as $data) {
            $ville = \App\Models\Ville\Ville::where('name', 'like', '%' . $data['ville'] . '%')->first();

            if (!$ville) {
                $this->command->warn("Ville '{$data['ville']}' introuvable — gare ignorée: {$data['name']}");
                continue;
            }

            Gare::withoutGlobalScopes()->firstOrCreate(
                ['name' => $data['name'], 'is_default' => true],
                [
                    'user_id'      => $userId,
                    'compagnie_id' => null,
                    'ville_id'     => $ville->id,
                    'statut_id'    => $statut->id,
                    'lat'          => 0,
                    'lng'          => 0,
                    'is_default'   => true,
                ]
            );
        }

        $this->command->info('Classes et gares par défaut créées avec succès.');
    }
}
