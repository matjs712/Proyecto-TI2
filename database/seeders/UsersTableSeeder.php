<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            // 'id' => 1,
            'name' => 'John Doe',
            'imagen' => 'admin-user.jpg',
            'email' => 'administrador@sales.cl',
            'password' => bcrypt('password'),
            'role_as' => 1,
            'imagen' => 'hasbu.jpg',
        ])->assignRole('admin');
        User::create([
            // 'id' => 2,
            'name' => 'nutricionista',
            'email' => 'nutricionista@sales.cl',
            'password' => bcrypt('password'),
            'role_as' => 2,
        ])->assignRole('nutricionista');
        User::create([
            // 'id' => 3,
            'name' => 'chef',
            'email' => 'chef@sales.cl',
            'password' => bcrypt('password'),
            'role_as' => 3,
        ])->assignRole('chef');
        User::create([
            // 'id' => 4,
            'name' => 'normal',
            'email' => 'normal@sales.cl',
            'password' => bcrypt('password'),
            'role_as' => 4,
        ])->assignRole('usuario');;
    }
}
