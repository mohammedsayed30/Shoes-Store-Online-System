<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ProductVariation extends Model
{
    use HasFactory;
    protected $table = 'productvariations';
    
    // Disable auto-incrementing ID since you're using composite keys
    public $incrementing = false;
    
    // Specify that there's no single primary key column
    protected $primaryKey = null;
    
    // List all parts of your composite key
    protected $uniqueFor = ['product_id', 'size', 'color'];

    protected $fillable = [
        'product_id',
        'size',
        'color',
        'stock',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
