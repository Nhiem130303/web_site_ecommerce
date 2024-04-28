<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public $table = 'locations';

    public $fillable = [
        'name'
    ];

    protected $casts = [
        'name' => 'string'
    ];

    public static $rules = [
        'name' => 'required|string|max:250',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function warehouseExports(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Admin\WarehouseExport::class, 'location_id');
    }

    public function warehouseReceipts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Admin\WarehouseReceipt::class, 'location_id');
    }
}
