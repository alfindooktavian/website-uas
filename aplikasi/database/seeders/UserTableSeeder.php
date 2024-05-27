<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        // Ambil pengguna dengan ID 3
        $user = User::find(3);

        // Periksa apakah pengguna ditemukan
        if ($user) {
            // Temukan peran "admin"
            $adminRole = Role::where('name', 'admin')->first();

            // Jika peran "admin" ditemukan
            if ($adminRole) {
                // Berikan peran "admin" kepada pengguna
                $user->assignRole($adminRole->name);
            } else {
                // Jika peran "admin" tidak ditemukan, beri tahu pengguna
                $this->command->info('Role "admin" tidak ditemukan.');
            }
        } else {
            // Jika pengguna dengan ID 3 tidak ditemukan, beri tahu pengguna
            $this->command->info('Pengguna dengan ID 3 tidak ditemukan.');
        }
    }
}
