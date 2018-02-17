<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !\Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'string | required',
            'email'       => 'email | required | unique:users,email',
            'password'    => 'string | required',
            'address'     => 'string | required',
            'phone'       => 'string | required',
            'city'        => 'string |required',
            'category_id' => 'exists:categories,id',
            'interest_id' => 'exists:interests,id'
        ];
    }
}
