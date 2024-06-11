<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super-Admin',
            ],
            [
                'name' => 'User',
            ],
        ];

        foreach ($roles as $role) {
            // Check if the role already exists
            $existingRole = Role::where('name', $role['name'])->first();

            if (!$existingRole) {
                // Insert the role into the database if it does not exist.
                Role::create($role);
            }
        }
    }
}
