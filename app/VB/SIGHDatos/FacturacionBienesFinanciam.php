<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FacturacionBienesFinanciam extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC FacturacionBienesFinanciamientosAgregar :movNumero, :movTipo, :idProducto, :idTipoFinanciamiento, :idFuenteFinanciamiento, :cantidadFinanciada, :precioFinanciado, :totalFinanciado, :fechaAutoriza, :idUsuarioAutoriza, :idUsuarioAuditoria";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
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
			EXEC FacturacionBienesFinanciamientosModificar :movNumero, :movTipo, :idProducto, :idTipoFinanciamiento, :idFuenteFinanciamiento, :cantidadFinanciada, :precioFinanciado, :totalFinanciado, :fechaAutoriza, :idUsuarioAutoriza, :idEstadoFacturacion, :idUsuarioAuditoria";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
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
			EXEC FacturacionBienesFinanciamientosEliminar :movNumero, :movTipo, :idUsuarioAuditoria";

		$params = [
			'movNumero' => $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FacturacionBienesFinanciamientosSeleccionarPorId :movNumero, :movTipo";

		$params = [
			'movNumero' => $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdProducto($lcMovNumero, $lcMovTipo, $lnIdProducto)
	{
		$query = "
			EXEC FacturacionBienesFinanciamientosSeleccionarPorIdProducto :movNumero, :movTipo, :idProducto";

		$params = [
			'movNumero' => LcMovNumero, 
			'movTipo' => LcMovTipo, 
			'idProducto' => $lnIdProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorTipoFinanciamiento($oTabla)
	{
		$query = "
			EXEC FacturacionBienesFinanciamientosEliminarPorIdTipoFinanciamiento :movNumero, :movTipo, :idTipoFinanciamiento, :idUsuarioAuditoria";

		$params = [
			'movNumero' => $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idTipoFinanciamiento' => $oTabla->idTipoFinanciamiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function ActualizaIdEstadoFacturacion($lcMovNumero, $lcMovTipo, $lnNuevoIdEstadoFacturacion)
	{
		$query = "
			EXEC FacturacionBienesFinanciamientosActualizaIdEstadoFacturacion :lcMovTipo, :lcMovNumero, :lnNuevoIdEstadoFacturacion";

		$params = [
			'lcMovTipo' => LcMovTipo, 
			'lcMovNumero' => LcMovNumero, 
			'lnNuevoIdEstadoFacturacion' => $lnNuevoIdEstadoFacturacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function ActualizaIdEstadoFacturacionPorCuenta($lnIdCuentaAtencion, $lnNuevoIdEstadoFacturacion)
	{
		$query = "
			EXEC FacturacionBienesFinanciamientosActualizaIdEstadoFacturacionPorCuenta :lnIdCuentaAtencion, :lnNuevoIdEstadoFacturacion, :movTipo, :movNumero";

		$params = [
			'lnIdCuentaAtencion' => $lnIdCuentaAtencion, 
			'lnNuevoIdEstadoFacturacion' => $lnNuevoIdEstadoFacturacion, 
			'movTipo' => oRsTmp1->fields!movTipo, 
			'movNumero' => oRsTmp1->fields!movNumero, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}