<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    public $table = 'attribute_values';

    public $fillable = [
        'attribute_id',
        'value'
    ];

    protected $casts = [
        'value' => 'string'
    ];

    public static $rules = [
        'attribute_id' => 'required',
        'value' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
