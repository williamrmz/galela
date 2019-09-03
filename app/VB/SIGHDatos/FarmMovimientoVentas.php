<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FarmMovimientoVentas extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC farmMovimientoVentasAgregar :movNumero, :movTipo, :tipoVenta, :idPreVenta, :idTipoFinanciamiento, :idPrescriptor, :idTipoReceta, :idDiagnostico, :idCuentaAtencion, :idServicioPaciente, :idFuenteFinanciamiento, :idPaciente, :fechaHoraPrescribe, :idPaquete, :idUsuarioAuditoria, :idreceta";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'tipoVenta' => ($oTabla->tipoVenta == "")? Null: $oTabla->tipoVenta, 
			'idPreVenta' => ($oTabla->idPreventa == 0)? Null: $oTabla->idPreventa, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idPrescriptor' => ($oTabla->idPrescriptor == 0)? Null: $oTabla->idPrescriptor, 
			'idTipoReceta' => $oTabla->idTipoReceta, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioPaciente' => ($oTabla->idServicioPaciente == 0)? Null: $oTabla->idServicioPaciente, 
			'idFuenteFinanciamiento' => $oTabla->idFuenteFinanciamiento, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'fechaHoraPrescribe' => ($oTabla->fechaHoraPrescribe == 0)? Null: $oTabla->fechaHoraPrescribe, 
			'idPaquete' => ($oTabla->idPaquete == 0)? 0: $oTabla->idPaquete, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idreceta' => ($oTabla->idReceta == 0)? 0: $oTabla->idReceta, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC farmMovimientoVentasModificar :movNumero, :movTipo, :tipoVenta, :idPreVenta, :idTipoFinanciamiento, :idPrescriptor, :idTipoReceta, :idDiagnostico, :idCuentaAtencion, :idServicioPaciente, :idFuenteFinanciamiento, :idPaciente, :fechaHoraPrescribe, :idPaquete, :idUsuarioAuditoria, :idreceta";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'tipoVenta' => ($oTabla->tipoVenta == "")? Null: $oTabla->tipoVenta, 
			'idPreVenta' => ($oTabla->idPreventa == 0)? Null: $oTabla->idPreventa, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idPrescriptor' => ($oTabla->idPrescriptor == 0)? Null: $oTabla->idPrescriptor, 
			'idTipoReceta' => $oTabla->idTipoReceta, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioPaciente' => ($oTabla->idServicioPaciente == 0)? Null: $oTabla->idServicioPaciente, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'fechaHoraPrescribe' => ($oTabla->fechaHoraPrescribe == 0)? Null: $oTabla->fechaHoraPrescribe, 
			'idPaquete' => ($oTabla->idPaquete == 0)? 0: $oTabla->idPaquete, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idreceta' => ($oTabla->idReceta == 0)? 0: $oTabla->idReceta, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC farmMovimientoVentasEliminar :movNumero, :movTipo, :idUsuarioAuditoria";

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
			EXEC farmMovimientoVentasSeleccionarPorId :movNumero, :movTipo";

		$params = [
			'movNumero' => $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCuentaAtencion($lnIdCuentaAtencion)
	{
		$query = "
			EXEC FarmMovimientoVentasDetalleSeleccionarPorCuenta :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $lnIdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}