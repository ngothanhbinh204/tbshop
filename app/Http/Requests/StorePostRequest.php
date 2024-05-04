<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|string|min:5|max:100',
            'content' => 'required|string',
            'category_id' => 'required|integer|exists:category_posts,id',
        ];
    }

    public function messages()
    {
        return [
            // title
            'title.required' => 'Vui lòng điền tiêu đề bài viết',
            'title.min' => 'Tiều đề phải lớn hơn :min ký tự',
            'title.max' => 'Tiều đề phải bé hơn :max ký tự',
            // contet
            'content.required' => 'Please enter content for the article.',
            // 'content.min' => 'The content must be at least :min characters.',
            // 'content.max' => 'The content may not be greater than :max characters.',
            // category_id
            'category_id.required' => 'Vui lòng chọn chủ đề của bài viết.',
            'category_id.integer' => 'Chủ đề phải dạng integer',
            'category_id.exists' => 'Chủ đề không hợp lệ',
        ];
    }
}
