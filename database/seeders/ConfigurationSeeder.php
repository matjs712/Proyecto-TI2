<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->insert([
            [
                'productos' => 1,
                'ingredientes' => 1,
                'categorias' => 1,
                'proveedores' => 1,
                'registros' => 1,
                'ordenes' =>  1,
                'usuarios' => 1,
                'roles_permisos' => 1,
            ]
        ]);
    }
}
