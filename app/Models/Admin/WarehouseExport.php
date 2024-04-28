<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class WarehouseExport extends Model
{
    public $table = 'warehouse_export';

    public $fillable = [
        'product_id',
        'product_variant_id',
        'location_id',
        'quantity',
        'created_by_id'
    ];

    protected $casts = [
        
    ];

    public static $rules = [
        'product_variant_id' => 'required',
        'location_id' => 'required',
        'quantity' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function createdBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by_id');
    }

    public function productVariant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Admin\ProductVariant::class, 'product_variant_id');
    }

    public function location(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Admin\Location::class, 'location_id');
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Admin\Product::class, 'product_id');
    }
}
