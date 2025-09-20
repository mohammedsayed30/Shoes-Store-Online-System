<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'payment_method',
        'shipping_address',
    ];
    //hidden fields
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    //each order belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //each order has many items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
