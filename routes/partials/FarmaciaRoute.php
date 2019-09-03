<?php

Route::prefix('farmacia')->group( function () {

	Route::name('farmacia.')->group( function () {

		Route::resource('/inventario', 'Farmacia\InventarioController');
		Route::get('/inventario/{id}/delete', 'Farmacia\InventarioController@delete');
		Route::get('/inventario/api/service', 'Farmacia\InventarioController@apiService');

		Route::resource('/nota-ingreso', 'Farmacia\NotaIngresoController');
		Route::get('/nota-ingreso/{id}/delete', 'Farmacia\NotaIngresoController@delete');
		Route::get('/nota-ingreso/api/service', 'Farmacia\NotaIngresoController@apiService');

		Route::resource('/nota-salida', 'Farmacia\NotaSalidaController');
		Route::get('/nota-salida/{id}/delete', 'Farmacia\NotaSalidaController@delete');
		Route::get('/nota-salida/api/service', 'Farmacia\NotaSalidaController@apiService');

		Route::resource('/venta', 'Farmacia\VentaController');
		Route::get('/venta/{id}/delete', 'Farmacia\VentaController@delete');
		Route::get('/venta/api/service', 'Farmacia\VentaController@apiService');

		Route::resource('/intervenciones-sanitarias', 'Farmacia\IntervencionesSanitariasController');
		Route::get('/intervenciones-sanitarias/{id}/delete', 'Farmacia\IntervencionesSanitariasController@delete');
		Route::get('/intervenciones-sanitarias/api/service', 'Farmacia\IntervencionesSanitariasController@apiService');

		Route::resource('/dependencias-externas', 'Farmacia\DependenciasExternasController');
		Route::get('/dependencias-externas/{id}/delete', 'Farmacia\DependenciasExternasController@delete');
		Route::get('/dependencias-externas/api/service', 'Farmacia\DependenciasExternasController@apiService');

		Route::resource('/despacho-donaciones', 'Farmacia\DespachoDonacionesController');
		Route::get('/despacho-donaciones/{id}/delete', 'Farmacia\DespachoDonacionesController@delete');
		Route::get('/despacho-donaciones/api/service', 'Farmacia\DespachoDonacionesController@apiService');

		Route::resource('/farmacias', 'Farmacia\FarmaciasController');
		Route::get('/farmacias/{id}/delete', 'Farmacia\FarmaciasController@delete');
		Route::get('/farmacias/api/service', 'Farmacia\FarmaciasController@apiService');


	});

});