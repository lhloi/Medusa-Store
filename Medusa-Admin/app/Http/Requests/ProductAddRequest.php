<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'name' => 'required|unique:products|max:255|min:10',
            'price' => 'required|numeric',
            'content' => 'required',
            'category_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm.',
            'name.unique' => 'Tên sản phẩm đã tồn tại.',
            'name.max' => 'Vui lòng nhập lại tên sản phẩm quá dài.(255)',
            'name.min' => 'Vui lòng nhập lại tên sản phẩm quá ngắn.(10)',
            'price.required' => 'Vui lòng nhập giá sản phẩm.',
            'price.numeric' => 'Vui lòng nhập giá sản phẩm là số.',
            'content.required' => 'Vui lòng nhập mô tả sản phẩm.',
            'category_id.required' => 'Vui lòng chọn danh mục sản phẩm.',
        ];
    }
}
