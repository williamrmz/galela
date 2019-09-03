<?php

use App\Empleados as Empleado;

function encryptString( $string )
{
    $data = 'uknown';
    try{
        $oCrypKey = new \COM("CrypKey.Util") or die("error");
        $data =  $oCrypKey->EncryptString($string);
    }catch(\Exception $e){
        $data = 'EncryptString fail';
    }
    return $data;
}

function decryptString( $string )
{
    $data = 'uknown';
    try{
        $oCrypKey = new \COM("CrypKey.Util") or die("error");
        $data =  $oCrypKey->DecryptString($string);
    }catch(\Exception $e){
        $data = 'DecryptString fail';
    }
    return $data;
}

function AuditoriaAgregarV ($idUsuario, $accion, $idRegistroTabla, $tabla, $idListItem, $nombrePc, $observaciones)
{
    $sql = 'EXEC AuditoriaAgregarV :idUsuario, :accion, :idRegistroTabla, :tabla, :idListItem, :nombrePc, :observaciones';
    $params = [ 
        'idUsuario' => $idUsuario,
        'accion' => $accion,
        'idRegistroTabla' => $idRegistroTabla,
        'tabla' => $tabla,
        'idListItem' => $idListItem,
        'nombrePc' => $nombrePc,
        'observaciones' => $observaciones,
    ];
    // dd($params);
    return \DB::update($sql, $params);
}

function fechaSistema()
{
    return date('d-m-Y H:i:s');
}

function arrFirst($array)
{
    return (count($array)>0)? $array[0]: null;
}

function arrJson($array)
{
    return json_decode(json_encode($array));
}

function fechaSQLServer()
{
    $result = DB::select('SELECT getDate() as date');
    if(count($result)==1){
        return $result[0]->date;
    }
    return null;
}

function nombrePC(){
    return Request::ip();
}

function zeroFill ($valor, $long = 0)
{
    return str_pad($valor, $long, '0', STR_PAD_LEFT);
}


function dateFormat($date, $format=null)
{   
    if(!$date) return null;

    if($format){
        return date($format, strtotime($date));
    }
    
    return $date;
}

function nextId($table, $pk)
{
    $data = \DB::select("SELECT TOP 1 $pk AS id  FROM $table ORDER BY $pk DESC");
    $lastId = 0;
    if(isset($data[0])){
        $lastId = $data[0]->id;
    }
    return $lastId + 1;
}

function menuArray()
{
    $data = 
    [
        [
            'label' => 'Fact - Config',
            'icon' => 'fa fa-dashboard',
            'path' => '/',
            'items' => [
                [
                    'label' => 'Catalogo de bienes e insumos',
                    'icon' => 'fa fa-circle-o',
                    'path' => '/fact-config/catalogo-bienes-insumos',
                ],
                [
                    'label' => 'Catalogo de servicios',
                    'icon' => 'fa fa-circle-o',
                    'path' => '/fact-config/catalogo-servicios',
                ],
                [
                    'label' => 'Config. resultados de laboratorio',
                    'icon' => 'fa fa-circle-o',
                    'path' => '/fact-config/config-resultados-laboratorio',
                ],
            ],
        ],
        [
            'label' => 'Laboratorio',
            'icon' => 'fa fa-dashboard',
            'path' => '/',
            'items' => [
                [
                    'label' => 'Asignacion de insumos',
                    'icon' => 'fa fa-circle-o',
                    'path' => '/laboratorio/asignacion-insumos',
                ],
                [
                    'label' => 'Pat. Clinica',
                    'icon' => 'fa fa-circle-o',
                    'path' => '/laboratorio/patologia-clinica',
                ],
            ],
        ],
    ];

    return json_decode(json_encode($data));
}


function pruebaValidada($idMovimiento, $idOrden)
{   
    $idItemValidar = 100;
    $sql = 
    "SELECT  TOP 1
    ic.idItem, ri.idOrden, ri.idProductoCpt, ri.ordenXresultado, ri.ValorCheck
    FROM LabMovimientoLaboratorio ml
    LEFT JOIN LabResultadoPorItems ri ON (ri.idOrden = ml.IdOrden)
    LEFT JOIN LabItemsCpt ic ON (ic.idProductoCpt = ri.idProductoCpt AND ic.ordenXresultado=ri.ordenXresultado)
    WHERE ml.IdMovimiento = $idMovimiento AND ri.idProductoCpt = $idOrden AND ic.idItem=$idItemValidar";

    $itemValidar = \DB::select($sql);
    $estado = isset($itemValidar[0])? $itemValidar[0]->ValorCheck: 0;
    return $estado;
}

function currentUser()
{
    return Empleado::find(738);
    return session('user');
}

function hasRole($IdRol){

    $empleado = session('user');
    if($empleado){
        $rol = DB::table('UsuariosRoles as ur')
                ->leftJoin('Roles as r', 'r.IdRol', 'ur.IdRol')
                ->where('ur.IdEmpleado', $empleado->IdEmpleado)
                ->where('ur.IdRol', $IdRol)
                ->select('r.*')->get()->first();
        return $rol;
    }

    return null;
}

function hasCargo($IdCargo)
{
    $empleado = session('user');
    if($empleado){
        $rol = DB::table('EmpleadosCargos as ec')
                ->leftJoin('TiposCargo as tc', 'tc.idTipoCargo', 'ec.IdCargo')
                ->where('ec.idEmpleado', $empleado->IdEmpleado)
                ->where('ec.idCargo', $IdCargo)
                ->select('tc.*')->get()->first();
        return $rol;
    }
    return null;
}

function getStringBetween($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);   
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}



function labelToPath($text)
{
    $text = normaliza($text);
    $text = str_replace(' ', '-', $text);
    $text = str_replace('--', '-', $text);
    $text = str_replace('--', '-', $text);
    $text = strtolower($text);
    return $text;
}

function normaliza($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    
    return utf8_encode($cadena);
}

function camelToMiddledash($text)
{
    return strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $text));
}

function camelToUnderscore($text)
{
    return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $text));
}


function buildDataPagination($items, $perPage=10, $request){
    $LapClass =  \Illuminate\Pagination\LengthAwarePaginator::class;
    // Get current page form url e.x. &page=1
    $currentPage = $LapClass::resolveCurrentPage();
    // dd($currentPage);
    // Create a new Laravel collection from the array data
    $itemCollection = collect($items);
    // Slice the collection to get the items to display in current page
    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
    // Create our paginator and pass it to the view
    $paginatedItems= new $LapClass($currentPageItems , count($itemCollection), $perPage);
    // set url path for generted links
    $paginatedItems->setPath($request->url());
    
    return $paginatedItems;
}

function arrlike($items, $key=null, $value)
{
    $data = [];
    foreach($items as $item){
        if( isset($item->$key) ){
            if( strripos($item->$key, $value) !== false ){
                $data[] = $item;
            }
        }
    }
    return $data;
}
