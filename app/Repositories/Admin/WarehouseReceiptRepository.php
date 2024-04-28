<?php

namespace App\Repositories\Admin;

use App\Models\Admin\WarehouseReceipt;
use App\Repositories\BaseRepository;

class WarehouseReceiptRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'product_id',
        'product_variant_id',
        'location_id',
        'quantity',
        'created_by_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return WarehouseReceipt::class;
    }
}
