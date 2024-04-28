<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ProductInventory extends Model
{
    public $table = 'product_inventories';

    public $fillable = [
        'product_id',
        'product_variant_id',
        'location_id',
        'quantity'
    ];

    protected $casts = [
        
    ];

    public static $rules = [
        'product_id' => 'required',
        'product_variant_id' => 'required',
        'location_id' => 'required',
        'quantity' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function productVariant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Admin\ProductVariant::class, 'product_variant_id');
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Admin\Product::class, 'product_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
