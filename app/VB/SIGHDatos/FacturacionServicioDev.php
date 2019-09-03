<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FacturacionServicioDev extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC FacturacionServicioDevolucionesAgregar :idOrden, :idProducto, :cantidadAdevolver, :idComprobantePago, :idEstadoDevolucion, :fechaAutoriza, :idUsuarioAutoriza, :idUsuarioAuditoria";

		$params = [
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidadAdevolver' => ($oTabla->cantidadAdevolver == 0)? Null: $oTabla->cantidadAdevolver, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idEstadoDevolucion' => ($oTabla->idEstadoDevolucion == 0)? Null: $oTabla->idEstadoDevolucion, 
			'fechaAutoriza' => ($oTabla->fechaAutoriza == 0)? Null: $oTabla->fechaAutoriza, 
			'idUsuarioAutoriza' => ($oTabla->idUsuarioAutoriza == 0)? Null: $oTabla->idUsuarioAutoriza, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FacturacionServicioDevolucionesModificar :idOrden, :idProducto, :cantidadAdevolver, :idComprobantePago, :idEstadoDevolucion, :fechaAutoriza, :idUsuarioAutoriza, :idUsuarioAuditoria";

		$params = [
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidadAdevolver' => ($oTabla->cantidadAdevolver == 0)? Null: $oTabla->cantidadAdevolver, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idEstadoDevolucion' => ($oTabla->idEstadoDevolucion == 0)? Null: $oTabla->idEstadoDevolucion, 
			'fechaAutoriza' => ($oTabla->fechaAutoriza == 0)? Null: $oTabla->fechaAutoriza, 
			'idUsuarioAutoriza' => ($oTabla->idUsuarioAutoriza == 0)? Null: $oTabla->idUsuarioAutoriza, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FacturacionServicioDevolucionesEliminar :idOrden, :idUsuarioAuditoria";

		$params = [
			'idOrden' => $oTabla->idOrden, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FacturacionServicioDevolucionesSeleccionarPorId :idOrden";

		$params = [
			'idOrden' => $oTabla->idOrden, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdOrdenIdProducto($lnIdOrden, $lnIdProducto)
	{
		$query = "
			EXEC FacturacionServicioDevolucionesSeleccionarPorIdOrdenIdProducto :idOrden, :idProducto";

		$params = [
			'idOrden' => $lnIdOrden, 
			'idProducto' => $lnIdProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}