<?php

Route::prefix('his')->group( function () {

	Route::name('his.')->group( function () {

		Route::resource('/registro-his-microred', 'His\RegistroHisMicroredController');
		Route::get('/registro-his-microred/{id}/delete', 'His\RegistroHisMicroredController@delete');
		Route::get('/registro-his-microred/api/service', 'His\RegistroHisMicroredController@apiService');

		Route::resource('/programacion-medica-microred', 'His\ProgramacionMedicaMicroredController');
		Route::get('/programacion-medica-microred/{id}/delete', 'His\ProgramacionMedicaMicroredController@delete');
		Route::get('/programacion-medica-microred/api/service', 'His\ProgramacionMedicaMicroredController@apiService');

		Route::resource('/lotes-his', 'His\LotesHisController');
		Route::get('/lotes-his/{id}/delete', 'His\LotesHisController@delete');
		Route::get('/lotes-his/api/service', 'His\LotesHisController@apiService');

		Route::resource('/establecimientos-microred', 'His\EstablecimientosMicroredController');
		Route::get('/establecimientos-microred/{id}/delete', 'His\EstablecimientosMicroredController@delete');
		Route::get('/establecimientos-microred/api/service', 'His\EstablecimientosMicroredController@apiService');

		Route::resource('/calidad', 'His\CalidadController');
		Route::get('/calidad/{id}/delete', 'His\CalidadController@delete');
		Route::get('/calidad/api/service', 'His\CalidadController@apiService');

		Route::resource('/padron-nominal', 'His\PadronNominalController');
		Route::get('/padron-nominal/{id}/delete', 'His\PadronNominalController@delete');
		Route::get('/padron-nominal/api/service', 'His\PadronNominalController@apiService');


	});

});