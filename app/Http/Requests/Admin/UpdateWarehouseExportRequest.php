<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin\WarehouseExport;
use Illuminate\Foundation\Http\FormRequest;

class UpdateWarehouseExportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = WarehouseExport::$rules;
        
        return $rules;
    }
}
