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
            'name' => 'administrador',
            'imagen' => Storage::url('images/admin/perfil.jpg'),
            'email' => 'administrador@sales.cl',
            'password' => bcrypt('password'),
            'role_as' => 1,
        ])->assignRole('admin');
        User::create([
            'name' => 'nutricionista',
            'email' => 'nutricionista@sales.cl',
            'password' => bcrypt('password'),
            'role_as' => 2,
        ])->assignRole('nutricionista');
        User::create([
            'name' => 'chef',
            'email' => 'chef@sales.cl',
            'password' => bcrypt('password'),
            'role_as' => 3,
        ])->assignRole('chef');
        User::create([
            'name' => 'normal',
            'email' => 'normal@sales.cl',
            'password' => bcrypt('password'),
            'role_as' => 0,
        ]);
      
    }
}
