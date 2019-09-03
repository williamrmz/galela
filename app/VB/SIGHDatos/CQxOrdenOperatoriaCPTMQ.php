<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxOrdenOperatoriaCPTMQ extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idOrdenOperatoriaCPTMQ AS Int = :idOrdenOperatoriaCPTMQ
			SET NOCOUNT ON 
			EXEC CQxOrdenOperatoriaCPTMQAgregar @idOrdenOperatoriaCPTMQ OUTPUT, :idOrdenOperatoriaMQ, :idProducto, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idOrdenOperatoriaCPTMQ AS idOrdenOperatoriaCPTMQ";

		$params = [
			'idOrdenOperatoriaCPTMQ' => 0, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
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
			EXEC CQxOrdenOperatoriaCPTMQModificar :idOrdenOperatoriaCPTMQ, :idOrdenOperatoriaMQ, :idProducto, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idOrdenOperatoriaCPTMQ' => ($oTabla->idOrdenOperatoriaCPTMQ == 0)? Null: $oTabla->idOrdenOperatoriaCPTMQ, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
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
			EXEC CQxOrdenOperatoriaCPTMQEliminar :idOrdenOperatoriaMQ";

		$params = [
			'idOrdenOperatoriaMQ' => $oTabla->idOrdenOperatoriaMQ, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxOrdenOperatoriaCPTMQSeleccionarPorId :idOrdenOperatoriaCPTMQ";

		$params = [
			'idOrdenOperatoriaCPTMQ' => $oTabla->idOrdenOperatoriaCPTMQ, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function InsertarPostOperat($oTabla)
	{
		$query = "
			DECLARE @idOrdenOperatoriaCPTMQ AS Int = :idOrdenOperatoriaCPTMQ
			SET NOCOUNT ON 
			EXEC CQxOrdenOperatoriaCPTMQPOAgregar @idOrdenOperatoriaCPTMQ OUTPUT, :idOrdenOperatoriaMQ, :idProducto, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idOrdenOperatoriaCPTMQ AS idOrdenOperatoriaCPTMQ";

		$params = [
			'idOrdenOperatoriaCPTMQ' => 0, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function EliminarPostOpe($oTabla)
	{
		$query = "
			EXEC CQxOrdenOperatoriaCPTMQPOEliminar :idOrdenOperatoriaMQ";

		$params = [
			'idOrdenOperatoriaMQ' => $oTabla->idOrdenOperatoriaMQ, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}