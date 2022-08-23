<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderAddRequest extends FormRequest
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
            'name' => 'required|unique:products|max:255',
            'description' => 'required',
            'image_path' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tiêu đề slider.',
            'name.unique' => 'Tiêu đề slider đã tồn tại.',
            'name.max' => 'Vui lòng nhập lại tiêu đề slider quá dài.(255)',
            'description.required' => 'Vui lòng nhập mô tả.',
            'image_path.required' => 'Vui lòng thêm hình ảnh.',
        ];
    }
}
