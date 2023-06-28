<?php

namespace App\Http\Requests\Producttype;

use Illuminate\Foundation\Http\FormRequest;

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
            'supplier_id' => [
                'bail',
                'required',
            ],
            'name_producttype' => [
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
        ];
    }
    public function attributes()
    {
        return[
            'name_producttype'=>'Name Producttype',
        ];
    }
}
