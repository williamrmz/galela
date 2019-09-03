<?php

Route::prefix('laboratorio')->group( function () {

	Route::name('laboratorio.')->group( function () {

		Route::resource('/pat-clinica', 'Laboratorio\PatClinicaController');
		Route::get('/pat-clinica/{id}/delete', 'Laboratorio\PatClinicaController@delete');
		Route::get('/pat-clinica/api/service', 'Laboratorio\PatClinicaController@apiService');

		Route::resource('/ingreso-insumos', 'Laboratorio\IngresoInsumosController');
		Route::get('/ingreso-insumos/{id}/delete', 'Laboratorio\IngresoInsumosController@delete');
		Route::get('/ingreso-insumos/api/service', 'Laboratorio\IngresoInsumosController@apiService');

		Route::resource('/salida-insumos', 'Laboratorio\SalidaInsumosController');
		Route::get('/salida-insumos/{id}/delete', 'Laboratorio\SalidaInsumosController@delete');
		Route::get('/salida-insumos/api/service', 'Laboratorio\SalidaInsumosController@apiService');

		Route::resource('/anat-patologica', 'Laboratorio\AnatPatologicaController');
		Route::get('/anat-patologica/{id}/delete', 'Laboratorio\AnatPatologicaController@delete');
		Route::get('/anat-patologica/api/service', 'Laboratorio\AnatPatologicaController@apiService');

		Route::resource('/banco-sangre', 'Laboratorio\BancoSangreController');
		Route::get('/banco-sangre/{id}/delete', 'Laboratorio\BancoSangreController@delete');
		Route::get('/banco-sangre/api/service', 'Laboratorio\BancoSangreController@apiService');


	});

});