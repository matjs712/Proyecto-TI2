<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosIngredientes extends Seeder
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
                'id_ingrediente'=>4,
                'cantidad'=>100,
            ],
            [
                'id_proveedor' => 1,
                'id_ingrediente'=>2,
                'cantidad'=>50,
            ],
        ]);
    }
}
