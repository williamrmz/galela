<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFacturacionServicios extends Model
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
		'idProductoLocal', 
		'fechaAutorizaEXO', 
		'idUsuarioAutorizaEXO', 
		'importeEXO', 
		'importeSIS', 
		'idUsuarioAuditoria', 
		'fechaCreacion', 
		'idProducto', 
		'precioUnitario', 
		'idEstadoFacturacion', 
		'idFuenteFinanciamiento', 
		'idTipoFinanciamiento', 
		'idPartidaPresupuestal', 
		'idCentroCosto', 
		'idServicioInternamiento', 
		'idComprobantePago', 
		'totalPorPagar', 
		'idAtencion', 
		'idFacturacionServicio', 
		'idUsuarioModifica', 
		'idPuntoCarga', 
		'fechaModificacion', 
		'idOrden', 
		'idUsuarioAutorizaSeguro', 
		'idUsuarioAutorizaPendiente', 
		'idUsuarioAutorizaDevolucion', 
		'idCajero', 
		'fechaAutorizaSeguro', 
		'fechaAutorizaPendiente', 
		'fechaAutorizaDevolucion', 
		'fechaCajero', 
		'idComprobantePagoDevolucion', 
		'cantidad', 
		'idUsuarioCrea', 
	];
}