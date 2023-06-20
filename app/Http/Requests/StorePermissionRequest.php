<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
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
            'permission_name' => 'required|string|min:5|max:255|unique:permissions,name',
            'permission_description' => 'required|string|min:5|max:255'
        ];
    }

    public function messages()
    {
        return [
            'permission_name.required' => 'El :attribute es obligatorio.',
            'permission_name.string' => 'El :attribute debe contener caracteres válidos.',
            'permission_name.min' => 'El :attribute debe contener mínimo 5 caracteres.',
            'permission_name.max' => 'El :attribute debe contener máximo 255 caracteres.',
            'permission_name.unique' => 'El :attribute ya existe en la base de datos.',
            'permission_description.required' => 'La :attribute es obligatorio.',
            'permission_description.string' => 'La :attribute debe contener caracteres válidos.',
            'permission_description.min' => 'La :attribute debe contener mínimo 5 caracteres.',
            'permission_description.max' => 'La :attribute debe contener máximo 255 caracteres.',
        ];
    }

    public function attributes()
    {
        return [
            'permission_name' => 'nombre del permiso',
            'permission_description' => 'descripción del permiso'
        ];
    }
}
