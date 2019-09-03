<?php

Route::prefix('hospitalizacion')->group( function () {

	Route::name('hospitalizacion.')->group( function () {

		Route::resource('/paciente', 'Hospitalizacion\PacienteController');
		Route::get('/paciente/{id}/delete', 'Hospitalizacion\PacienteController@delete');
		Route::get('/paciente/api/service', 'Hospitalizacion\PacienteController@apiService');

		Route::resource('/admision-hospitalizacion', 'Hospitalizacion\AdmisionHospitalizacionController');
		Route::get('/admision-hospitalizacion/{id}/delete', 'Hospitalizacion\AdmisionHospitalizacionController@delete');
		Route::get('/admision-hospitalizacion/api/service', 'Hospitalizacion\AdmisionHospitalizacionController@apiService');

		Route::resource('/camas-hospitalizacion', 'Hospitalizacion\CamasHospitalizacionController');
		Route::get('/camas-hospitalizacion/{id}/delete', 'Hospitalizacion\CamasHospitalizacionController@delete');
		Route::get('/camas-hospitalizacion/api/service', 'Hospitalizacion\CamasHospitalizacionController@apiService');

		Route::resource('/alojados', 'Hospitalizacion\AlojadosController');
		Route::get('/alojados/{id}/delete', 'Hospitalizacion\AlojadosController@delete');
		Route::get('/alojados/api/service', 'Hospitalizacion\AlojadosController@apiService');

		Route::resource('/recetas', 'Hospitalizacion\RecetasController');
		Route::get('/recetas/{id}/delete', 'Hospitalizacion\RecetasController@delete');
		Route::get('/recetas/api/service', 'Hospitalizacion\RecetasController@apiService');


	});

});