<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
                'unique:App\Models\suppliers,name_supplier',
            ],
            'email' => [
                'bail',
                'required',
                'email:rfc',
                'unique:App\Models\suppliers,email',
            ],
            'phone' => [
                'bail',
                'required',
                'string',
            ],
        ];
    }
    public function messages()
    {
        return [
                'required' => ':attribute cant leave this field empty',
                'string' => ':attribute phải là chữ số',
                'email' => ':attribute phải là *******@gmail.com',
        ];
    }
    public function attributes()
    {
        return[
            'name_supplier'=>'Name Supplier',
        ];
    }
}
