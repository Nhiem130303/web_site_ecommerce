<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public $table = 'banners';

    public $fillable = [
        'title',
        'slug',
        'position',
        'status',
        'file_id'
    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'status' => 'boolean'
    ];

    public static $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'status' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
