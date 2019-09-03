<?php

Route::prefix('facturacion')->group( function () {

	Route::name('facturacion.')->group( function () {

		Route::resource('/consumo-servicio', 'Facturacion\ConsumoServicioController');
		Route::get('/consumo-servicio/{id}/delete', 'Facturacion\ConsumoServicioController@delete');
		Route::get('/consumo-servicio/api/service', 'Facturacion\ConsumoServicioController@apiService');

		Route::resource('/laboratorio', 'Facturacion\LaboratorioController');
		Route::get('/laboratorio/{id}/delete', 'Facturacion\LaboratorioController@delete');
		Route::get('/laboratorio/api/service', 'Facturacion\LaboratorioController@apiService');

		Route::resource('/imagenologia', 'Facturacion\ImagenologiaController');
		Route::get('/imagenologia/{id}/delete', 'Facturacion\ImagenologiaController@delete');
		Route::get('/imagenologia/api/service', 'Facturacion\ImagenologiaController@apiService');

		Route::resource('/anatomia-patologica', 'Facturacion\AnatomiaPatologicaController');
		Route::get('/anatomia-patologica/{id}/delete', 'Facturacion\AnatomiaPatologicaController@delete');
		Route::get('/anatomia-patologica/api/service', 'Facturacion\AnatomiaPatologicaController@apiService');

		Route::resource('/farmacia', 'Facturacion\FarmaciaController');
		Route::get('/farmacia/{id}/delete', 'Facturacion\FarmaciaController@delete');
		Route::get('/farmacia/api/service', 'Facturacion\FarmaciaController@apiService');

		Route::resource('/sala-operaciones', 'Facturacion\SalaOperacionesController');
		Route::get('/sala-operaciones/{id}/delete', 'Facturacion\SalaOperacionesController@delete');
		Route::get('/sala-operaciones/api/service', 'Facturacion\SalaOperacionesController@apiService');

		Route::resource('/estado-cuenta', 'Facturacion\EstadoCuentaController');
		Route::get('/estado-cuenta/{id}/delete', 'Facturacion\EstadoCuentaController@delete');
		Route::get('/estado-cuenta/api/service', 'Facturacion\EstadoCuentaController@apiService');

		Route::resource('/reembolsos', 'Facturacion\ReembolsosController');
		Route::get('/reembolsos/{id}/delete', 'Facturacion\ReembolsosController@delete');
		Route::get('/reembolsos/api/service', 'Facturacion\ReembolsosController@apiService');

		Route::resource('/pacientes-externos-seguro', 'Facturacion\PacientesExternosSeguroController');
		Route::get('/pacientes-externos-seguro/{id}/delete', 'Facturacion\PacientesExternosSeguroController@delete');
		Route::get('/pacientes-externos-seguro/api/service', 'Facturacion\PacientesExternosSeguroController@apiService');

		Route::resource('/pacientes-externos-particular', 'Facturacion\PacientesExternosParticularController');
		Route::get('/pacientes-externos-particular/{id}/delete', 'Facturacion\PacientesExternosParticularController@delete');
		Route::get('/pacientes-externos-particular/api/service', 'Facturacion\PacientesExternosParticularController@apiService');


	});

});