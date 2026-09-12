<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'View Permission',
                'slug' => 'view-permission',
            ],
            [
                'name' => 'Add Permission',
                'slug' => 'add-permission',
            ],
            [
                'name' => 'Edit Permission',
                'slug' => 'edit-permission',
            ],
            [
                'name' => 'Delete Permission',
                'slug' => 'delete-permission',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['slug' => $permission['slug']],
                $permission
            );
        }
    }
}