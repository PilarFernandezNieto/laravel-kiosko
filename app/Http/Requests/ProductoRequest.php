<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'max:255'],
            'imagen' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
            'precio' => ['required'],
            'disponible' => ['nullable', 'boolean'],
            'categoria_id' => ['required', 'integer']
        ];
    }

    public function messages()
    {
        return [
            'nombre' => 'El nmbre del producto es obligatorio',
            'imagen.required' => 'La imagen es obligatoria',
            'imagen.image' => 'Introduce una imagen valida',
            'precio' => 'Debe introducir un precio',
            'categoria_id' => 'Debe asignar una categoria'
        ];
    }
}
