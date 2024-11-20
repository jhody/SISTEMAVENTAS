<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
            'rememberMe' => 'boolean',
            'verifyCode' => 'sometimes|captcha',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Usuario es requerido.',
            'password.required' => 'Clave es requerida.',
            'verifyCode.captcha' => 'Código de verificación incorrecto.',
        ];
    }

    public function authenticate()
    {
        $credentials = $this->only('username', 'password');

        if (!Auth::attempt($credentials, $this->boolean('rememberMe'))) {
            $this->throwValidationException($this, [
                'username' => 'Usuario no existe o clave incorrecta.',
            ]);
        }
    }
}
