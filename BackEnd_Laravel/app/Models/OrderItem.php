<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_variant_id',
        'product_name',
        'quantity',
        'price',
    ];
    //hidden fields
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    //each order item belongs to an order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
}
