<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin\ProductInventory;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductInventoryRequest extends FormRequest
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
        $rules = ProductInventory::$rules;
        
        return $rules;
    }
}
