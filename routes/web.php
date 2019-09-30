<?php

include __DIR__.'\\partials\\ConsultaExternaRoute.php';
include __DIR__.'\\partials\\EmergenciaRoute.php';
include __DIR__.'\\partials\\HospitalizacionRoute.php';
include __DIR__.'\\partials\\ProgramacionGeneralRoute.php';
include __DIR__.'\\partials\\ArchivoClinicoRoute.php';
// include __DIR__.'\\partials\\FacturacionGeneralRoute.php';
include __DIR__.'\\partials\\CajaRoute.php';
include __DIR__.'\\partials\\FarmaciaRoute.php';
include __DIR__.'\\partials\\EstadisticaRoute.php';
// include __DIR__.'\\partials\\CentroQuirurgicoRoute.php';
// include __DIR__.'\\partials\\ServicioSocialRoute.php';
include __DIR__.'\\partials\\GeneralRoute.php';
include __DIR__.'\\partials\\SeguridadRoute.php';
include __DIR__.'\\partials\\FacturacionRoute.php';
include __DIR__.'\\partials\\FactConfigRoute.php';
include __DIR__.'\\partials\\LaboratorioRoute.php';
include __DIR__.'\\partials\\ImagenologiaRoute.php';
include __DIR__.'\\partials\\SisRoute.php';
include __DIR__.'\\partials\\HisRoute.php';
include __DIR__.'\\partials\\SeguimientoRoute.php';


Auth::routes();


Route::get('/cast', function(){
    

    // dd( DB::table('auditoria')->limit(200000)->get() );
    // // $data = DB::select('select top 300000 * from auditoria');
    // echo  'End:'.date('H:i:s').'<br>';

    // $data = cast(\App\VB\SIGHComun\DOEmpleado::class, $data, ['idEmpleado'=>'IdAuditoria', 'nombres'=>'Tabla']);
    

    // foreach( $data as $empleado)
    // {
    //     echo "$empleado->nombres<br>";
    // }
});



Route::get('/postgres', function(){
    $params = [ 'nombre' => 'cesar', 'descrip' => 'sistemas',];
    $agregar = execute('gruposAgregar', $params, true);
    dd($agregar);

    // $params = [ 'id' => '1', 'nombre' => 'cesar', 'descrip' => 'sistemas',];
    // $modificar = execute('gruposModificar', $params, true);
    // dd($modificar);

    // $params = [ 'id' => 8];
    // $eliminar = execute('gruposEliminar', $params, true);
    // dd($eliminar);

    // $params = [ 'filtro' => 'nombre like "%t%"'];
    // $eliminar = execute('gruposEliminar', $params, true);
    // dd($eliminar);

    // $listar = execute('gruposListar');
    // dd($listar);

    $params = ['filtro'=>"where lower(nombre) like 't%' "];



    $filtrar = execute('gruposFiltrar', $params, true);



    dd($filtrar);
    
});

Route::get('/test', 'TestController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/api', 'ApiController@index');

Route::get('/partials', 'PartialController@index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', 'UsuarioController@profile');
});


Route::get('/controles', 'ControlesController@index');

