<?php

use Illuminate\Database\Seeder;

class CategoriesTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'title' => 'alimentation',
        ]);
        
        DB::table('categories')->insert([
            'title' => 'bibliotheque',
        ]);
    }
}
