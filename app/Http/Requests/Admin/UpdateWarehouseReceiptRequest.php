<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin\WarehouseReceipt;
use Illuminate\Foundation\Http\FormRequest;

class UpdateWarehouseReceiptRequest extends FormRequest
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
        $rules = WarehouseReceipt::$rules;
        
        return $rules;
    }
}
