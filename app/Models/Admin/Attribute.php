<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
class Attribute extends Model
{
    public $table = 'attributes';

    public $fillable = [
        'code',
        'name'
    ];

    protected $casts = [
        'code' => 'string',
        'name' => 'string'
    ];

    public static $rules = [
        'name' => 'required|string|max:255'
    ];

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id', 'id');
    }
}
