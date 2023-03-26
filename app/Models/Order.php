<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'fname',
        'lname',
        'telefono',
        'direccion1',
        'direccion2',
        'region',
        'ciudad',
        'comuna',
        'status',
        'message',
        'tracking_number',
    ];

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}
