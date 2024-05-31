<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            // 'emailOrUsername' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => "Bạn chưa nhập email hoặc tên người dùng",
            // 'emailOrUsername.required' => "Bạn chưa nhập email hoặc tên người dùng",
            'email.email' => "Định dạng Email không đúng, Ví dụ : abc@gmail.com",
            'password.required' => "Bạn chưa nhập mật khẩu"
        ];
    }
}
