<?php

namespace App\Repositories\Admin;

use App\Models\Admin\ProductInventory;
use App\Repositories\BaseRepository;

class ProductInventoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'product_id',
        'product_variant_id',
        'location_id',
        'group',
        'line'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProductInventory::class;
    }
}
