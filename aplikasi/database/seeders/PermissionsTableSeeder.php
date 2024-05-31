<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array of permissions
        $permissions = [
            'superadmin.index', 'superadmin.create', 'superadmin.edit', 'superadmin.delete',
            'posts.index', 'posts.create', 'posts.edit', 'posts.delete',
            'tags.index', 'tags.create', 'tags.edit', 'tags.delete',
            'categories.index', 'categories.create', 'categories.edit', 'categories.delete',
            'events.index', 'events.create', 'events.edit', 'events.delete',
            'photos.index', 'photos.create', 'photos.delete',
            'videos.index', 'videos.create', 'videos.edit', 'videos.delete',
            'sliders.index', 'sliders.create', 'sliders.delete',
            'roles.index', 'roles.create', 'roles.edit', 'roles.delete',
            'permissions.index',
            'users.index', 'users.create', 'users.edit', 'users.delete'
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create 'admin' role if it doesn't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Assign all permissions to 'admin' role
        $adminRole->syncPermissions($permissions);

        // Find the user with ID 3 and assign 'admin' role to them
        $user = User::find(3); // Change 3 to the ID of the user you want to assign permissions to
        $user->assignRole($adminRole);
    }
}
