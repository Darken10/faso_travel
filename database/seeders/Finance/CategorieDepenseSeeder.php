<?php

namespace Database\Seeders\Finance;

use App\Models\Compagnie\Compagnie;
use App\Models\Finance\CategorieDepense;
use Illuminate\Database\Seeder;

class CategorieDepenseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nom' => 'Carburant', 'description' => 'Gasoil, essence, lubrifiant'],
            ['nom' => 'Entretien véhicules', 'description' => 'Réparations, vidange, pneus, pièces'],
            ['nom' => 'Salaires', 'description' => 'Salaires chauffeurs, agents, personnel'],
            ['nom' => 'Péage & Parking', 'description' => 'Frais de péage et stationnement'],
            ['nom' => 'Assurance', 'description' => 'Assurance véhicules et responsabilité'],
            ['nom' => 'Loyer & Bureau', 'description' => 'Location gare, bureau, entrepôt'],
            ['nom' => 'Fournitures', 'description' => 'Tickets, carnets, matériel de bureau'],
            ['nom' => 'Communication', 'description' => 'Téléphone, internet, publicité'],
            ['nom' => 'Taxes & Impôts', 'description' => 'Patente, vignette, taxes municipales'],
            ['nom' => 'Divers', 'description' => 'Autres dépenses non classées'],
        ];

        foreach (Compagnie::all() as $compagnie) {
            foreach ($categories as $category) {
                CategorieDepense::firstOrCreate(
                    ['compagnie_id' => $compagnie->id, 'nom' => $category['nom']],
                    ['description' => $category['description']]
                );
            }
        }
    }
}
