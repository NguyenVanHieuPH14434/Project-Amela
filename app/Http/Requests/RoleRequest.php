<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
        $uniqueRoleName = Rule::unique('roles', 'role_name');
        if($req->method() == 'PUT'){
            $uniqueRoleName = Rule::unique('roles', 'role_name')->ignore($req->id);
        }
        return [
            'role_name'=>['required', $uniqueRoleName],
            'permission_id'=>['required']
        ];
    }

    public function messages()
    {
        return [
            'role_name.required'=> 'Vui lòng nhập tên vai trò',
            'role_name.unique'=> 'Vai trò đã tồn tại',
            'permission_id.required'=> 'Vui lòng chọn quyền cho vai trò'
        ];
    }
}
