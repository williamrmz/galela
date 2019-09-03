<?php

Route::prefix('fact-config')->group( function () {

	Route::name('fact-config.')->group( function () {

		Route::resource('/centro-costos', 'FactConfig\CentroCostosController');
		Route::get('/centro-costos/{id}/delete', 'FactConfig\CentroCostosController@delete');
		Route::get('/centro-costos/api/service', 'FactConfig\CentroCostosController@apiService');

		Route::resource('/catalogo-servicios', 'FactConfig\CatalogoServiciosController');
		Route::get('/catalogo-servicios/{id}/delete', 'FactConfig\CatalogoServiciosController@delete');
		Route::get('/catalogo-servicios/api/service', 'FactConfig\CatalogoServiciosController@apiService');

		Route::resource('/producto-plan', 'FactConfig\ProductoPlanController');
		Route::get('/producto-plan/{id}/delete', 'FactConfig\ProductoPlanController@delete');
		Route::get('/producto-plan/api/service', 'FactConfig\ProductoPlanController@apiService');

		Route::resource('/catalogo-partidas', 'FactConfig\CatalogoPartidasController');
		Route::get('/catalogo-partidas/{id}/delete', 'FactConfig\CatalogoPartidasController@delete');
		Route::get('/catalogo-partidas/api/service', 'FactConfig\CatalogoPartidasController@apiService');

		Route::resource('/catalogo-bienes-insumos', 'FactConfig\CatalogoBienesInsumosController');
		Route::get('/catalogo-bienes-insumos/{id}/delete', 'FactConfig\CatalogoBienesInsumosController@delete');
		Route::get('/catalogo-bienes-insumos/api/service', 'FactConfig\CatalogoBienesInsumosController@apiService');

		Route::resource('/fuente-financiamiento', 'FactConfig\FuenteFinanciamientoController');
		Route::get('/fuente-financiamiento/{id}/delete', 'FactConfig\FuenteFinanciamientoController@delete');
		Route::get('/fuente-financiamiento/api/service', 'FactConfig\FuenteFinanciamientoController@apiService');

		Route::resource('/tipos-cargo', 'FactConfig\TiposCargoController');
		Route::get('/tipos-cargo/{id}/delete', 'FactConfig\TiposCargoController@delete');
		Route::get('/tipos-cargo/api/service', 'FactConfig\TiposCargoController@apiService');

		Route::resource('/tipos-condicion-trabajo', 'FactConfig\TiposCondicionTrabajoController');
		Route::get('/tipos-condicion-trabajo/{id}/delete', 'FactConfig\TiposCondicionTrabajoController@delete');
		Route::get('/tipos-condicion-trabajo/api/service', 'FactConfig\TiposCondicionTrabajoController@apiService');

		Route::resource('/tipos-empleados', 'FactConfig\TiposEmpleadosController');
		Route::get('/tipos-empleados/{id}/delete', 'FactConfig\TiposEmpleadosController@delete');
		Route::get('/tipos-empleados/api/service', 'FactConfig\TiposEmpleadosController@apiService');

		Route::resource('/tipo-tarifa', 'FactConfig\TipoTarifaController');
		Route::get('/tipo-tarifa/{id}/delete', 'FactConfig\TipoTarifaController@delete');
		Route::get('/tipo-tarifa/api/service', 'FactConfig\TipoTarifaController@apiService');

		Route::resource('/tipos-establecimiento', 'FactConfig\TiposEstablecimientoController');
		Route::get('/tipos-establecimiento/{id}/delete', 'FactConfig\TiposEstablecimientoController@delete');
		Route::get('/tipos-establecimiento/api/service', 'FactConfig\TiposEstablecimientoController@apiService');

		Route::resource('/paquetes', 'FactConfig\PaquetesController');
		Route::get('/paquetes/{id}/delete', 'FactConfig\PaquetesController@delete');
		Route::get('/paquetes/api/service', 'FactConfig\PaquetesController@apiService');

		Route::resource('/config-resultados-lab', 'FactConfig\ConfigResultadosLabController');
		Route::get('/config-resultados-lab/{id}/delete', 'FactConfig\ConfigResultadosLabController@delete');
		Route::get('/config-resultados-lab/api/service', 'FactConfig\ConfigResultadosLabController@apiService');


	});

});