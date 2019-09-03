<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FarmPreVenta extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPreventa AS Int = :idPreventa
			SET NOCOUNT ON 
			EXEC farmPreVentaAgregar @idPreventa OUTPUT, :idAlmacen, :idVendedor, :idPaciente, :idTipoFinanciamiento, :total, :idDiagnostico, :idTipoReceta, :idCuentaAtencion, :idPrescriptor, :fechaCreacion, :horaCreacion, :idUsuario, :fechaModificacion, :idUsuarioModifica, :idEstadoPreventa, :fechaHoraPrescribe, :idUsuarioAuditoria
			SELECT @idPreventa AS idPreventa";

		$params = [
			'idPreventa' => 0, 
			'idAlmacen' => ($oTabla->idAlmacen == 0)? Null: $oTabla->idAlmacen, 
			'idVendedor' => ($oTabla->idVendedor == 0)? Null: $oTabla->idVendedor, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'total' => $oTabla->total, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idTipoReceta' => $oTabla->idTipoReceta, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idPrescriptor' => ($oTabla->idPrescriptor == 0)? Null: $oTabla->idPrescriptor, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'horaCreacion' => ($oTabla->horaCreacion == "")? Null: $oTabla->horaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'fechaModificacion' => ($oTabla->fechaModificacion == 0)? Null: $oTabla->fechaModificacion, 
			'idUsuarioModifica' => ($oTabla->idUsuarioModifica == 0)? Null: $oTabla->idUsuarioModifica, 
			'idEstadoPreventa' => $oTabla->idEstadoPreventa, 
			'fechaHoraPrescribe' => ($oTabla->fechaHoraPrescribe == 0)? Null: $oTabla->fechaHoraPrescribe, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC farmPreVentaModificar :idPreventa, :idAlmacen, :idVendedor, :idPaciente, :idTipoFinanciamiento, :total, :idDiagnostico, :idTipoReceta, :idCuentaAtencion, :idPrescriptor, :fechaCreacion, :horaCreacion, :idUsuario, :fechaModificacion, :idUsuarioModifica, :idEstadoPreventa, :fechaHoraPrescribe, :idUsuarioAuditoria";

		$params = [
			'idPreventa' => ($oTabla->idPreventa == 0)? Null: $oTabla->idPreventa, 
			'idAlmacen' => ($oTabla->idAlmacen == 0)? Null: $oTabla->idAlmacen, 
			'idVendedor' => ($oTabla->idVendedor == 0)? Null: $oTabla->idVendedor, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'total' => $oTabla->total, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idTipoReceta' => $oTabla->idTipoReceta, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idPrescriptor' => ($oTabla->idPrescriptor == 0)? Null: $oTabla->idPrescriptor, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'horaCreacion' => ($oTabla->horaCreacion == "")? Null: $oTabla->horaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'fechaModificacion' => ($oTabla->fechaModificacion == 0)? Null: $oTabla->fechaModificacion, 
			'idUsuarioModifica' => ($oTabla->idUsuarioModifica == 0)? Null: $oTabla->idUsuarioModifica, 
			'idEstadoPreventa' => $oTabla->idEstadoPreventa, 
			'fechaHoraPrescribe' => ($oTabla->fechaHoraPrescribe == 0)? Null: $oTabla->fechaHoraPrescribe, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC farmPreVentaEliminar :idPreventa, :idUsuarioAuditoria";

		$params = [
			'idPreventa' => $oTabla->idPreventa, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC farmPreVentaSeleccionarPorId :idPreventa";

		$params = [
			'idPreventa' => $oTabla->idPreventa, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}