<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            [
                'name' => 'administrador',
                'email' => 'administrador@sales.cl',
                'password' => bcrypt('password'),
                'role_as' => 1,
            ],
            [
                'name' => 'normal',
                'email' => 'normal@sales.cl',
                'password' => bcrypt('password'),
                'role_as' => 0,
            ],
        ]);
      
    }
}
