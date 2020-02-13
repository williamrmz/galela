<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroTriajeRequest extends FormRequest
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
            'txtNroCuenta' => 'required|max:8',
            'txtPulso' => 'required|numeric|between:60,100',
            'txtTemperatura' => 'required|numeric|between:35,42',
            'txtPresionArterial' => 'required',
            'txtFreRespiratoria' => 'sometimes|numeric|min:10|max:20',
            'txtPeso' => 'sometimes|numeric|min:0',
            'txtTalla' => 'sometimes|numeric|min:0',
        ];
    }

    public function attributes()
    {
        return [
            'txtNroCuenta' => 'número de cuenta',
            'txtPulso' => 'pulso',
            'txtTemperatura' => 'temperatura en C°',
            'txtPresionArterial' => 'presión arterial',
            'txtFreRespiratoria' => 'frecuencia respiratoria',
            'txtPeso' => 'peso',
            'txtTalla' => 'talla',
        ];
    }
}
