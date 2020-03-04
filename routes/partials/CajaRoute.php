<?php

Route::prefix('caja')->group( function () {

	Route::name('caja.')->group( function () {

		Route::resource('/gestion-caja', 'Caja\GestionCajaController');
		Route::get('/gestion-caja/{id}/delete', 'Caja\GestionCajaController@delete');
		Route::get('/gestion-caja/api/service', 'Caja\GestionCajaController@apiService');

		Route::resource('/cajas', 'Caja\CajasController');
		Route::get('/cajas/{id}/edit', 'Caja\CajasController@edit');
		Route::get('/cajas/{id}/delete', 'Caja\CajasController@delete');
		Route::get('/cajas/api/service', 'Caja\CajasController@apiService');


	});

});