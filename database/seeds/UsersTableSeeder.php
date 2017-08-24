<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Mohamed',
            'last_name' => 'Slimani',
            'email' => 'admin@koffa.com',
            'password' => bcrypt('adminadmin'),
            'phone' => '06 66 66 66 66'
        ]);
    }
}
