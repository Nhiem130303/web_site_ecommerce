<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = 'products';

    const INVENTORY_STATUS_IN_STOCK = 1;

    const INVENTORY_STATUS_OUT_STOCK = 0;

    public $fillable = [
        'name',
        'slug',
        'plv1',
        'plv2',
        'plv3',
        'sku',
        'inventory_status',
        'short_desc',
        'status',
        'category_id',
        'img_is_default',
    ];

    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
        'status' => 'boolean'
    ];

    public static $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:250',
        'plv1' => 'required',
        'plv2' => 'required',
        'plv3' => 'required',
        'status' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function productAttributeValue()
    {
        return $this->hasMany(ProductAttributeValue::class, "product_id", "id");
    }

    public function productInventories()
    {
        return $this->hasMany(ProductInventory::class, "product_id", "id");
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
