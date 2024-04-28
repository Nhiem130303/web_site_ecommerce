<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Location;
use App\Repositories\BaseRepository;

class LocationRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Location::class;
    }
}
