<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function messages() {
        return [
            'login.required'        => 'Поле Логин не заполнено',
            'login.unique'          => 'Этот Логин уже занят',
            'full_name.required'    => 'Поле Имя не заполнено',
            'email.required'        => 'Поле Email не заполнено',
            'email.email'           => 'Поле Email должно быть действительным адресом электронной почты',
            'email.unique'          => 'Этот email уже занят',
            'phone.required'        => 'Поле Номер телефона не заполнено',
            'phone.unique'          => 'Этот номер телефона уже занят',
            'phone.regex'           => 'Номер телефона должен должен состоять из 11 цифр и начинаться с 7 или 8',
            'password.required'     => 'Поле Пароль не заполнено',
            'password.confirmed'    => 'Пароли не совпадают',
        ];
    }

    public function rules()
    {
        return [
            'login'     => 'required|unique:users,login',
            'full_name' => 'required',
            'email'     => 'required|email|unique:users,email',
            'phone'     => 'required|unique:users,phone|regex:/^[78][0-9]{10}$/',
            'password'  => 'required|confirmed',
        ];
    }
}
