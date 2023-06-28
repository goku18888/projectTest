<?php

namespace App\Http\Requests\Supplier;

use App\Models\suppliers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
        return [
            'name_supplier' => [
                'bail',
                'required',
                'string',
            ],
            'email' => [
                'bail',
                'required',
                'email',
                // Rule::unique(suppliers::class)->ignore($this->suppliers),
            ],
            'phone' => [
                'bail',
                'required',
                'integer',
            ],
        ];
    }
    public function messages()
    {
        return [
                'required' => ':attribute cant leave this field empty',
                'string' => ':attribute phải là chữ số',
        ];
    }
    public function attributes()
    {
        return[
            'name_supplier'=>'Name Supplier',
        ];
    }
}
