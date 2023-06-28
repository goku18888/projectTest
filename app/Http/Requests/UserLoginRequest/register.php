<?php

namespace App\Http\Requests\UserLoginRequest;

use Illuminate\Foundation\Http\FormRequest;

class register extends FormRequest
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
                    ['required', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/'],
                ],
                'pass_word' => [
                    'bail',
                    'required',
                    'string',
                ],
                'phone' => [
                    'bail',
                    'required',
                    'string',
                    ['required', 'regex:/^0\d{9}$/'],
                ],
                'address' => [
                    'bail',
                    'required',
                    'string',
                    'shipping_address' => ['required', 'regex:/^\d+\s+\S+$/'],
                ],
                'img_customer' => [
                    'bail',
                    'required',
                    'file',
                    'image',
                    'unique:App\Models\customers,img_customer',
                ],

                // 'name_customer' => 'required|string|unique:customers',
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
            'name_customer'=>'Name User',
        ];
    }
}
