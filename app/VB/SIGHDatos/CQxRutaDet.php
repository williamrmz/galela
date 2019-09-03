<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxRutaDet extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idRutaDet AS Int = :idRutaDet
			SET NOCOUNT ON 
			EXEC CQxRutaDetAgregar @idRutaDet OUTPUT, :idOrdenOperatoria, :idCuentaAtencion, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idRutaDet AS idRutaDet";

		$params = [
			'idRutaDet' => 0, 
			'idOrdenOperatoria' => ($oTabla->idOrdenOperatoria == 0)? Null: $oTabla->idOrdenOperatoria, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CQxRutaDetModificar :idRutaDet, :idRuta, :idOrdenOperatoria, :idCuentaAtencion, :fecha, :hora, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idRutaDet' => ($oTabla->idRutaDet == 0)? Null: $oTabla->idRutaDet, 
			'idRuta' => ($oTabla->idRuta == 0)? Null: $oTabla->idRuta, 
			'idOrdenOperatoria' => ($oTabla->idOrdenOperatoria == 0)? Null: $oTabla->idOrdenOperatoria, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'hora' => ($oTabla->hora == "")? Null: $oTabla->hora, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CQxRutaDetEliminar :idRutaDet, :idUsuarioAuditoria";

		$params = [
			'idRutaDet' => $oTabla->idRutaDet, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxRutaDetSeleccionarPorId :idRutaDet";

		$params = [
			'idRutaDet' => $oTabla->idRutaDet, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorOrdenOperatoria($oTabla)
	{
		$query = "
			EXEC CQxRutaDetSelPorOrdenOperatoria :idOrdenOperatoria";

		$params = [
			'idOrdenOperatoria' => $oTabla->idOrdenOperatoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}