<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
            'role_id' => 'required|exists:roles,id',
            'role_name' => 'required|string|min:5|max:255',
            'role_description' => 'required|string|min:5|max:255'
        ];
    }

    public function messages()
    {
        return [
            'role_id.required' => 'El :attribute es obligatorio.',
            'role_id.exists' => 'El :attribute debe existir en la base de datos.',
            'role_name.required' => 'El :attribute es obligatorio.',
            'role_name.string' => 'El :attribute debe contener caracteres válidos.',
            'role_name.min' => 'El :attribute debe contener mínimo 5 caracteres.',
            'role_name.max' => 'El :attribute debe contener máximo 255 caracteres.',
            'role_description.required' => 'La :attribute es obligatorio.',
            'role_description.string' => 'La :attribute debe contener caracteres válidos.',
            'role_description.min' => 'La :attribute debe contener mínimo 5 caracteres.',
            'role_description.max' => 'La :attribute debe contener máximo 255 caracteres.',
        ];
    }

    public function attributes()
    {
        return [
            'role_id' => 'id del rol',
            'role_name' => 'nombre del rol',
            'role_description' => 'descripción del rol'
        ];
    }
}
