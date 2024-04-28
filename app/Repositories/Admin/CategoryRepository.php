<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'slug',
        'parent_id',
        'file_id',
        'position',
        'status'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Category::class;
    }
}
