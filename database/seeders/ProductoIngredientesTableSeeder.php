<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductoIngredientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('producto_ingredientes')->insert([
            [
                'id_producto' => 1,
                'id_ingrediente' => 1,
                'cantidad' => 100
            ],
            [
                'id_producto' => 1,
                'id_ingrediente' => 2,
                'cantidad' => 100
            ],
            [
                'id_producto' => 2,
                'id_ingrediente' => 1,
                'cantidad' => 100
            ],
            [
                'id_producto' => 2,
                'id_ingrediente' => 3,
                'cantidad' => 100 
            ],
            [
                'id_producto' => 3,
                'id_ingrediente' => 5,
                'cantidad' => 100
            ],
            [
                'id_producto' => 4,
                'id_ingrediente' => 1,
                'cantidad' => 100
            ],
            [
                'id_producto' => 4,
                'id_ingrediente' => 6,
                'cantidad' => 100
            ],
            [
                'id_producto' => 5,
                'id_ingrediente' => 1,
                'cantidad' => 100
            ],
            [
                'id_producto' => 5,
                'id_ingrediente' => 4,
                'cantidad' => 100
            ],
        ]);        
    }
}
