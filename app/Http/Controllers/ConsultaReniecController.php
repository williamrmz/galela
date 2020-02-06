<?php

namespace App\Http\Controllers;

use App\VB\SIGHDatos\Distritos;
use App\VB\SIGHDatos\Paises;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use \nusoap_client;

class ConsultaReniecController extends Controller
{
    public function consultarPorNroDocumento($dni)
    {
        // Obtener configuracion del archivo config/reniec.php
        $configuracion = app('config')->get('reniec');

        // Guardar configuracion en variables locales
        $service                = $configuracion["service"];
        $company                = $configuracion["company"];
        $user                   = $configuracion["user"];
        $pass                   = $configuracion["pass"];
        $max_sec_timeout        = $configuracion["max_sec_timeout"];

        // Tiempo máximo de ejecución consulta a RENIEC
        ini_set('max_execution_time', $max_sec_timeout);

        if(!isset($service))
        {
            return null;
        }

        // Lógica de petición SOAP
        $oSoapClient = new nusoap_client($service, true);
        $parametros = array();
        $parametros = array('nrodoc' => $dni);
        $headers = '<Credencialmq xmlns="http://tempuri.org/">';
        $headers .= " <app>{$company}</app>";
        $headers .= " <usuario>{$user}</usuario>";
        $headers .= " <clave>{$pass}</clave>";
        $headers .= "</Credencialmq>";
        $oSoapClient->setHeaders($headers);

        // Llamar a método SOAP de interés
        $respuesta = $oSoapClient->call("obtenerDatosCompletos", $parametros);
        if ($oSoapClient->fault)
        {
            throw new \Exception("No se pudo completar la operación " . $oSoapClient->getError());
        } else
        {
            $sError = $oSoapClient->getError();
            if ($sError)
            {
                throw new \Exception("Error: "+$sError);
            }
        }

        $respuesta = $respuesta["obtenerDatosCompletosResult"]["string"];
        $personaDatos                               = array();
        $personaDatos["NroDocumento"]               = $respuesta[2];
        $personaDatos["ApellidoPaterno"]            = utf8_encode($respuesta[4]);
        $personaDatos["ApellidoMaterno"]            = utf8_encode($respuesta[5]);
        $personaDatos["NombrePadre"]                = utf8_encode($respuesta[30]);
        $personaDatos["NombreMadre"]                = utf8_encode($respuesta[31]);
        $personaDatos["Nombres"]                    = $respuesta[7];

        // ----------- Dividir nombres en 1° nombre, 2°, etc... -----------------
        $nombres                                    = explode(" ", $personaDatos["Nombres"]);
        $personaDatos["PrimerNombre"]               = (count($nombres)>0)?$nombres[0]:"";
        $personaDatos["SegundoNombre"]              = (count($nombres)>1)?$nombres[1]:"";
        $personaDatos["TercerNombre"]               = (count($nombres)>2)?$nombres[2]:"";
        // ----------------------------------------------------------------------

        $personaDatos["IdTipoSexo"]                 = $respuesta[22];
        $personaDatos["FechaNacimiento"]            = Carbon::createFromFormat('d/m/Y', $respuesta[29])->format('Y-m-d');
        $personaDatos["pais"]                       = $respuesta[15];
        $personaDatos["IdPaisDomicilio"]            = Paises::buscarPaisPorNombre($personaDatos["pais"])->IdPais;
        $personaDatos["IdPaisProcedencia"]          = $personaDatos["IdPaisDomicilio"];
        $personaDatos["IdPaisNacimiento"]           = $personaDatos["IdPaisDomicilio"];

        // Direccion domicilio
        $personaDatos["direccion"]              = utf8_encode($respuesta[36]);
        $personaDatos["urbanizacion"]           = utf8_encode($respuesta[41]);
        $personaDatos["manzana"]                = utf8_encode($respuesta[43]);
        $personaDatos["lote"]                   = utf8_encode($respuesta[44]);
        $direccion = reemplazarFrase($personaDatos["direccion"]);
        $direccion.= ' '.reemplazarFrase($personaDatos["urbanizacion"]);
        $direccion.= ' '.reemplazarFrase($personaDatos["manzana"]);
        $direccion.= ' '.reemplazarFrase($personaDatos["lote"]);
        $personaDatos["DireccionDomicilio"]              = trim($direccion);

        // Ubigeo (Domicilio)
        $personaDatos["dom_dep"] = $respuesta[10];
        $personaDatos["dom_prov"] = $personaDatos["dom_dep"].$respuesta[11];
        $personaDatos["dom_dis"] = $personaDatos["dom_prov"].$respuesta[12];
        $personaDatos["IdDistritoDomicilio"] = Distritos::ubigeoPorIDReniec($personaDatos["dom_dis"]);

        // Ubigeo (Nacimiento)
        $personaDatos["nac_dep"] = $respuesta[23];
        $personaDatos["nac_prov"] = $personaDatos["nac_dep"].$respuesta[24];
        $personaDatos["nac_dis"] = $personaDatos["nac_prov"].$respuesta[25];
        $personaDatos["IdDistritoNacimiento"] = Distritos::ubigeoPorIDReniec($personaDatos["nac_dis"]);


        $personaDatos["departamento"]           = $respuesta[16];
        $personaDatos["provincia"]              = $respuesta[17];
        $personaDatos["distrito"]               = $respuesta[18];
        $personaDatos["departamento_nac"]       = $respuesta[26];
        $personaDatos["provincia_nac"]          = $respuesta[27];
        $personaDatos["distrito_nac"]           = $respuesta[28];

        // Datos por defecto a cargar
        // :: Etnia
        $personaDatos["IdEtnia"]              = 80;
        // :: Idioma materno
        $personaDatos["IdIdioma"]              = 101;

        $personaDatos["foto_base64"]            = $respuesta[47];

        // Guardar foto en carpeta local
        $foto = base64_decode($personaDatos["foto_base64"]);
        $path_foto = Storage::disk('public')->put('images/pacientes/'.$personaDatos["NroDocumento"].".jpeg", $foto);
        //dd($personaDatos);
        return $personaDatos;
    }
}
