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

Route::get('/test', 'TestController@index');


Route::get('/dev/genera-sigh-datos', 'DevController@generaSighDatos');
Route::get('/dev/genera-sigh-comun', 'DevController@generaSighComun');
Route::get('/dev/test', 'DevController@test');

Route::get('/dev', 'DevController@index');
Route::get('/dev/design/{fileName}', 'DevController@design');
Route::get('/dev/list/{fileName}', 'DevController@list');
Route::get('/dev/searh/{fileName}', 'DevController@searh');
Route::get('/dev/procedures', 'DevController@procedures');
Route::get('/dev/create-model', 'DevController@createModel');

Route::get('/dev/generate-controllers', 'DevController@generateControllers');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/api', 'ApiController@index');

Route::get('/partials', 'PartialController@index');



Route::middleware('auth')->group(function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/profile', 'UsuarioController@profile');
});


// Route::middleware('auth')->group(function () {

//     Route::prefix('seguridad')->group( function () {

//         Route::name('seguridad.')->group( function () {

//             Route::resource('/roles', 'Seguridad\RolController');
//             Route::get('/roles/delete', 'Seguridad\RolController@delete');
            
//         });

//     });
    
// });

// Route::middleware('auth')->group(function () {

//     Route::prefix('fact-config')->group( function () {

//         Route::name('fact-config.')->group( function () {

//             Route::resource('/catalogo-servicios', 'CatalogoServicioController');

//             Route::resource('/catalogo-bienes-insumos', 'CatalogoBienInsumoController');

//             Route::resource('/resultados-laboratorio', 'ConfigResultadoLaboratorioController');
//         });
//     });
// });


Route::get('/controles', 'ControlesController@index');

Route::middleware('auth')->group(function () {

    Route::prefix('laboratorio/insumos')->group( function () {

        Route::name('lab.')->group( function () {

            Route::get('/', 'Lab\InsumoController@index')->name('insumos');

            Route::resource('/consumos', 'Lab\InsumoConsumoController');

            Route::resource('/asignaciones', 'Lab\InsumoAsignacionController');
            Route::get('/asignaciones/partial/responsables', 'Lab\InsumoAsignacionController@partialResponsables');
            Route::get('/asignaciones/partial/modal-consumos', 'Lab\InsumoAsignacionController@partialModalConsumos');
            Route::get('/asignaciones/partial/tbody-consumos', 'Lab\InsumoAsignacionController@partialTbodyConsumos');
            
        });

    });

});

Route::middleware('auth')->group(function () {

    Route::prefix('laboratorio/patologia-clinica')->group( function () {

        Route::name('lab.')->group( function () {

            Route::get('/', 'PatClinicaController@index')->name('patologia-clinica');

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

