<?php

Route::prefix('seguridad')->group( function () {

	Route::name('seguridad.')->group( function () {

		Route::resource('/empleados', 'Seguridad\EmpleadosController');
		Route::get('/empleados/{id}/delete', 'Seguridad\EmpleadosController@delete');
		Route::get('/empleados/api/service', 'Seguridad\EmpleadosController@apiService');

		Route::resource('/roles', 'Seguridad\RolesController');
		Route::get('/roles/{id}/delete', 'Seguridad\RolesController@delete');
		Route::get('/roles/api/service', 'Seguridad\RolesController@apiService');


	});

});