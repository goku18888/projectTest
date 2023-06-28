<?php

namespace App\Http\Requests\Products;

use App\Models\products;
use App\Models\producttypes;
use App\Models\suppliers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name_product' => [
                'bail',
                'required',
                'string',
                'unique:App\Models\products,name_product',
            ],
            'old_price' => [
                'bail',
                'required',
                'integer',
            ],
            'price_product' => [
                'bail',
                'required',
                'integer',
            ],
            'amount' => [
                'bail',
                'required',
                'integer',
            ],
            'depscribe' => [
                'bail',
                'required',
                'string',
            ],
            'img_product' => [
                'bail',
                'required',
                'file',
                'image',
                'unique:App\Models\products,img_product',
            ],
            'supplier_id' => [
                'bail',
                Rule::exists(suppliers::class,'id'),
            ],
            'producttype_id'=>[
                'bail',
                Rule::exists(producttypes::class,'id'),
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
