<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Banner;
use App\Repositories\BaseRepository;

class BannerRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title',
        'slug',
        'position',
        'status',
        'file_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Banner::class;
    }
}
