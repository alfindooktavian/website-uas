<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if "admin" role already exists
        $adminRole = Role::where('name', 'admin')->first();

        // If "admin" role doesn't exist, create it
        if (!$adminRole) {
            Role::create([
                'name' => 'admin'
            ]);
        }

        // Check if "superadmin" role already exists
        $superadminRole = Role::where('name', 'superadmin')->first();

        // If "superadmin" role doesn't exist, create it
        if (!$superadminRole) {
            Role::create([
                'name' => 'superadmin'
            ]);
        }
    }
}