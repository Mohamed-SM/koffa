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

        DB::table('model_has_roles')->insert([
            'role_id' => '1',
            'model_id' => '1',
            'model_type' => 'App\User',
        ]);
    }
}
