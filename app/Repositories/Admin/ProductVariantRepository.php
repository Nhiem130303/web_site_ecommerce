<?php

namespace App\Repositories\Admin;

use App\Models\Admin\ProductVariant;
use App\Repositories\BaseRepository;

class ProductVariantRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'id',
        'product_id',
        'name',
        'slug',
        'plv_1',
        'plv_2',
        'plv_3'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProductVariant::class;
    }
}
