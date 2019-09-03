<?php

Route::prefix('estadistica')->group( function () {

	Route::name('estadistica.')->group( function () {

		Route::resource('/constancias', 'Estadistica\ConstanciasController');
		Route::get('/constancias/{id}/delete', 'Estadistica\ConstanciasController@delete');
		Route::get('/constancias/api/service', 'Estadistica\ConstanciasController@apiService');


	});

});