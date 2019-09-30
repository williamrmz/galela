<?php

namespace App\VB\SIGHSis;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\VB\SIGHDatos\TiposDestinosAtencion;
use App\VB\SIGHDatos\Atenciones;
use App\VB\SIGHEntidades\Enumerados;


class ReglasSISgalenhos extends Model
{

    public function __construct()
    {

    }

    public function SisFiliacionesDevuelveKEY(&$lnIdSiaSis, &$lcSIScodigo, $lcApellPaterno, $lcApellMaterno,$lcPrimerNombre, $ldFechaNacimiento,&$lcCodigoEstablecimientoAdscripcionSIS)
    {
        $params = [
            'Paterno' => $lcApellPaterno,
            'Materno' => $lcApellMaterno,
            'Pnombre' => $lcPrimerNombre,
            'Fnacimiento' => $ldFechaNacimiento,
        ];

        // dd( Enumerados::param('sghBaseDatosExterna.sghJamo') );
        $oRsTmp1 = execute('SisFiliacionesDevuelveKEY', $params, false, 'sigh_externa');

        if ( count($oRsTmp1) > 0 ) {
            $oRsTmp1Fields = $oRsTmp1[0];
            $lnIdSiaSis = $oRsTmp1Fields->idSiasis;
            $lcSIScodigo = $oRsTmp1Fields->Codigo;
            $lcCodigoEstablecimientoAdscripcionSIS = is_null($oRsTmp1Fields->CodigoEstablAdscripcion)? "": $oRsTmp1Fields->CodigoEstablAdscripcion;
        }
    }
    
    
}