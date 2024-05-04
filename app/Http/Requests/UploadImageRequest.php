<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
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
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'image.required' => "Vui lòng chọn file hình ảnh",
            'image.image' => "File không phải định dạng hình ảnh",
            'image.mimes' => "Hình ảnh phải thuộc định dạng : jpeg, png, jpg hoặc gif",
            'image.max' => "Dung lượng ảnh phải bé hơn 2048Kb"
        ];
    }
}
