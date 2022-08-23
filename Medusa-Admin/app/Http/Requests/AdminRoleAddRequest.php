<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRoleAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:roles|max:255',
            'display_name'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên vai trò.',
            'name.unique' => 'Tên vai trò đã tồn tại.',
            'name.max' => 'Vui lòng nhập lại tên vai trò quá dài.(255)',
            'display_name.required' => 'Vui lòng nhập mô tả vai trò.',

        ];
    }
}
