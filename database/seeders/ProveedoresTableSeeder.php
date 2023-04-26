<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proveedors')->insert([
            [
                'name' => 'John Doe',
                'telefono' => '923123212',
                'email'=>'john@doe.cl',
            ],
            [
                'name' => 'Don omar',
                'telefono' => '998323256',
                'email'=>'don@omar.cl',
            ],
        ]);
    }
}
