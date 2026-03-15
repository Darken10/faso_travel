<?php

namespace Database\Seeders;

use App\Enums\CompanyRole;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // System roles
        $systemRoles = [
            ['name' => 'user', 'label' => 'Utilisateur'],
            ['name' => 'admin', 'label' => 'Administrateur'],
            ['name' => 'root', 'label' => 'Super Administrateur'],
        ];

        foreach ($systemRoles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }

        // Company roles
        foreach (CompanyRole::cases() as $companyRole) {
            Role::firstOrCreate(
                ['name' => $companyRole->value],
                ['name' => $companyRole->value, 'label' => $companyRole->label()]
            );
        }
    }
}
