<?php

Route::prefix('consulta-externa')->group( function () {

	Route::name('consulta-externa.')->group( function () {

		Route::resource('/paciente', 'ConsultaExterna\PacienteController');
		Route::get('/paciente/{id}/delete', 'ConsultaExterna\PacienteController@delete');
		Route::get('/paciente/api/service', 'ConsultaExterna\PacienteController@apiService');

		Route::resource('/citas-admision', 'ConsultaExterna\CitasAdmisionController');
		Route::get('/citas-admision/{id}/delete', 'ConsultaExterna\CitasAdmisionController@delete');
		Route::get('/citas-admision/api/service', 'ConsultaExterna\CitasAdmisionController@apiService');

		Route::resource('/registro-atenciones', 'ConsultaExterna\RegistroAtencionesController');
		Route::get('/registro-atenciones/{id}/delete', 'ConsultaExterna\RegistroAtencionesController@delete');
		Route::get('/registro-atenciones/api/service', 'ConsultaExterna\RegistroAtencionesController@apiService');

		Route::resource('/registro-triaje', 'ConsultaExterna\RegistroTriajeController');
		Route::get('/registro-triaje/{id}/delete', 'ConsultaExterna\RegistroTriajeController@delete');
		Route::get('/registro-triaje/api/service', 'ConsultaExterna\RegistroTriajeController@apiService');


	});

});