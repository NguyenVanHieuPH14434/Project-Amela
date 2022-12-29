<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
}
