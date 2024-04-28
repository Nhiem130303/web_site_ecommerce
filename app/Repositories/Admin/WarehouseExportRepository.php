<?php

namespace App\Repositories\Admin;

use App\Models\Admin\WarehouseExport;
use App\Repositories\BaseRepository;

class WarehouseExportRepository extends BaseRepository
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
        return WarehouseExport::class;
    }
}
