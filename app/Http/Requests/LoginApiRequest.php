<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class LoginApiRequest extends FormRequest
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
            'username'=>'required',
            'password'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'username.required'=>'Vui lòng nhập tên tài khoản!',
            'password.required'=>'Vui lòng nhập mật khẩu!'
        ];
    }

    public function failedValidation (Validator $validator) {

        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'      => $validator->errors()->first(),

        ], 422));

    }
}
