<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class LogosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logos')->insert([
            [
                'logo' => 'logo-pagina.png',
                'sitio' => 'De Sabelle',
            ],
        ]);
    }
}
