<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        if (!config('seeder.skip_user')) {
            $this->call(UserSeeder::class);
        }

        $this->call([
            SyncPermissionsSeeder::class,
            RolePermissionSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
