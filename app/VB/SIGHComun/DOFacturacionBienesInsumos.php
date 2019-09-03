<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFacturacionBienesInsumos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'importeConv', 
		'precConv', 
		'cantidadConv', 
		'fechaAutorizaConv', 
		'cantidadDev', 
		'cantidadSIS', 
		'cantidadSOAT', 
		'cantidadPagar', 
		'precioSIS', 
		'precioSOAT', 
		'totalPagar', 
		'importeSOAT', 
		'fechaAutorizaEXO', 
		'idUsuarioAutorizaEXO', 
		'importeEXO', 
		'importeSIS', 
		'idUsuarioAuditoria', 
		'idUsuarioAutorizaPendiente', 
		'idProducto', 
		'precioUnitario', 
		'cantidad', 
		'idEstadoFacturacion', 
		'idPartidaPresupuestal', 
		'idCentroCosto', 
		'idTipoFinanciamiento', 
		'idFuenteFinanciamiento', 
		'totalPorPagar', 
		'idReceta', 
		'idComprobantePago', 
		'idFacturacionBienes', 
		'idUsuarioAutorizaSeguro', 
		'idOrden', 
		'idUsuarioAutorizaDevolucion', 
		'idCajero', 
		'fechaAutorizaSeguro', 
		'fechaAutorizaPendiente', 
		'fechaAutorizaDevolucion', 
		'fechaCajero', 
		'idComprobantePagoDevolucion', 
		'idPuntoCarga', 
		'fechaCreacion', 
		'fechaModificacion', 
		'idUsuarioCrea', 
		'idUsuarioModifica', 
		'idAtencion', 
	];
}