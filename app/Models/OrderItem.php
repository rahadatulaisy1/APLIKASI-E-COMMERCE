<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class OrderItem extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'order_items';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',      
        'order_id',
        'product_id',
        'quantity',
        'price',
        
    ];

    protected $hidden = ['password'];

}