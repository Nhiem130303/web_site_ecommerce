<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin\Attribute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateAttributeRequest extends FormRequest
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
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'code' => Str::slug($this->name),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Attribute::$rules;
        
        return $rules;
    }
}
