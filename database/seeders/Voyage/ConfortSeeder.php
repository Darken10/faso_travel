<?php

namespace Database\Seeders\Voyage;

use App\Models\Voyage\Confort;
use Illuminate\Database\Seeder;

class ConfortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Confort::factory(10)->create();

    }
}
