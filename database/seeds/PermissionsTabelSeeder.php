<?php

use Illuminate\Database\Seeder;

class PermissionsTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'Total access',
            'guard_name' => 'web',
        ]);

        DB::table('permissions')->insert([
            'name' => 'Create Shop',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Shop',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Shop',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'prof',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'medecin',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Member',
            'guard_name' => 'web',
        ]);
    }
}
