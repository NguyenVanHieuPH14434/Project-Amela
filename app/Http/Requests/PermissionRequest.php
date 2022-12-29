<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
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
            $ruleNameUnique = Rule::unique('permissions', 'pms_name');

            if($req->method() == 'PUT'){
                $ruleNameUnique = Rule::unique('permissions', 'pms_name')->ignore($req->id);
            }
        return [
            'module'=>['required', $ruleNameUnique],
            'action'=>['required', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'module.required'=> 'Vui lòng chọn mô-đun',
            'module.unique'=> 'Mô-đun đã tồn tại',
            'action.required'=>'Vui lòng chọn quyền cho mô-đun',
            'action.min'=>'Vui lòng chọn tối thiểu :min quyền cho mô-đun',
        ];
    }
}
