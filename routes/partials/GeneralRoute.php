<?php

Route::prefix('general')->group( function () {

	Route::name('general.')->group( function () {

		Route::resource('/servicios', 'General\ServiciosController');
		Route::get('/servicios/{id}/delete', 'General\ServiciosController@delete');
		Route::get('/servicios/api/service', 'General\ServiciosController@apiService');

		Route::resource('/diagnosticos', 'General\DiagnosticosController');
		Route::get('/diagnosticos/{id}/delete', 'General\DiagnosticosController@delete');
		Route::get('/diagnosticos/api/service', 'General\DiagnosticosController@apiService');

		Route::resource('/procedimientos', 'General\ProcedimientosController');
		Route::get('/procedimientos/{id}/delete', 'General\ProcedimientosController@delete');
		Route::get('/procedimientos/api/service', 'General\ProcedimientosController@apiService');

		Route::resource('/establecimientos-no-minsa', 'General\EstablecimientosNoMinsaController');
		Route::get('/establecimientos-no-minsa/{id}/delete', 'General\EstablecimientosNoMinsaController@delete');
		Route::get('/establecimientos-no-minsa/api/service', 'General\EstablecimientosNoMinsaController@apiService');

		Route::resource('/diagnosticos-pdf', 'General\DiagnosticosPdfController');
		Route::get('/diagnosticos-pdf/{id}/delete', 'General\DiagnosticosPdfController@delete');
		Route::get('/diagnosticos-pdf/api/service', 'General\DiagnosticosPdfController@apiService');

		Route::resource('/especialidades', 'General\EspecialidadesController');
		Route::get('/especialidades/{id}/delete', 'General\EspecialidadesController@delete');
		Route::get('/especialidades/api/service', 'General\EspecialidadesController@apiService');

		Route::resource('/establecimientos', 'General\EstablecimientosController');
		Route::get('/establecimientos/{id}/delete', 'General\EstablecimientosController@delete');
		Route::get('/establecimientos/api/service', 'General\EstablecimientosController@apiService');


	});

});