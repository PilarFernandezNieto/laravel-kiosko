<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password as PasswordRules;

class RegistroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                PasswordRules::min(8)->letters()->symbols()->numbers()
            ],
        ];
    }
    public function messages(){
        return [
            "name" => "El nombre es obligatorio",
            "email.required" => "El email es obligatorio",
            "email.email" => "El email no es válido",
            "email.unique" => "El email ya está en uso",
            "password.required" => "La contraseña es obligatoria",
            "password.confirmed"  => "Las contraseñas no coinciden"
        ];
    }
}
