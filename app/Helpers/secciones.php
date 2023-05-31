<?php

use App\Models\Configuration;

function secciones()
{
    $productos = false;
    $ingredientes = false;
    $categorias = false;
    $proveedores = false;
    $recetas = false;
    $registros = false;
    $ordenes = false;
    $usuarios = false;
    $roles_permisos = false;
    $productosFront = false;
    $ingredientesFront = false;
    $categoriasFront = false;
    $proveedoresFront = false;
    $recetasFront = false;
    $registrosFront = false;
    $ordenesFront = false;
    $usuariosFront = false;
    $roles_permisosFront = false;

    $configurations = Configuration::first();

    if ($configurations->productos == 1) {
        $productos = true;
        $productosFront = true;
    }
    if ($configurations->ingredientes == 1) {
        $ingredientes = true;
        $ingredientesFront = true;
    }
    if ($configurations->recetas == 1) {
        $recetas = true;
        $recetasFront = true;
    }
    if ($configurations->categorias == 1) {
        $categorias = true;
        $categoriasFront = true;
    }
    if ($configurations->proveedores == 1) {
        $proveedores = true;
        $proveedoresFront = true;
    }

    if ($configurations->registros == 1) {
        $registros = true;
        $registrosFront = true;
    }
    if ($configurations->ordenes == 1) {
        $ordenes = true;
        $ordenesFront = true;
    }
    if ($configurations->usuarios == 1) {
        $usuarios = true;
        $usuariosFront = true;
    }
    if ($configurations->roles_permisos == 1) {
        $roles_permisos = true;
        $roles_permisosFront = true;
    }

    view()->share([
        'productos' => $productos,
        'ingredientes' => $ingredientes,
        'categorias' => $categorias,
        'proveedores' => $proveedores,
        'recetas' => $recetas,
        'registros' => $registros,
        'ordenes' => $ordenes,
        'usuarios' => $usuarios,
        'roles_permisos' => $roles_permisos,
        'productosFront' => $productosFront,
        'ingredientesFront' => $ingredientesFront,
        'categoriasFront' => $categoriasFront,
        'proveedoresFront' => $proveedoresFront,
        'recetasFront' => $recetasFront,
        'registrosFront' => $registrosFront,
        'ordenesFront' => $ordenesFront,
        'usuariosFront' => $usuariosFront,
        'roles_permisosFront' => $roles_permisosFront,
    ]);
}