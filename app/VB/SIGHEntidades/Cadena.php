<?php

namespace App\VB\SIGHEntidades;

use App\VB\SIGHEntidades\Enumerados;

class Cadena
{
    // '------------------------------------------------------------------------------------
    // '        Organización: Usaid - Politicas en Salud
    // '        Aplicativo: SisGalenPlus v.3
    // '        Programa:  Clase para capa de Procesos Generales de Cadenas de Texto
    // '        Programado por: Castro W
    // '        Fecha: Enero 2005
    // '
    // '------------------------------------------------------------------------------------

    public static function ReemplazarCadena($sOriginal, $sCadenaA, $sCadenaR)
    {
        return str_replace($sCadenaA, $sCadenaR, $sOriginal);
    }


    public static function DevuelveARROBAS( $text )
    {
        $arrobaExiste = strpos( $text, '@');
        return ($arrobaExiste !== false);
    }

    public static function FormatoCodigoRENAES( $sCodigo, $lFuenteReanes) 
    {
        $sCodigoFormat = "";
        switch ( $lFuenteReanes){
            case Enumerados::param('sghRENAESFuente.GALENHOS'):
                $sCodigoFormat = Cadena::Format($sCodigo, "00000");
                break;
            case Enumerados::param('sghRENAESFuente.SIS'):
                $sCodigoFormat = Cadena::Format($sCodigo, "0000000000");
                break;
            case Enumerados::param('sghRENAESFuente.SUNASA'):
                // $sCodigoFormat = CStr(Val($sCodigo));
                $sCodigoFormat = (int) $sCodigo;
                break;
            case Enumerados::param('sghRENAESFuente.RENAESNORMA')::
                $sCodigoFormat = Cadena::Format($sCodigo, "00000000");
                break;
        }
        return $sCodigoFormat;
    }

    public static function Format( $text, $format)
    {
        $text = $format . $text;

        $text = substr( $text, strlen($text)-strlen($format), strlen($text));
        return $text;
    }
}
