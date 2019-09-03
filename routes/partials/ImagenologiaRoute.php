<?php

Route::prefix('imagenologia')->group( function () {

	Route::name('imagenologia.')->group( function () {

		Route::resource('/ingresos', 'Imagenologia\IngresosController');
		Route::get('/ingresos/{id}/delete', 'Imagenologia\IngresosController@delete');
		Route::get('/ingresos/api/service', 'Imagenologia\IngresosController@apiService');

		Route::resource('/salidas', 'Imagenologia\SalidasController');
		Route::get('/salidas/{id}/delete', 'Imagenologia\SalidasController@delete');
		Route::get('/salidas/api/service', 'Imagenologia\SalidasController@apiService');

		Route::resource('/ecografia-general', 'Imagenologia\EcografiaGeneralController');
		Route::get('/ecografia-general/{id}/delete', 'Imagenologia\EcografiaGeneralController@delete');
		Route::get('/ecografia-general/api/service', 'Imagenologia\EcografiaGeneralController@apiService');

		Route::resource('/rayos-x', 'Imagenologia\RayosXController');
		Route::get('/rayos-x/{id}/delete', 'Imagenologia\RayosXController@delete');
		Route::get('/rayos-x/api/service', 'Imagenologia\RayosXController@apiService');

		Route::resource('/tomografia', 'Imagenologia\TomografiaController');
		Route::get('/tomografia/{id}/delete', 'Imagenologia\TomografiaController@delete');
		Route::get('/tomografia/api/service', 'Imagenologia\TomografiaController@apiService');

		Route::resource('/ecografia-obstetrica', 'Imagenologia\EcografiaObstetricaController');
		Route::get('/ecografia-obstetrica/{id}/delete', 'Imagenologia\EcografiaObstetricaController@delete');
		Route::get('/ecografia-obstetrica/api/service', 'Imagenologia\EcografiaObstetricaController@apiService');


	});

});