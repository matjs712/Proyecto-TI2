<?php

use App\Models\Configuration;

function secciones()
{
    $productos = false;
    $ingredientes = false;
    $categorias = false;
    $proveedores = false;
    $registros = false;
    $ordenes = false;
    $usuarios = false;
    $roles_permisos = false;

    $configurations = Configuration::first();

    if ($configurations->productos == 1) {
        $productos = true;
    }
    if ($configurations->ingredientes == 1) {
        $ingredientes = true;
    }
    if ($configurations->categorias == 1) {
        $categorias = true;
    }
    if ($configurations->proveedores == 1) {
        $proveedores = true;
    }
    if ($configurations->registros == 1) {
        $registros = true;
    }
    if ($configurations->ordenes == 1) {
        $ordenes = true;
    }
    if ($configurations->usuarios == 1) {
        $usuarios = true;
    }
    if ($configurations->roles_permisos == 1) {
        $roles_permisos = true;
    }

    view()->share([
        'productos' => $productos,
        'ingredientes' => $ingredientes,
        'categorias' => $categorias,
        'proveedores' => $proveedores,
        'registros' => $registros,
        'ordenes' => $ordenes,
        'usuarios' => $usuarios,
        'roles_permisos' => $roles_permisos,
    ]);
}