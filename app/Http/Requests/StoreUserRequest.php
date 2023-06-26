<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|numeric',
            'document' => 'nullable|numeric',
            'role' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'El :attribute es obligatorio.',
            'first_name.string' => 'El :attribute debe contener caracteres válidos',
            'first_name.max' => 'El :attribute es demasiado largo.',
            'last_name.required' => 'El :attribute es obligatorio.',
            'last_name.string' => 'El :attribute debe contener caracteres válidos',
            'last_name.max' => 'El :attribute es demasiado largo.',
            'email.required' => 'El :attribute es obligatorio.',
            'email.string' => 'El :attribute debe contener caracteres válidos.',
            'email.email' => 'El :attribute no tiene formato de email adecuado.',
            'email.max' => 'El :attribute es demasiado largo.',
            'email.unique' => 'El :attribute ya existe en la base de datos.',
            'phone.numeric' => 'El :attribute debe ser un formato numérico.',
            'document.numeric' => 'El :attribute debe ser un formato numérico.',
            'role.required' => 'El :attribute es obligatorio.',
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => 'nombre del usuario',
            'last_name' => 'correo electrónico',
            'phone' => 'teléfono',
            'document' => 'documento',
            'role' => 'rol'
        ];
    }
}
