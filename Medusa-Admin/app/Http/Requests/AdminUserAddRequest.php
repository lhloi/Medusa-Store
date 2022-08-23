<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserAddRequest extends FormRequest
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
            'name' => 'required|max:255|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên nhân viên.',

            'name.max' => 'Vui lòng nhập lại tên nhân viên quá dài.(255)',
            'name.min' => 'Vui lòng nhập lại tên nhân viên quá ngắn.(255)',
            'email.required' => 'Vui lòng nhập email nhân viên.',
            'email.email' => 'Vui lòng nhập là email.',
            'email.unique' => 'Email nhân viên đã tồn tại.',
            'password.required' => 'Vui lòng nhập password nhân viên.',
            'role_id.required' => 'Vui lòng chọn vai trò nhân viên.',

        ];
    }
}
