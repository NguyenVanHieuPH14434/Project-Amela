<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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
            'parent_attr_name'=>['required'],
        ];
    }

    public function messages()
    {
        return [
            'parent_attr_name.required'=>'Vui lòng nhập tên thuộc tính'
        ];
    }
}
