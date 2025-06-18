<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create roles
        $RoleSuperAdmin = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $RoleAdmin      = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $RoleUser       = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        // get permissions
        $permissions = Permission::pluck('name')->toArray();
        $userPermissions = [
            'view-any FornasEvent',
            'view FornasEvent',

            'view-any FornasRegistration',
            'view FornasRegistration',
            'create FornasRegistration',
            'update FornasRegistration',

            'view-any FornasParticipant',
            'view FornasParticipant',
            'create FornasParticipant',
            'update FornasParticipant',

            'view-any FornasParticipantFile',
            'view FornasParticipantFile',
            'create FornasParticipantFile',
            'update FornasParticipantFile',
        ];
        foreach ($userPermissions as $permission) {
            Permission::firstOrCreate([
                'name'       => $permission,
                'guard_name' => 'web'
            ]);
        }

        // set permissions for role
        $RoleSuperAdmin->syncPermissions($permissions);
        $RoleAdmin->syncPermissions($permissions);
        $RoleUser->syncPermissions($userPermissions);

        // set role for users
        $roles = [
            'superadmin' => 'Super Admin',
            'admin'      => 'admin',
            'user'       => 'user',
        ];
        foreach ($roles as $username => $role) {
            $user = User::where('username', $username)->first();
            if ($user) {
                $user->assignRole($role);
            }
        }
    }
}
