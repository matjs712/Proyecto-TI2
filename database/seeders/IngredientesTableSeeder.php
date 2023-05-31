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
                'name' => 'Sal',
                'medida' => 'gramos',
                'cantidad' => 10000,
            ],
            [
                'name' => 'Merquen',
                'medida' => 'gramos',
                'cantidad' => 21500,
            ],
            [
                'name' => 'Tomate seco',
                'medida' => 'gramos',
                'cantidad' => 30000,
            ],
            [
                'name' => 'Ajo',
                'medida' => 'gramos',
                'cantidad' => 10500,
            ],
        ]);
    }
}
