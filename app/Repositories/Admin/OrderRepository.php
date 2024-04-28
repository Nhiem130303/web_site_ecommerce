<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Order;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository
{
    protected $fieldSearchable = [
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

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Order::class;
    }
}
