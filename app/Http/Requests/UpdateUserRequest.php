<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$this->get('user_id'),
            'phone' => 'nullable|numeric',
            'document' => 'nullable|numeric',
            'role_edit' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'El :attribute es obligatorio.',
            'user_id.exists' => 'El :attribute no existe en la base de datos.',
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
            'phone.numeric' => 'El :attribute debe ser un formato numérico',
            'document.numeric' => 'El :attribute debe ser un formato numérico',
            'role_edit.required' => 'El :attribute es obligatorio.'
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => 'identificador del usuario',
            'first_name' => 'nombre del usuario',
            'last_name' => 'nombre del usuario',
            'email' => 'correo electrónico',
            'phone' => 'teléfono',
            'document' => 'documento',
            'role_edit' => 'rol'
        ];
    }
}
