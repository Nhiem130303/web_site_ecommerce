<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Attribute;
use App\Repositories\BaseRepository;

class AttributeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'code',
        'name'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Attribute::class;
    }
}
