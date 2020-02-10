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
            'txtFechaFin' => 'required|date',
            'txtFechaInicio' => 'required|date',
            'cmbIdTipoServicio' => 'required',
            'cmbIdEspecialidad' => 'required',
            'cmbIdServicio' => 'required',
            'cmbIdTipoProgramacion' => 'required',
            'cmbIdTurno' => 'required',
            'txtHoraInicio' => 'required|date_format:H:i',
            'txtHoraFin' => 'required|date_format:H:i',
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
                'cmbIdEspecialidad' => 'especialidad',
                'cmbIdTipoProgramacion' => 'tipo de programación',
                'cmbIdTipoServicio' => 'tipo de servicio',
                'cmbIdServicio' => 'servicio',
            ];
    }
}
