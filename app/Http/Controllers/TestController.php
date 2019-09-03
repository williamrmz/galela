<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Visual\SIGHDatos\Roles;
use App\Visual\SIGHDatos\ListBarItems;

use App\Visual\Procedure;
use App\Visual\SIGHComun\DORol;
use App\Visual\SIGHComun\DOListBarItems;


class TestController extends Controller
{
    private $numFile = 0;

    public function index(Request $request)
    {
        $user = \Auth::user();
        dd($user->menu());
    }

    private function getName($text)
    {
        $possOC2 = strrpos($text, '[');
        if( !$possOC2 ) {
            $structure = "[dbo].[procedureName]";
            throw new \Exception("A structure like \"$structure\" was expected");
        }

        $tmp = substr($text, $possOC2, (strlen($text)-$possOC2) );
        $tmp = str_replace('[', '', $tmp);
        $tmp = str_replace(']', '', $tmp);
        return $tmp;
    }

    public function getStatement($texto)
    {
        $possAS = strpos (strtoupper($texto), 'AS');

        $possAS += $possAS? 2: 0;
        $length = strlen($texto) - $possAS;
        $stmt = trim(substr($texto, $possAS, $length));

        return $stmt;
    }


    public function getParams($text)
    {
        $text = trim($text);

        if(!$text) return null;

        if ( substr($text, 0, 1) == '(') $text = substr($text, 1, strlen($text));

        if ( substr($text, -1, 1) == ')') $text = substr($text, 0, -1);


        $paramsData = explode(',', $text);

        foreach ( $paramsData as $paramData){
            $param['name'] = $this->getParamName($paramData);
            $param['type'] = $this->getParamType($paramData);
            $params[] = $param;
        }

        // dd($params);
        return $params;
    }


    public function buscarAS($texto, $poss, $possTotal)
    {
        // dd($texto);
        $size = strlen($texto)-$poss;
        $texto = substr($texto, $poss, $size);
        $possAS = stripos($texto, 'AS');

        $possTotal += $possAS;

        if(!$possAS) return 'fail';

        // dd($texto);
        $nextChar = substr($texto, ($possAS+2), 1);

        if( $nextChar == " " || $nextChar == "\r" ){
            return $possTotal  - 2;
        }else{
            $possAS += 2;
            if($possAS < strlen($texto)){
                return $this->buscarAS($texto, $possAS, $possTotal);
            }else{
                return 'fail';
            }
        }
    }

    public function getParamName($texto){
        $name = getStringBetween(trim($texto), '@', ' ');
        return $name;
    }

    public function getParamType($texto){
        $words = explode(' ', $texto);
        $type = 'INPUT';
        if(count($words)){

            foreach($words as $word){
                if(strtoupper($word) == 'OUTPUT'){
                    $type = 'OUTPUT';
                }
            }
        }
        return $type;
    }


    // Search de second closed clasp
    public function searchCC2($texto)
    {
        //EX: CREATE procedure [dbo].[SeleccionaFarmaciaPorCuentaYServicio](@IdCuentaAtencion int ,@ServicioPaciente int)

    }

}
