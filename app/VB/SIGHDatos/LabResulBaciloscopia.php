<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class LabResulBaciloscopia extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idLabResultadoBaciloscopia AS Int = :idLabResultadoBaciloscopia
			SET NOCOUNT ON 
			EXEC LabResultadoBaciloscopiaAgregar @idLabResultadoBaciloscopia OUTPUT, :fecha, :idCuentaAtencion, :idSolicitudBaciloscopia, :procedimiento, :nroRegistroLab, :aspectoMacro, :negativoAnotar, :nBAARColonias, :positivoAnotar, :fechaEntrega, :observacion, :usuarioRegistraPrueba, :idUsuario
			SELECT @idLabResultadoBaciloscopia AS idLabResultadoBaciloscopia";

		$params = [
			'idLabResultadoBaciloscopia' => 0, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idSolicitudBaciloscopia' => ($oTabla->idSolicitudBaciloscopia == 0)? Null: $oTabla->idSolicitudBaciloscopia, 
			'procedimiento' => ($oTabla->procedimiento == "")? Null: $oTabla->procedimiento, 
			'nroRegistroLab' => ($oTabla->nroRegistroLab == "")? Null: $oTabla->nroRegistroLab, 
			'aspectoMacro' => ($oTabla->aspectoMacro == "")? Null: $oTabla->aspectoMacro, 
			'negativoAnotar' => ($oTabla->negativoAnotar == "")? Null: $oTabla->negativoAnotar, 
			'nBAARColonias' => ($oTabla->nBAARColonias == "")? Null: $oTabla->nBAARColonias, 
			'positivoAnotar' => ($oTabla->positivoAnotar == "")? Null: $oTabla->positivoAnotar, 
			'fechaEntrega' => $oTabla->fechaEntrega, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'usuarioRegistraPrueba' => ($oTabla->usuarioRegistraPrueba == 0)? Null: $oTabla->usuarioRegistraPrueba, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC LabResultadoBaciloscopiaModificar :idLabResultadoBaciloscopia, :fecha, :idCuentaAtencion, :procedimiento, :nroRegistroLab, :aspectoMacro, :negativoAnotar, :nBAARColonias, :positivoAnotar, :fechaEntrega, :observacion, :idUsuario";

		$params = [
			'idLabResultadoBaciloscopia' => ($oTabla->idLabResultadoBaciloscopia == 0)? Null: $oTabla->idLabResultadoBaciloscopia, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'procedimiento' => ($oTabla->procedimiento == "")? Null: $oTabla->procedimiento, 
			'nroRegistroLab' => ($oTabla->nroRegistroLab == "")? Null: $oTabla->nroRegistroLab, 
			'aspectoMacro' => ($oTabla->aspectoMacro == "")? Null: $oTabla->aspectoMacro, 
			'negativoAnotar' => ($oTabla->negativoAnotar == "")? Null: $oTabla->negativoAnotar, 
			'nBAARColonias' => ($oTabla->nBAARColonias == "")? Null: $oTabla->nBAARColonias, 
			'positivoAnotar' => ($oTabla->positivoAnotar == "")? Null: $oTabla->positivoAnotar, 
			'fechaEntrega' => $oTabla->fechaEntrega, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC LabResultadoBaciloscopiaEliminar :idLabResultadoBaciloscopia, :idUsuarioAuditoria";

		$params = [
			'idLabResultadoBaciloscopia' => $oTabla->idLabResultadoBaciloscopia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($lIdCuentaAtencion)
	{
		$query = "
			EXEC ListarREsultadoBaciloscopiaxIdCuentaAtencion :idcuentaAtencion";

		$params = [
			'idcuentaAtencion' => $lIdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}