<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
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
                'username'=>['required', 'unique:users', 'min:5'],
                'password'=>['required', 'min:8', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'],
                'confirm'=>['required', 'same:password'],
                'full_name'=>['required'],
                'phone'=>['required', 'min:10', 'max:11', "regex:/^(84|0[2|3|5|7|8|9])+([0-9]{8,9})$\b/"],
                'email'=>['required', 'email', 'regex:/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}/', 'unique:profiles'],
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
        'confirm.required'=> 'Vui lòng xác nhận mật khẩu',
        'confirm.same'=> 'Xác nhận mật khẩu không chính xác',
        'full_name.required'=> 'Vui lòng nhập họ và tên',
        'phone.required'=> 'Vui lòng nhập số điện thoại',
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
