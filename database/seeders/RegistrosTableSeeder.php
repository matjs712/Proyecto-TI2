<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegistrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('registros')->insert([
            [
                'fecha' => '2023-04-20',
                'id_proveedor' => 1,
                'id_ingrediente'=>1,
                'cantidad'=>2000,
                'medida'=>'gramos',
            ],
            [
                'fecha' => '2023-04-18',
                'id_proveedor' => 1,
                'id_ingrediente'=>2,
                'cantidad'=>2500,
                'medida'=>'gramos',
            ],
            [
                'fecha' => '2023-02-22',
                'id_proveedor' => 2,
                'id_ingrediente'=>3,
                'cantidad'=>1500,
                'medida'=>'gramos',
            ],
            [
                'fecha' => '2023-04-20',
                'id_proveedor' => 2,
                'id_ingrediente'=>4,
                'cantidad'=>1000,
                'medida'=>'gramos',
            ],
            
        ]);
    }
}
