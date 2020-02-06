<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramacionRequest extends FormRequest
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
            'txtIdMedico' => 'required',
            'txtHoraInicio' => 'required|date_format:H:i',
            'txtHoraFin' => 'required|date_format:H:i',
            'txtFechaInicio' => 'required|date',
            'txtFechaFin' => 'required|date',
            'cmbIdTurno' => 'required',
        ];
    }

    public function attributes()
    {
        return
            [
                'txtHoraInicio' => 'hora de inicio',
                'txtHoraFin' => 'hora de fin',
                'txtFechaInicio' => 'fecha de inicio',
                'txtFechaFin' => 'fecha de fin',
                'txtIdMedico' => 'médico',
                'cmbIdTurno' => 'turno',

            ];
    }
}
