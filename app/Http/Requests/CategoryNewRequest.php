<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryNewRequest extends FormRequest
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
        $uniqueNewCateName = Rule::unique('new_categories', 'new_cate_name');
        $validateImage = ['image', 'mimes:jpg,png,jpeg'];
        if($req->method() == 'PUT'){
            $uniqueNewCateName = Rule::unique('new_categories', 'new_cate_name')->ignore($req->id);
            $validateImage = ['image', 'mimes:jpg,png,jpeg'];
        }
        return [
            'new_cate_name'=>['required', 'string',  $uniqueNewCateName, 'max:100'],
            'new_cate_image'=>$validateImage
        ];
    }

    public function messages()
    {
        return [
            'new_cate_name.required'=> 'Vui lòng nhập tên danh mục bài viết',
            'new_cate_name.string'=> 'Tên danh mục bài viết phải là chữ',
            'new_cate_name.unique'=> 'Tên danh mục bài viết đã tồn tại',
            'new_cate_name.max'=> 'Tên danh mục bài viết tối đa :max ký tự',
            // 'new_cate_image.required'=> 'Vui lòng chọn ảnh',
            'new_cate_image.image'=> 'Không phải file ảnh',
            'new_cate_image.mimes'=> 'Ảnh phải là dạng .png, .jpg, .jpeg'
        ];
    }
}
