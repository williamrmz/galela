<?php

namespace App\UC;

use Illuminate\Database\Eloquent\Model;

class UcPacientesSunasa extends Model
{
    public $fillable = [
        'idUsuario',
    ];

    public static function CargarDatosAlObjetoDatos( $lcTexto )
    {

    }
}
