<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = [
            ['username' => 'superadmin', 'name' => 'Superadmin', 'role' => 'Super Admin'],
            ['username' => 'admin', 'name' => 'Admin', 'role' => 'admin'],
            ['username' => 'user', 'name' => 'User', 'role' => 'user'],
        ];

        foreach ($data as $item) {
            $user = User::updateOrCreate(
                ['username' => $item['username']],
                [
                    'name'     => $item['name'],
                    'username' => $item['username'],
                    'email'    => $item['username'] . '@email.com',
                    'password' => bcrypt('password'),
                ]
            );

            if (! empty($item['role'])) {
                $user->assignRole($item['role']);
            }
        }
    }
}
