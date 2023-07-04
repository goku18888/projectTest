<?php

namespace App\Http\Requests\UserLoginRequest;

use Illuminate\Foundation\Http\FormRequest;

class login extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_customer' => [
                'bail',
                'required',
                'string',
                'unique:App\Models\customers,name_customer',
            ],
            'email' => [
                'bail',
                'required',
                'string',
            ],
            'pass_word' => [
                'bail',
                'required',
                'string',
            ],
            'phone' => [
                'bail',
                'required',
                'integer',
            ],
            'address' => [
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
                'string' => ':attribute phải là chữ số,không có kí tự đặc biệt',
        ];
    }
    public function attributes()
    {
        return[
            'name_customer'=>'Name Customer',
        ];
    }
}
