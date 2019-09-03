<?php

Route::prefix('seguimiento')->group( function () {

	Route::name('seguimiento.')->group( function () {

		Route::resource('/hc-electronica', 'Seguimiento\HcElectronicaController');
		Route::get('/hc-electronica/{id}/delete', 'Seguimiento\HcElectronicaController@delete');
		Route::get('/hc-electronica/api/service', 'Seguimiento\HcElectronicaController@apiService');

		Route::resource('/programas', 'Seguimiento\ProgramasController');
		Route::get('/programas/{id}/delete', 'Seguimiento\ProgramasController@delete');
		Route::get('/programas/api/service', 'Seguimiento\ProgramasController@apiService');

		Route::resource('/adscripcion', 'Seguimiento\AdscripcionController');
		Route::get('/adscripcion/{id}/delete', 'Seguimiento\AdscripcionController@delete');
		Route::get('/adscripcion/api/service', 'Seguimiento\AdscripcionController@apiService');


	});

});