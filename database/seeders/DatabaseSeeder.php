<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\Ville\PaysSeeder;
use Database\Seeders\Ville\VilleSeeder;
use Database\Seeders\Ville\RegionSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Compagnie\CompagnieSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();

        /*User::factory()->withPersonalTeam()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        /*$user = User::create([
            'name' => 'Darken Root',
            'email' => 'darken@darken.com',
            'email_verified_at' => now(),
            'password' =>  Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);*/

        
        $this->call([
            StatutSeeder::class,
            RoleSeeder::class,
            PaysSeeder::class,
            RegionSeeder::class,
            VilleSeeder::class,
            CompagnieSeeder::class,
        ]);
        //$user->roles()->attach([1,2,3]);
    }
}
