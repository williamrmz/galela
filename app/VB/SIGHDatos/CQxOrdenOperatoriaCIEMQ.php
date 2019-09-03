<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxOrdenOperatoriaCIEMQ extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idOrdenOperatoriaCIEMQ AS Int = :idOrdenOperatoriaCIEMQ
			SET NOCOUNT ON 
			EXEC CQxOrdenOperatoriaCIEMQAgregar @idOrdenOperatoriaCIEMQ OUTPUT, :idOrdenOperatoriaMQ, :idDiagnostico, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idOrdenOperatoriaCIEMQ AS idOrdenOperatoriaCIEMQ";

		$params = [
			'idOrdenOperatoriaCIEMQ' => 0, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
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
			EXEC CQxOrdenOperatoriaCIEMQModificar :idOrdenOperatoriaCIEMQ, :idOrdenOperatoriaMQ, :idDiagnostico, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idOrdenOperatoriaCIEMQ' => ($oTabla->idOrdenOperatoriaCIEMQ == 0)? Null: $oTabla->idOrdenOperatoriaCIEMQ, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
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
			EXEC CQxOrdenOperatoriaCIEMQEliminar :idOrdenOperatoriaMQ";

		$params = [
			'idOrdenOperatoriaMQ' => $oTabla->idOrdenOperatoriaMQ, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxOrdenOperatoriaCIEMQSeleccionarPorId :idOrdenOperatoriaCIEMQ";

		$params = [
			'idOrdenOperatoriaCIEMQ' => $oTabla->idOrdenOperatoriaCIEMQ, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}