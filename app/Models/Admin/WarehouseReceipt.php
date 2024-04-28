<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WarehouseReceipt
 * @package App\Models\Admin
 *
 * @property integer product_id
 * @property integer product_variant_id
 * @property integer location_id
 * @property integer quantity
 * @property integer created_by_id
 */
class WarehouseReceipt extends Model
{
    public $table = 'warehouse_receipt';

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

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Admin\Product::class, 'product_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
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
}
