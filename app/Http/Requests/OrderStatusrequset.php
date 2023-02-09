<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderStatusrequset extends FormRequest
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
        $uniqueStatusName = Rule::unique('order_status', 'status_name');
        if($req->method() == 'PUT'){
            $uniqueStatusName = Rule::unique('order_status', 'status_name')->ignore($req->id);
        }
        return [
            'status_name'=>['required', $uniqueStatusName, 'min:5', 'max:50']
        ];
    }

    public function messages()
    {
        return [
            'status_name.required'=>'Vui lòng nhập tên trạng thái!',
            'status_name.min'=>'Tên trạng thái tối thiểu :min ký tự!',
            'status_name.max'=>'Tên trạng thái tối đa :max ký tự!',
            'status_name.unique'=>'Tên trạng thái đã tồn tại!',
        ];
    }
}
