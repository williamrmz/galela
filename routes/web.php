<?php

Route::middleware('auth')->group(function ()
{
    include __DIR__.'\\partials\\ConsultaExternaRoute.php';
    include __DIR__.'\\partials\\EmergenciaRoute.php';
    include __DIR__.'\\partials\\HospitalizacionRoute.php';
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


    /* TODO: se desactiva temporalmente el ruteo generado automaticamente al modulo (lab) ya que la programacion incial del modulo 
    no pusee una arquitectura de clases y no utiliza procedimientos almacenados acorde al proyecto actual.
    Ademas: no se adaptó al proyecto final porque se empezo a priorizar el desarrollo de otros modulos... (consultorio externo)
    */
    // include __DIR__.'\\partials\\LaboratorioRoute.php';  
    include __DIR__.'\\partials\\ImagenologiaRoute.php';
    include __DIR__.'\\partials\\SisRoute.php';
    include __DIR__.'\\partials\\HisRoute.php';
    include __DIR__.'\\partials\\SeguimientoRoute.php';

    // API :: Obtener parametros por ID o codigo
    Route::get("/api/getParametroById/{id}", "ParametroController@getParametroById");
    Route::get("/api/getParametroByCodigo/{codigo}", "ParametroController@getParametroByCodigo");

});


Auth::routes();

Route::get('/test/{dni}', 'ConsultaReniecController@consultarPorNroDocumento');
Route::get('/test', function ()
{
    return \App\VB\SIGHDatos\Medicos::filtrarMedico();
});

Route::get('/postgres', function(){
    $params = [ 'nombre' => 'cesar', 'descrip' => 'sistemas',];
    $agregar = execute('gruposAgregar', $params, true);
    dd($agregar);
    $params = ['filtro'=>"where lower(nombre) like 't%' "];
    $filtrar = execute('gruposFiltrar', $params, true);
    dd($filtrar);
});

Route::middleware('auth')->group(function () {
    Route::get('/', function() { return redirect('home'); });
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile', 'UsuarioController@profile');
});


Route::get('/api', 'ApiController@index');

Route::get('/partials', 'PartialController@index');

Route::get('/controles', 'ControlesController@index');



// Ruteo del modulo antiguo de laboratorio
Route::middleware('auth')->group(function () {
    Route::prefix('laboratorio/insumos')->group( function () {
        Route::name('lab.')->group( function () {

            Route::get('/', 'Lab\InsumoController@index')->name('insumos');

            Route::resource('/consumos', 'Lab\InsumoConsumoController');

            Route::resource('/asignaciones', 'Lab\InsumoAsignacionController');
            Route::get('/asignaciones/partial/responsables', 'Lab\InsumoAsignacionController@partialResponsables');
            Route::get('/asignaciones/partial/modal-consumos', 'Lab\InsumoAsignacionController@partialModalConsumos');
            Route::get('/asignaciones/partial/tbody-consumos', 'Lab\InsumoAsignacionController@partialTbodyConsumos');

            Route::resource('/configuracion-resultados', 'Lab\ConfigResultadoLaboratorioController');
            
        });
    });
}); 

Route::middleware('auth')->group(function () {
    Route::prefix('laboratorio/pat-clinica')->group( function () {
        Route::name('lab.')->group( function () {

            Route::get('/', 'Lab\PatClinicaController@index')->name('patologia-clinica');

            Route::resource('/ordenes', 'Lab\OrdenController');
    
            Route::get('/ordenes/{idMovimiento}/detalle', 'Lab\OrdenController@detalle')
                ->name('ordenes.detalle');
        
            Route::get('/ordenes/{idOrden}/previa', 'Lab\OrdenController@previa')
                ->name('ordenes.previa');
        
            Route::get('/ordenes/{idOrden}/imprimir', 'Lab\OrdenController@imprimir')
                ->name('ordenes.imprimir');
        
            Route::get('/ordenes/{idMovimiento}/servicio/{idProducto}', 'Lab\OrdenController@resultados')
                ->name('ordenes.resultados');
        
            Route::post('/actualizaResultados', 'Lab\OrdenController@actualizaResultados')
                ->name('ordenes.resultados-update');

            
            //CRUD MODELS
    
            Route::get('/config-antibiograma', 'Lab\ConfigAntibiogramaController@index')->name('config-antibiograma.index');
            Route::resource('/germenes', 'Lab\GermenController');
            Route::get('/germenes/{id}/delete', 'Lab\GermenController@delete');
            Route::resource('/antibioticos', 'Lab\AntibioticoController');
            Route::get('/antibioticos/{id}/delete', 'Lab\AntibioticoController@delete');

            Route::resource('/items', 'Lab\ItemController');
            Route::get('items/{id}/delete', 'Lab\ItemController@delete');
        
            Route::resource('refs', 'Lab\ValorReferenciaController');
            Route::get('refs/{id}/delete', 'Lab\ValorReferenciaController@delete');
    
            Route::resource('/firmas', 'Lab\FirmaController');
            Route::get('/firmas/{id}/delete', 'Lab\FirmaController@delete');
    
            Route::get('/estadisticas', 'Lab\EstadisticaController@index')->name('estadisticas.index');
            Route::get('/estadisticas/print', 'Lab\EstadisticaController@print')->name('estadisticas.print');
    
            Route::resource('/periodos', 'Lab\PeriodoIndicadorController');
            Route::get('/periodos/{id}/delete', 'Lab\PeriodoIndicadorController@delete');
            Route::get('/periodos/{id}/sumary', 'Lab\PeriodoIndicadorController@sumary');
            Route::post('/periodos/update-periodo-dia', 'Lab\PeriodoIndicadorController@updatePeriodoDia');
        });
    });
});
