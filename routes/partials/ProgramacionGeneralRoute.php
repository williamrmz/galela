<?php

Route::prefix('programacion-general')->group( function () {

	Route::name('programacion-general.')->group( function ()
    {

		Route::resource('/programacion', 'ProgramacionGeneral\ProgramacionController');
		Route::get('/programacion/{id}/delete', 'ProgramacionGeneral\ProgramacionController@delete');
		Route::get('/programacion/api/service', 'ProgramacionGeneral\ProgramacionController@apiService');

		Route::resource('/turno', 'ProgramacionGeneral\TurnoController');
		Route::get('/turno/{id}/delete', 'ProgramacionGeneral\TurnoController@delete');
		Route::get('/turno/api/service', 'ProgramacionGeneral\TurnoController@apiService');

		Route::resource('/profesionales-salud', 'ProgramacionGeneral\ProfesionalesSaludController');
		Route::get('/profesionales-salud/api/service', 'ProgramacionGeneral\ProfesionalesSaludController@apiService')->name("profesionales-salud.api");

//		Configuración de asignacion de jefes
        Route::resource('/asignacion', 'ProgramacionGeneral\AsignacionProgramacionController');
        Route::get('/asignacion/api/service', 'ProgramacionGeneral\AsignacionProgramacionController@apiService');

	});

});
