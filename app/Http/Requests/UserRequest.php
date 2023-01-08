<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            $uniqueUsername = Rule::unique('users', 'username');
            $uniqueEmail = Rule::unique('profiles', 'email');
        if($req->method() == 'PUT'){
            $uniqueUsername = Rule::unique('users', 'username')->ignore($req->id);
            $uniqueEmail = Rule::unique('profiles', 'email')->ignore($req->profile_id);
            // $uniquePhone = Rule::unique('profiles', 'phone')->ignore($req->profile_id);
        }
        return [
                'username'=>['required', $uniqueUsername, 'min:5'],
                'password'=>['required', 'min:8', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'],
                'full_name'=>['required'],
                'role'=>['required'],
                'phone'=>['required', 'min:10', 'max:11', "regex:/^(84|0[2|3|5|7|8|9])+([0-9]{8,9})$\b/"],
                'email'=>['required', 'email', 'regex:/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}/', $uniqueEmail],
        ];
    }



    // public function failedValidation(Validator $validator)

    // {

    //     throw new HttpResponseException(response()->json([

    //         'success'   => false,

    //         'message'   => 'Xác thực lỗi!',

    //         'data'      => $validator->errors()

    //     ], 400));

    // }

    public function messages()
    {
       return [
        'username.required'=> 'Vui lòng nhập tên đăng nhập',
        'username.unique'=> 'Tên đăng nhập đã tồn tại',
        'username.min'=> 'Tên đăng nhập tối thiểu :min ký tự',
        'password.required'=> 'Vui lòng nhập mật khẩu',
        'password.min'=> 'Mật khẩu tối thiểu :min ký tự',
        'password.regex'=> 'Mật khẩu :regex',
        'full_name.required'=> 'Vui lòng nhập họ và tên',
        'phone.required'=> 'Vui lòng nhập số điện thoại',
        'role.required'=> 'Vui lòng chọn vai trò',
        'phone.min'=> 'Số điện thoại tối thiểu :min số',
        'phone.max'=> 'Số điện thoại tối đa :max số',
        'phone.regex'=> 'Số điện thoại không đúng định dạng',
        'email.required'=> 'Vui lòng nhập email',
        'email.email'=> 'Email không đúng định dạng',
        'email.regex'=> 'Email không đúng định dạng',
        'email.unique'=> 'Email này đã tồn tại',
       ];
    }
}
