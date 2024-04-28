<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $table = 'order_items';

    public $fillable = [

    ];

    protected $casts = [

    ];

    public static $rules = [
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
}
