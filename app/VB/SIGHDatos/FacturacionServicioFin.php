<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FacturacionServicioFin extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC FacturacionServicioFinanciamientosAgregar :idOrden, :idProducto, :idTipoFinanciamiento, :idFuenteFinanciamiento, :cantidadFinanciada, :precioFinanciado, :totalFinanciado, :fechaAutoriza, :idUsuarioAutoriza, :idUsuarioAuditoria";

		$params = [
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idFuenteFinanciamiento' => $oTabla->idFuenteFinanciamiento, 
			'cantidadFinanciada' => $oTabla->cantidadFinanciada, 
			'precioFinanciado' => $oTabla->precioFinanciado, 
			'totalFinanciado' => $oTabla->totalFinanciado, 
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
			EXEC FacturacionServicioFinanciamientosModificar :idOrden, :idProducto, :idTipoFinanciamiento, :idFuenteFinanciamiento, :cantidadFinanciada, :precioFinanciado, :totalFinanciado, :fechaAutoriza, :idUsuarioAutoriza, :idEstadoFacturacion, :idUsuarioAuditoria";

		$params = [
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idFuenteFinanciamiento' => $oTabla->idFuenteFinanciamiento, 
			'cantidadFinanciada' => $oTabla->cantidadFinanciada, 
			'precioFinanciado' => $oTabla->precioFinanciado, 
			'totalFinanciado' => $oTabla->totalFinanciado, 
			'fechaAutoriza' => ($oTabla->fechaAutoriza == 0)? Null: $oTabla->fechaAutoriza, 
			'idUsuarioAutoriza' => ($oTabla->idUsuarioAutoriza == 0)? Null: $oTabla->idUsuarioAutoriza, 
			'idEstadoFacturacion' => $oTabla->idEstadoFacturacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FacturacionServicioFinanciamientosEliminar :idOrden, :idUsuarioAuditoria";

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
			EXEC FacturacionServicioFinanciamientosSeleccionarPorId :idOrden";

		$params = [
			'idOrden' => $oTabla->idOrden, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdOrdenIdProducto($lnIdProducto)
	{
		$query = "
			EXEC FacturacionServicioFinanciamientosSeleccionarPorIdOrdenIdProducto :idOrden, :idProducto";

		$params = [
			'idOrden' => lnIdOrden, 
			'idProducto' => $lnIdProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorIdTipoFinanciamiento($oTabla)
	{
		$query = "
			EXEC FacturacionServicioFinanciamientosEliminarPorIdTipoFinanciamiento :idOrden, :idTipoFinanciamiento, :idUsuarioAuditoria";

		$params = [
			'idOrden' => $oTabla->idOrden, 
			'idTipoFinanciamiento' => $oTabla->idTipoFinanciamiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function ActualizaIdEstadoFacturacion($lnIdOrden, $lnNuevoIdEstadoFacturacion)
	{
		$query = "
			EXEC FacturacionServicioFinanciamientosActualizaIdEstadoFacturacion :lnNuevoIdEstadoFacturacion, :lnIdOrden";

		$params = [
			'lnNuevoIdEstadoFacturacion' => $lnNuevoIdEstadoFacturacion, 
			'lnIdOrden' => $lnIdOrden, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function ActualizaIdEstadoFacturacionPorCuenta($lnIdCuentaAtencion, $lcSoloActualizarIdEstadoFacturacion, $lnNuevoIdEstadoFacturacion)
	{
		$query = "
			EXEC FactOrdenServicioXidCuentaAtencion :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $lnIdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizaIdEstadoFacturacionXidOrden($lnIdOrden, $lnIdEstadoFacturacion)
	{
		$query = "
			EXEC FacturacionServicioFinanciamientosActualizaIdEstadoFact :idOrden, :idEstadoFacturacion";

		$params = [
			'idOrden' => $lnIdOrden, 
			'idEstadoFacturacion' => $lnIdEstadoFacturacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}