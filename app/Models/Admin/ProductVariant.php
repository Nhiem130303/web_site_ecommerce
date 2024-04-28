<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    public $table = 'product_variants';

    public $fillable = [
        'product_id',
        'name',
        'slug',
        'plv_1',
        'plv_2',
        'plv_3'
    ];

    protected $casts = [
        'name' => 'string',
        'slug' => 'string'
    ];

    public static $rules = [
        'product_id' => 'required',
        'name' => 'required|string|max:250',
        'slug' => 'required|string|max:250',
        'plv_1' => 'required',
        'plv_2' => 'required',
        'plv_3' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productAttributeValue()
    {
        return $this->hasMany(ProductAttributeValue::class, "product_variant_id", "id");
    }
}
