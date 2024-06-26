<?php

namespace App\Models\Admin;

use App\Models\Admin\AttributeValue;
use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ProductAttributeValue
 * @package App\Models
 * @version December 28, 2020, 2:26 am UTC
 *
 * @property integer $product_id
 * @property integer $product_variant_id
 * @property integer $attribute_value_id
 * @property integer $product_image_id
 */
class ProductAttributeValue extends Model
{

    use HasFactory;

    public $table = 'product_attribute_values';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'id',
        'product_id',
        'product_variant_id',
        'attribute_value_id',
        'product_image_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'product_variant_id' => 'integer',
        'attribute_value_id' => 'integer',
        'product_image_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required|integer',
        'product_variant_id' => 'integer',
        'attribute_value_id' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function variant()
    {
        return $this->hasOne(ProductVariant::class, "id", "product_variant_id");
    }

    public function attributeValue()
    {
        return $this->hasOne(AttributeValue::class, "id", "attribute_value_id");
    }
}
