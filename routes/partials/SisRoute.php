<?php

Route::prefix('sis')->group( function () {

	Route::name('sis.')->group( function () {

		Route::resource('/formato-fua', 'Sis\FormatoFuaController');
		Route::get('/formato-fua/{id}/delete', 'Sis\FormatoFuaController@delete');
		Route::get('/formato-fua/api/service', 'Sis\FormatoFuaController@apiService');


	});

});