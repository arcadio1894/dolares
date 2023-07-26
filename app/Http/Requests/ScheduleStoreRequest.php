<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleStoreRequest extends FormRequest
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
            'day' => 'required|unique:schedules,day',
            'hourStart' => 'required',
            'hourEnd' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'day' => 'día del horario',
            'hourStart' => 'día del horario',
            'hourEnd' => 'día del horario'
        ];
    }
}
