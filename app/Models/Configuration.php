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
    ];
}
