<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
        $rules = [
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            // 'province_id' => 'required|exists:provinces,code',
            // 'district_id' => 'required|exists:districts,code',
            // 'ward_id' => 'required|exists:wards,code',
            'user_address' => 'required|string|max:255',
            'user_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'ship' => 'required',
            'payment' => 'required|in:check_payment,paypal',

        ];

        if ($this->has('acc')) {
            $rules['user_password'] = 'required|string|min:6';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'user_name.required' => 'Họ và tên là bắt buộc.',
            'user_name.string' => 'Họ và tên phải là chuỗi ký tự.',
            'user_name.max' => 'Họ và tên không được vượt quá 255 ký tự.',

            'user_password.required' => 'Mật khẩu là bắt buộc nếu bạn chọn tạo tài khoản.',
            'user_password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự.',

            'user_email.required' => 'Email là bắt buộc.',
            'user_email.email' => 'Email không đúng định dạng.',
            'user_email.max' => 'Email không được vượt quá 255 ký tự.',

            // 'province_id.required' => 'Thành phố là bắt buộc.',
            // 'province_id.exists' => 'Thành phố không tồn tại.',

            // 'district_id.required' => 'Quận/Huyện là bắt buộc.',
            // 'district_id.exists' => 'Quận/Huyện không tồn tại.',

            // 'ward_id.required' => 'Phường/Xã là bắt buộc.',
            // 'ward_id.exists' => 'Phường/Xã không tồn tại.',

            'user_address.required' => 'Địa chỉ là bắt buộc.',
            'user_address.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'user_address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',

            'user_phone.required' => 'Số điện thoại là bắt buộc.',
            'user_phone.regex' => 'Số điện thoại không đúng định dạng.',
            'user_phone.min' => 'Số điện thoại phải có ít nhất 10 ký tự.',

            'ship.required' => 'Bạn phải chọn một phương thức vận chuyển.',
            // 'ship.in' => 'Phương thức vận chuyển không hợp lệ.',

            'payment.required' => 'Phương thức thanh toán là bắt buộc.',
            'payment.in' => 'Phương thức thanh toán không hợp lệ.',
        ];
    }
}
