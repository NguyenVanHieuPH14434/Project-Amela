<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $validateImage = ['required', 'image', 'mimes:png,jpeg', 'max:5120'];
        $uniqueProductName = Rule::unique('products', 'product_name');
        if($req->method() == 'PUT'){
            $uniqueProductName = Rule::unique('products', 'product_name')->ignore($req->id);
            $validateImage = ['image', 'mimes:jpg,png,jpeg', 'max:5120'];
        }
        return [
            'product_name'=>['required', $uniqueProductName],
            'product_image'=>$validateImage,
            'image.*'=>['image', 'mimes:jpg,png,jpeg', 'max:5120'],
          
            'product_short_desc'=>['required'],
            'product_desc'=>['required'],
            'category_id'=>['required']
        ];
    }

    public function messages()
    {
        return[
            'product_name.required'=> 'Vui lòng nhập tên sản phẩm',
            'product_name.unique'=> 'Tên sản phẩm đã tồn tại',
            'product_image.required'=> 'Vui lòng chọn ảnh',
            'product_image.image'=> 'File không phải ảnh',
            'product_image.mimes'=> 'Ảnh là dạng .png, .jpg, .jpeg',
            'product_image.max'=> 'Hình ảnh sản phẩm tối đa là 5MB.',
            'image.*.image'=> 'File không phải ảnh',
            'image.*.mimes'=> 'Hình ảnh sản phẩm phải là dạng .png, .jpg, .jpeg.',
            'image.*.max'=> 'Hình ảnh sản phẩm tối đa là 5MB.',
          
            'product_short_desc.required'=> 'Vui lòng nhập mô tả ngắn sản phẩm',
            'product_desc.required'=> 'Vui lòng nhập mô tả sản phẩm',
            'category_id.required'=> 'Vui lòng danh mục sản phẩm',
        ];
    }
}
