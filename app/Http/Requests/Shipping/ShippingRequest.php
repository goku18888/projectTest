<?php

namespace App\Http\Requests\Shipping;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
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
            'shipping_name' => [
                'bail',
                'required',
                'string',
                'unique:App\Models\shipping,shipping_name',
            ],
            'shipping_address' => [
                'bail',
                'required',
                'integer',
            ],
            'shhipping_phone' => [
                'bail',
                'required',
                'integer',
            ],
            'shhipping_email' => [
                'bail',
                'required',
                'integer',
            ],
            'shhipping_note' => [
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
            'name_product'=>'Name Product',
        ];
    }
}
