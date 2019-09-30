<?php

namespace App\VB\SIGHEntidades;

class Teclado
{
    // '------------------------------------------------------------------------------------
    // '        Organización: Usaid - Politicas en Salud
    // '        Aplicativo: SisGalenPlus v.3
    // '        Programa:  Clase para capa de Procesos Generales de Cadenas de Texto
    // '        Programado por: Castro W
    // '        Fecha: Enero 2005
    // '
    // '------------------------------------------------------------------------------------

    public static function TextoAlmenosExisteAlgunaLetra( $lcTexto )
    {

        $status = preg_match('/[a-zA-Z]/', $lcTexto); 
        // $containsDigit = preg_match('/\d/', $string); 
        // $containsSpecial = preg_match('/[^a-zA-Z\d]/', $string); // $containsAll = $containsLetter && $containsDigit && $containsSpecial 
        // $status = is_numeric( $lcTexto );
        return $status;

        // On Error GoTo TexSal
        // TextoAlmenosExisteAlgunaLetra = False
        // If Len(lcTexto) > 0 Then
        //     Dim lcTextoFinal As String, lnFor As Integer
        //     For lnFor = 1 To Len(lcTexto)
        //         If CodigoAsciiEsLetra(Asc(Mid(lcTexto, lnFor, 1))) = True Then
        //         TextoAlmenosExisteAlgunaLetra = True
        //         Exit For
        //         End If
        //     Next
        // End If
    }


    public static function TextoEsSoloNumeros( $text )
    {
        return preg_match ("/^[0-9]+$/", trim($text) );
        // return is_numeric( $text );
    }
}
