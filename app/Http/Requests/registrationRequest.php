<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registrationRequest extends FormRequest
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
            'name' => 'required',
            'login' => 'required| unique:users',
            'email' => 'required| unique:users',
            'password' => 'required| min: 8 | confirmed',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'необходимо заполнить поле',
            'login.unique' => 'login is already taken',
            'login.unique' => 'email is already taken',
            'password.min' => 'gароль должен быть не менее 8 символов',
            'password.confirmed' => 'пароли не совпадают'
        ];
    }
}
