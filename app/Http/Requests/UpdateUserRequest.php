<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('id');
        return [
            'username' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($userId)]
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Vui lòng nhập tên của bạn.',
            'username.string' => 'Tên phải ở dạng chuỗi ký tự',
            'username.max' => 'Tên không được vượt quá 255 ký tự.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Địa chỉ email đã tồn tại.',
            // Thêm các thông báo lỗi khác tùy thuộc vào yêu cầu của bạn
        ];
    }
}
