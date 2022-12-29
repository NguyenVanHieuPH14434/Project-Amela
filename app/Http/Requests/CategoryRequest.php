<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
    public function rules(Request $req)
    {
        $uniqueCateName = Rule::unique('categories', 'cate_name');
        if($req->method() == 'PUT'){
            $uniqueCateName = Rule::unique('categories', 'cate_name')->ignore($req->id);
        }
        return [
            'cate_name'=>['required',  $uniqueCateName]
        ];
    }

    public function messages()
    {
        return [
            'cate_name.required'=>'Vui lòng nhập tên danh mục',
            // 'cate_name.alpha'=>'Tên danh mục phải là chữ',
            'cate_name.unique'=>'Tên danh mục đã tồn tại',
        ];
    }
}
