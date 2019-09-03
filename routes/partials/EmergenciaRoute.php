<?php

Route::prefix('emergencia')->group( function () {

	Route::name('emergencia.')->group( function () {

		Route::resource('/paciente', 'Emergencia\PacienteController');
		Route::get('/paciente/{id}/delete', 'Emergencia\PacienteController@delete');
		Route::get('/paciente/api/service', 'Emergencia\PacienteController@apiService');

		Route::resource('/admision-emergencia', 'Emergencia\AdmisionEmergenciaController');
		Route::get('/admision-emergencia/{id}/delete', 'Emergencia\AdmisionEmergenciaController@delete');
		Route::get('/admision-emergencia/api/service', 'Emergencia\AdmisionEmergenciaController@apiService');

		Route::resource('/camas-observacion', 'Emergencia\CamasObservacionController');
		Route::get('/camas-observacion/{id}/delete', 'Emergencia\CamasObservacionController@delete');
		Route::get('/camas-observacion/api/service', 'Emergencia\CamasObservacionController@apiService');

		Route::resource('/recetas', 'Emergencia\RecetasController');
		Route::get('/recetas/{id}/delete', 'Emergencia\RecetasController@delete');
		Route::get('/recetas/api/service', 'Emergencia\RecetasController@apiService');


	});

});