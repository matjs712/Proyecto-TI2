<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $table = 'configurations';
    protected $fillable = [
        'productos',
        'ingredientes',
        'categorias',
        'proveedores',
        'registros',
        'ordenes',
        'usuarios',
        'roles_permisos',
        'color_principal',
        'color_secundario',
        'color_barra_lateral',
        'color_fondo_admin',
        'color_barra_horizontal',
        'color_a_tag_sidebar',
        'color_a_tag_hover',
        'color_barra_busqueda',
        'texto_banner_uno',
        'texto_banner_dos',
        'texto_banner_tres',
        'texto_banner_cuatro',
        'boton_principal_busqueda',
        'boton_calificacion',
        'boton_review',
        'boton_lista',
        'boton_carrito',
        'boton_nuevo',
        'boton_editar',
        'boton_eliminar',
        'boton_vermas',
        'boton_actualizar',
        'banner'
    ];
}
