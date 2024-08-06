<?php

namespace Database\Seeders\Ville;

use App\Models\Ville\Region;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            ['name'=>'Centre', 'pays_id'=>1],
            ['name'=>'Hauts-Bassins', 'pays_id'=>1],
            ['name'=>'Centre-Ouest', 'pays_id'=>1],
            ['name'=>'Nord', 'pays_id'=>1],
            ['name'=>'Centre-Nord', 'pays_id'=>1],
            ['name'=>'Cascades', 'pays_id'=>1],
            ['name'=>'Centre-Est', 'pays_id'=>1],
            ['name'=>'Sud-Ouest', 'pays_id'=>1],
            ['name'=>'Est', 'pays_id'=>1],
            ['name'=>'Boucle du Mouhoun', 'pays_id'=>1],
            ['name'=>'Sahel', 'pays_id'=>1],
            ['name'=>'Plateau-Central', 'pays_id'=>1],
            ['name'=>'Centre-Sud', 'pays_id'=>1],
            //CI
            ['name'=>'Abidjan','pays_id'=>2],               // 14
            ['name'=>'Vallée du Bandama','pays_id'=>2],     //15
            ['name'=>'Sassandra-Marahoué','pays_id'=>2],    //16
            ['name'=>'Bas-Sassandra','pays_id'=>2],
            ['name'=>'Savanes','pays_id'=>2],               //18
            ['name'=>'Gôh-Djiboua','pays_id'=>2],
            ['name'=>'Montagnes','pays_id'=>2],             //20
            ['name'=>'Comoé','pays_id'=>2],
            ['name'=>'Lagunes','pays_id'=>2],               //22
            ['name'=>'Zanzan','pays_id'=>2],
            ['name'=>'Lacs','pays_id'=>2],                  // 24 
            ['name'=>'Denguélé','pays_id'=>2],
            ['name'=>'Woroba','pays_id'=>2],                //26
            ['name'=>'Yamoussoukro','pays_id'=>2],
            //Mali
            ['name'=>'Bamako','pays_id'=> 3],               //28
            ['name'=>'Kayes', 'pays_id'=> 3],               //29
            ['name'=>'Sikasso', 'pays_id'=> 3],             //30
            ['name'=>'Ségou', 'pays_id'=> 3],               
            ['name'=>'Mopti', 'pays_id'=> 3],                //32
            ['name'=>'Koulikoro', 'pays_id'=> 3],
            ['name'=>'Gao', 'pays_id'=> 3],                   //34
            ['name'=>'Tombouctou', 'pays_id'=> 3],
            ['name'=>'Kidal', 'pays_id'=> 3],                 //36
            //Niger
            ['name'=>'Niamey', 'pays_id'=> 4],                 //37
            ['name'=>'Maradi', 'pays_id'=> 4],                  //38
            ['name'=>'Zinder', 'pays_id'=> 4],
            ['name'=>'Tahoua', 'pays_id'=> 4],                  //40
            ['name'=>'Agadez', 'pays_id'=> 4],
            ['name'=>'Tillabéri', 'pays_id'=> 4],               //42
            ['name'=>'Dosso', 'pays_id'=> 4],
            ['name'=>'Diffa', 'pays_id'=> 4],                   // 43
        ];      

        foreach($regions as $region){
            Region::create($region);
        }
    }
}
