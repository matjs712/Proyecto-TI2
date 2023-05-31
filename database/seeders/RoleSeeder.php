<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $nutricionista = Role::create(['name' => 'nutricionista']);
        $chef = Role::create(['name' => 'chef']);
        $usuario = Role::create(['name' => 'usuario']);

        Permission::create([
            'name' => 'ver dashboard',
            'description' => 'Ver dashboard'
        ])->syncRoles([$admin, $nutricionista, $chef]);
        Permission::create([
            'name' => 'ver roles',
            'description' => 'Ver roles'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'add roles',
            'description' => 'Añadir rol'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'edit roles',
            'description' => 'Editar rol'
        ])->syncRoles([$admin]);

        Permission::create([
            'name' => 'ver productos',
            'description' => 'Ver productos'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'add productos',
            'description' => 'Añadir producto'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'edit productos',
            'description' => 'Editar producto'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'destroy productos',
            'description' => 'Eliminar producto'
        ])->syncRoles([$admin]);

        Permission::create([
            'name' => 'ver recetas',
            'description' => 'Ver receta'
        ])->syncRoles([$admin, $chef]);
        Permission::create([
            'name' => 'add recetas',
            'description' => 'Añadir receta'
        ])->syncRoles([$admin, $chef]);
        Permission::create([
            'name' => 'edit recetas',
            'description' => 'Editar receta'
        ])->syncRoles([$admin, $chef]);
        Permission::create([
            'name' => 'destroy recetas',
            'description' => 'Eliminar receta'
        ])->syncRoles([$admin, $chef]);


        Permission::create([
            'name' => 'ver categorias',
            'description' => 'Ver categorías'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'add categorias',
            'description' => 'Añadir categorías'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'edit categorias',
            'description' => 'Editar categorías'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'destroy categorias',
            'description' => 'Eliminar categorías'
        ])->syncRoles([$admin]);

        Permission::create([
            'name' => 'ver ingredientes',
            'description' => 'Ver ingredientes'
        ])->syncRoles([$admin, $chef]);
        Permission::create([
            'name' => 'add ingredientes',
            'description' => 'Añadir ingredientes'
        ])->syncRoles([$admin, $chef]);
        Permission::create([
            'name' => 'edit ingredientes',
            'description' => 'Editar ingredientes'
        ])->syncRoles([$admin, $chef]);
        Permission::create([
            'name' => 'destroy ingredientes',
            'description' => 'Eliminar ingredientes'
        ])->syncRoles([$admin]);

        Permission::create([
            'name' => 'ver proveedores',
            'description' => 'Ver proveedores'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'add proveedores',
            'description' => 'Añadir proveedores'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'edit proveedores',
            'description' => 'Editar proveedores'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'destroy proveedores',
            'description' => 'Eliminar proveedores'
        ])->syncRoles([$admin]);

        Permission::create([
            'name' => 'ver registros',
            'description' => 'Ver registros'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'add registros',
            'description' => 'Añadir registros'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'edit registros',
            'description' => 'Editar registros'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'destroy registros',
            'description' => 'Eliminar registros'
        ])->syncRoles([$admin]);

        Permission::create([
            'name' => 'ver ordenes',
            'description' => 'Ver ordenes'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'add ordenes',
            'description' => 'Añadir ordenes'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'edit ordenes',
            'description' => 'Editar ordenes'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'destroy ordenes',
            'description' => 'Eliminar ordenes'
        ])->syncRoles([$admin]);

        Permission::create([
            'name' => 'ver usuarios',
            'description' => 'Ver usuarios'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'ver info usuarios',
            'description' => 'Ver info usuarios'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'add usuarios',
            'description' => 'Añadir usuarios'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'edit usuarios',
            'description' => 'Editar usuarios'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'destroy usuarios',
            'description' => 'Eliminar usuarios'
        ])->syncRoles([$admin]);

        Permission::create([
            'name' => 'ver configuracion',
            'description' => 'Ver configuración'
        ])->syncRoles([$admin]);
        Permission::create([
            'name' => 'ver perfil',
            'description' => 'Ver perfil'
        ])->syncRoles([$chef, $nutricionista]);

        Permission::create([
            'name' => 'ver notificaciones',
            'description' => 'Ver notificaciones'
        ])->syncRoles([$admin, $nutricionista, $chef]);
    }
}