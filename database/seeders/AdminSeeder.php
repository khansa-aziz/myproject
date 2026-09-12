<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\AdminPermission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get an active role
        $role = Role::where('status', 1)->first();

        /*
        |--------------------------------------------------------------------------
        | Create / Update 100 Admins
        |--------------------------------------------------------------------------
        */

        for ($i = 1; $i <= 100; $i++) {

            Admin::updateOrCreate(
                [
                    'email' => 'admin' . $i . '@example.com',
                ],
                [
                    'name' => 'Admin ' . $i,
                    'password' => Hash::make('12345678'),
                    'status' => 1,
                    'role_id' => $role?->id,
                    'image' => null,
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Assign Permissions to First 5 Seeded Admins
        |--------------------------------------------------------------------------
        */

        $admins = Admin::whereIn('email', [
            'admin1@example.com',
            'admin2@example.com',
            'admin3@example.com',
            'admin4@example.com',
            'admin5@example.com',
        ])->get();

        $modules = [
            'dashboard',
            'admins',
            'roles',
            'permissions',
        ];

        foreach ($admins as $admin) {

            foreach ($modules as $module) {

                AdminPermission::updateOrCreate(
                    [
                        'admin_id' => $admin->id,
                        'module' => $module,
                    ],
                    [
                        'permission' => 'read_write',
                    ]
                );
            }
        }
    }
}