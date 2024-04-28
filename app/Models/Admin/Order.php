<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = 'orders';

    public $fillable = [
        "id",
        "user_id",
        "email",
        "user_first_name",
        "user_last_name",
        "phone_number",
        "city_id",
        "district_id",
        "ward_id",
        "address",
        "note",
        "amount",
        "status"
    ];

    protected $casts = [
        "amount" => "integer"
    ];

    public static $rules = [
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

}
