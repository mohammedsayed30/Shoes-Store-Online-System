<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductVariants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'sku',
        'price',
        'category_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function variants()
    {
        return $this->hasMany(ProductVariants::class);
    }
    public function orders()
    {
        return $this->hasMany(Order_Item::class);
    }
}
