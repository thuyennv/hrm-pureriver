<?php

namespace Nht\Http\Requests;

use Nht\Http\Requests\Request;

class AdminUserFormRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'email'    => 'required|email',
            'password' => 'required|min:6',
            'confimation_password' => 'same:password',
            'nickname' => 'required',
            'name'     => 'required',
            'phone'    => 'required',
            'address'  => 'required'
        ];

        // Thêm unique user rule khi tạo mới
        if ($this->is('admin/users')) {
            $rules['email'] .= '|unique:users';
        }

        // Update thì loại password ra
        if ($this->method('PUT') && $this->is('admin/users/*')) {
            unset($rules['password']);
            unset($rules['confimation_password']);
        }

        // Bỏ 1 số fields khi update profile
        if ($this->is('admin/profile')) {
            unset($rules['email']);
            unset($rules['password']);
            unset($rules['confimation_password']);
        }

        return $rules;
    }
}
