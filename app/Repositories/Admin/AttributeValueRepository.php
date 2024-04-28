<?php

namespace App\Repositories\Admin;

use App\Models\Admin\AttributeValue;
use App\Repositories\BaseRepository;

class AttributeValueRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'attribute_id',
        'value'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return AttributeValue::class;
    }
}
