<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IngredientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredientes')->insert([
            [
                'name' => 'sal',
                'cantidad' => 2000,
            ],
            [
                'name' => 'ajo',
                'cantidad' => 2000,
            ],
            [
                'name' => 'merken',
                'cantidad' => 2000,
            ],
            [
                'name' => 'romero',
                'cantidad' => 2000,
            ],
            [
                'name' => 'sal de mar',
                'cantidad' => 2000,
            ],
            [
                'name' => 'limon',
                'cantidad' => 2000,
            ],
        ]);  
    }
}
