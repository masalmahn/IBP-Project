<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'username' => 'super-admin',
                'firstname' => 'Super',
                'lastname' => 'Admin',
                'email' => 'super-admin@naser.com',
                'password' => 'secret',
                'role' => 'Super-Admin'
            ],
            [
                'username' => 'user',
                'firstname' => 'Example',
                'lastname' => 'User',
                'email' => 'user@naser.com',
                'password' => 'secret',
                'role' => 'User'
            ],
        ];

        foreach ($admins as $admin) {

            $existingAdmin = User::whereEmail($admin['email'])->first();

            if (!$existingAdmin) {

                $createdAdmin = User::create(Arr::except($admin, 'role'));

                $createdAdmin->syncRoles($admin['role']);
            }
        }


    }
}
