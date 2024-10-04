<?php

namespace Database\Seeders\Voyage;

use App\Models\voyage\Classe;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['classe Classique', 'Classe A', 'Classe B', 'Classe C', 'Classe D', 'Classe VIP'];
        foreach ($data as $classeName){
            /**
             * @var Classe $classe
            */
            $classe = Classe::create([
                'name'=>$classeName
            ]);
            $classe->conforts()->sync([rand(1,10),rand(1,10),rand(1,10)]);
        }
    }
}
