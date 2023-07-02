<?php

namespace App\Http\Requests\Products;

use App\Models\products;
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
            'name_product' => [
                'bail',
                'required',
                'string',
            ],
            'price_product' => [
                'required',
                'string',
            ],
            'amount' => [
                'required',
                'string',
            ],
            'depscribe' => [
                'required',
                'string',
            ],
            'img_product' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'imgs_product.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'supplier_id' => [
                'bail',
                'required',
            ],
            'producttype_id'=>[
                'bail',
                'required',
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
