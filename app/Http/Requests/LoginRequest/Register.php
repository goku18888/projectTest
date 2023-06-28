<?php

namespace App\Http\Requests\LoginRequest;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_admin' => [
                'bail',
                'required',
                'string',
                'unique:App\Models\admins,name_admin',
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
                'min:4',
            ],
            'phone' => [
                'bail',
                'required',
                'string',
            ],
            'address' => [
                'bail',
                'required',
                'string',
            ],
            'avatar' => [
                'bail',
                'required',
                'file',
                'image',
                'unique:App\Models\admins,avatar',
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
            'name_admin'=>'Name Admin',
        ];
    }
}
