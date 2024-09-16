<?php

namespace Database\Seeders\Ville;

use App\Models\Ville\Ville;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = fopen('storage\data\data.json', 'r');
        $d = "";
        while (!feof($data)) {
            $d = $d . fgets($data);
        }
        $villes = json_decode($d);
        foreach ($villes as $ville) {
            Ville::create([
                'name'=> $ville->name,
                'region_id'=> $ville->region_id,
                'lat'=> $ville->lat,
                'lng'=> $ville->lng,
            ]);
        }
    }
}
