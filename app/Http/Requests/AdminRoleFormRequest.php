<?php

namespace Nht\Http\Requests;

use Nht\Http\Requests\Request;

class AdminRoleFormRequest extends Request
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
        return [
            'name' => 'required',
            'display_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('admin/validation.role_name_required'),
            'display_name.required' => trans('admin/validation.role_key_required')
        ];
    }
}
