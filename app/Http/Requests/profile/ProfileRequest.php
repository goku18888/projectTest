<?php

namespace App\Http\Requests\profile;

use App\Models\admins;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            'name_admin' => [
                'bail',
                'required',
                'string',
                Rule::unique(admins::class)->ignore($this->admins),
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
