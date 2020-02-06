<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TurnoRequest extends FormRequest
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
        return
        [
            'txtCodigo' => 'required|max:3',
            'txtDescripcion' => 'required',
            'cmbIdTipoServicio' => 'required',
            'txtHoraInicio' => 'required',
            'txtHoraFin' => 'required',
        ];
    }

    public function attributes()
    {
        return
        [
            'txtCodigo'             => 'código',
            'txtDescripcion'        => 'descripción',
            'cmbIdTipoServicio'     => 'tipo de servicio',
            'txtHoraInicio'         => 'hora de inicio',
            'txtHoraFin'            => 'hora de fin',
        ];
    }
}
