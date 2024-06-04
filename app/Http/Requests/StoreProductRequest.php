<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'image' => 'required',
            // 'price' => 'required|numeric',
            'description' => 'required|string',
            'price_sale' => 'nullable|numeric',
            // 'sku' => 'required|string|unique:products|max:255',
            'weight' => 'nullable|numeric',
            'status' => 'required|in:0,1',
            'category_id' => 'nullable|numeric',
            'brand_id' => 'nullable|numeric',
            'origin' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'name.string' => 'Tên sản phẩm phải là chuỗi.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',

            'image.required' => 'Ảnh sản phẩm là bắt buộc.',
            // 'price.required' => 'Giá là bắt buộc.',
            // 'price.numeric' => 'Giá phải là số.',
            'description.required' => 'Mô tả là bắt buộc.',
            'description.string' => 'Mô tả phải là chuỗi.',
            'price_sale.numeric' => 'Giá khuyến mãi phải là số.',
            // 'sku.required' => 'Mã hàng hóa là bắt buộc.',
            // 'sku.string' => 'Mã hàng hóa phải là chuỗi.',
            // 'sku.max' => 'Mã hàng hóa không được vượt quá 255 ký tự.',
            // 'sku.unique' => 'Mã hàng hóa đã tồn tại.',
            'weight.numeric' => 'Trọng lượng phải là số.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.in' => 'Trạng thái không hợp lệ.',
            'category_id.numeric' => 'ID danh mục phải là số.',
            'brand_id.numeric' => 'ID thương hiệu phải là số.',
            'origin.numeric' => 'Xuất xứ phải là số.',
        ];
    }
}
