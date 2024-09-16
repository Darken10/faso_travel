<?php

namespace Database\Seeders;

use App\Enums\UserRole;
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

        User::create([
            'name' => 'Darken',
            'email' => 'darken@darken.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
            'role'=> UserRole::User
       ]) ;
        User::create([
            'name' => 'Client',
            'email' => 'client@client.com',
            'email_verified_at' => now(),
            'password' =>  Hash::make('password'),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
            'role'=> UserRole::User
        ]) ;
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
            'role'=> UserRole::Admin
        ]) ;
        User::create([
            'name' => 'Root',
            'email' => 'root@root.com',
            'email_verified_at' => now(),
            'password' =>  Hash::make('password'),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
            'role'=> UserRole::Root
        ]) ;
        User::create([
            'name' => 'Companie Bosse',
            'email' => 'comapgnie@bosse.com',
            'email_verified_at' => now(),
            'password' =>  Hash::make('password'),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
            'role'=> UserRole::CompagnieBosse
        ]) ;


        $this->call([
            StatutSeeder::class,
            PaysSeeder::class,
            RegionSeeder::class,
            VilleSeeder::class,
            CompagnieSeeder::class,
        ]);
    }
}
