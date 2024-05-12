<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'username' => 'required|string|unique:users|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:6',
            're_password' => 'required|string|same:password',
            'user_role' => 'required|integer|gt:-1',
        ];
    }

    public function messages()
    {
        return [
            // username
            'username.required' => "Bạn chưa nhập tên người dùng",
            'username.string' => "Tên người dùng phải là ký tự",
            'username.unique' => "Tên người dùng đã tồn tại, vui lòng đặt tên khác",

            // email
            'email.required' => "Bạn chưa nhập email",
            'email.string' => "Email phải là dạng chuỗi ký tự",
            'email.email' => "Email không đúng định dạng, Ex : abc@gmail.com",
            'email.unique' => "Email đã tồn tại, vui lòng chọn email khác",
            'email.max' => "Độ dài email tối đa 255 ký tự",

            // password
            'password.required' => "Bạn chưa nhập mật khẩu",
            'password.string' => "Password phải là dạng chuỗi ký tự",
            'password.min' => "Độ dài email tối thiểu 6 ký tự",

            //re_password
            're_password.required' => "Bạn chưa nhập lại mật khẩu",
            're_password.string' => "Mật khẩu nhập lại phải là dạng chuỗi ký tự",
            're_password.same' => "Mật khẩu Confirm không khớp với Mật Khẩu",

            // user_role
            'user_role.required' => "Vui lòng chọn nhóm thành viên",

        ];
    }
}
