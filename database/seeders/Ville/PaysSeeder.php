<?php

namespace Database\Seeders\Ville;

use App\Models\Ville\Pays;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [ 'name'=>'Burkina Faso', 'identity_number'=> 226, 'money'=>'XOF', 'iso2'=>'BF' ],
            [ 'name'=>'Cote d\'Ivoire', 'identity_number'=> 225, 'money'=>'XOF','iso2'=>'CI'],
            [ 'name'=>'Mali', 'identity_number'=> 224, 'money'=>'XOF','iso2'=>'ML'],
            [ 'name'=>'Niger', 'identity_number'=> 223, 'money'=>'XOF','iso2'=>'NE'],
        ];

        foreach ($data as $pays) {
            Pays::create($pays);
        }
    }
}
