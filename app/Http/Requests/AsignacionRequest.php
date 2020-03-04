<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AsignacionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "cmbIdRol"          => 'required',
            "cmbIdEmpleado"     => 'required',
            "cmbIdDepartamento" => 'required',
            "cmbIdServicio"     => "sometimes"
        ];
    }

    public function attributes()
    {
        return [
            "cmbIdRol"          => 'rol',
            "cmbIdEmpleado"     => 'empleado',
            "cmbIdDepartamento" => 'departamento',
            "cmbIdServicio"     => 'servicio',
        ];
    }
}
