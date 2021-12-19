<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapNhatThongTinCaNhanRequest extends FormRequest
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
            'address' => 'required',
            'email' => 'required | email | unique:nguoi_dung,email'
        ];
    }

    public function messages()
    {
        return [
            'address.required' => 'Chưa nhập địa chỉ',
            'email.required' => 'Chưa nhập email',
            'email.email' => 'Hãy nhập vào một email',
            'email.unique' => 'Email đã được sử dụng'
        ];
    }
}
