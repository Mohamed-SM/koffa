<?php

use Illuminate\Database\Seeder;

class RolesTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'Owner',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'Medecin',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'Prof',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'Member',
            'guard_name' => 'web',
        ]);

        DB::table('role_has_permissions')->insert([
            'permission_id' => '1',
            'role_id' => '1',
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => '2',
            'role_id' => '2',
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => '3',
            'role_id' => '2',
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => '4',
            'role_id' => '2',
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => '5',
            'role_id' => '3',
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => '6',
            'role_id' => '4',
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => '7',
            'role_id' => '5',
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => '1',
            'model_id' => '1',
            'model_type' => 'App\User',
        ]);

    }
}
