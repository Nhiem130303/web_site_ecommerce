<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'id',
        'name',
        'slug',
        'plv1',
        'plv2',
        'plv3',
        'max_price',
        'sku',
        'inventory_status',
        'short_desc',
        'category_id',
        'status',
        'img_is_default'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Product::class;
    }
}
