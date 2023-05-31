<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoNutricional extends Model
{
    use HasFactory;

    protected $table = 'info_nutricionales';
    protected $fillable = [
        'id_producto',
        'valor_energetico',
        'grasa_saturada',
        'grasa_total',
        'sal',
        'yodo',
        'azucar',
        'proteina',

    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_producto', 'id');
    }
}