<?php

Route::prefix('archivo-clinico')->group( function () {

	Route::name('archivo-clinico.')->group( function () {

		Route::resource('/historia-clinica', 'ArchivoClinico\HistoriaClinicaController');
		Route::get('/historia-clinica/{id}/delete', 'ArchivoClinico\HistoriaClinicaController@delete');
		Route::get('/historia-clinica/api/service', 'ArchivoClinico\HistoriaClinicaController@apiService');

		Route::resource('/movimientos-historias', 'ArchivoClinico\MovimientosHistoriasController');
		Route::get('/movimientos-historias/{id}/delete', 'ArchivoClinico\MovimientosHistoriasController@delete');
		Route::get('/movimientos-historias/api/service', 'ArchivoClinico\MovimientosHistoriasController@apiService');

		Route::resource('/solicitud-historias', 'ArchivoClinico\SolicitudHistoriasController');
		Route::get('/solicitud-historias/{id}/delete', 'ArchivoClinico\SolicitudHistoriasController@delete');
		Route::get('/solicitud-historias/api/service', 'ArchivoClinico\SolicitudHistoriasController@apiService');

		Route::resource('/archiveros', 'ArchivoClinico\ArchiverosController');
		Route::get('/archiveros/{id}/delete', 'ArchivoClinico\ArchiverosController@delete');
		Route::get('/archiveros/api/service', 'ArchivoClinico\ArchiverosController@apiService');

		Route::resource('/movimiento-formato-hc', 'ArchivoClinico\MovimientoFormatoHcController');
		Route::get('/movimiento-formato-hc/{id}/delete', 'ArchivoClinico\MovimientoFormatoHcController@delete');
		Route::get('/movimiento-formato-hc/api/service', 'ArchivoClinico\MovimientoFormatoHcController@apiService');


	});

});