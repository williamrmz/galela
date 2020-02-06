<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfesionalesSaludRequest extends FormRequest
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
            'cmbIdDocIdentidad' => 'required',
            'txtNroDocumento' => 'required',
            'txtApellidoPaterno' => 'required|string',
            'txtApellidoMaterno' => 'required|string',
            'txtNombres' => 'required|string',
            'cmbIdTipoEmpleado' => 'required',
            'cmbIdCondicionTrabajo' => 'required',
            'txtColegiatura' => 'required',
            'cmbIdColegio' => 'required',
            'txtCodigoPlanilla' => 'required'
        ];
    }

    public function attributes()
    {
        return
            [
                'cmbIdDocIdentidad'     => 'tipo de documento de identidad',
                'txtNroDocumento'       => 'número de documento',
                'txtApellidoPaterno'    => 'apellido paterno',
                'txtApellidoMaterno'    => 'apellido materno',
                'txtNombres'            => 'nombre',
                'cmbIdTipoEmpleado'     => 'tipo de empleado',
                'cmbIdCondicionTrabajo' => 'condición de trabajo',
                'txtColegiatura'        => 'número de colegiatura',
                'cmbIdColegio'          => 'colegio profesional',
                'txtCodigoPlanilla'     => 'código de planilla',
            ];
    }
}
