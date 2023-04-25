<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = [
        'user_id',
        'product_id',
        'user_review'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    } 
     
    public function products(){
        return $this->belongsTo(Product::class, 'product_id','id');
    } 
}
