<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $table = ['user','admin','root'];
        foreach ($table as $key => $value) {
            Role::create([
                'name'=> $value
            ]);
        }
    }
}
