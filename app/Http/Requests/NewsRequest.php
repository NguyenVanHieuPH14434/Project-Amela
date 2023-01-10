<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NewsRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $uniqueNewTitle = Rule::unique('news', 'new_title');
        if($request->method() == 'PUT'){
            $uniqueNewTitle = Rule::unique('news', 'new_title')->ignore($request->id);
        }
        return [
            'new_title'=>['required', 'string', $uniqueNewTitle, 'max:150'],
            'new_content'=>['required'],
            'cateNew'=>['required'],
        ];
    }

    public function messages()
    {
        return [
            'new_title.required'=> 'Vui lòng nhập tên bài viết',
            'new_title.string'=> 'Tên bài viết phải là chữ',
            'new_title.unique'=> 'Tên bài viết đã tồn tại',
            'new_title.max'=> 'Tên bài viết tối đa :max ký tự',
            'new_content.required'=>'Vui lòng nhập nội dung bài viết',
            'cateNew.required'=>'Vui lòng chọn danh mục bài viết',
        ];
    }
}
