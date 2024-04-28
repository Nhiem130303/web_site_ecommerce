<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'categories';

    public $fillable = [
        'name',
        'slug',
        'parent_id',
        'file_id',
        'position',
        'status'
    ];

    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
        'status' => 'boolean'
    ];

    public static $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'parent_id' => 'required',
        'status' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
//
//    public function file(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo(\App\Models\Admin\File::class, 'file_id');
//    }

    public function categoryChildrent()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
