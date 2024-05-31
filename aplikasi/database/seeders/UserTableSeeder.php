<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Temukan atau buat peran "admin"
        $adminRole = Role::where('name', 'admin')->first();
        if (!$adminRole) {
            $adminRole = Role::create(['name' => 'admin']);
        }

        // Ambil semua pengguna
        $users = User::all();

        // Berikan peran "admin" kepada setiap pengguna
        foreach ($users as $user) {
            $user->assignRole($adminRole);
        }

        $this->command->info('Hak akses "admin" diberikan kepada semua pengguna.');
    }
}
