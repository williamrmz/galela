<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxOrdenOperatoriaCPT extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idOrdenOperatoriaCPT AS Int = :idOrdenOperatoriaCPT
			SET NOCOUNT ON 
			EXEC CQxOrdenOperatoriaCPTAgregar @idOrdenOperatoriaCPT OUTPUT, :idOrdenOperatoria, :idProducto, :idUsuario, :estacion, :idUsuarioAuditoria
			SELECT @idOrdenOperatoriaCPT AS idOrdenOperatoriaCPT";

		$params = [
			'idOrdenOperatoriaCPT' => 0, 
			'idOrdenOperatoria' => ($oTabla->idOrdenOperatoria == 0)? 0: $oTabla->idOrdenOperatoria, 
			'idProducto' => ($oTabla->idProducto == 0)? 0: $oTabla->idProducto, 
			'idUsuario' => ($oTabla->idUsuario == 0)? 0: $oTabla->idUsuario, 
			'estacion' => ($oTabla->estacion == "")? "": $oTabla->estacion), 
			'idUsuarioAuditoria' => ($oTabla->idUsuarioAuditoria == 0)? 0: $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function InsertarMod($oTabla)
	{
		$query = "
			DECLARE @idOrdenOperatoriaCPT AS Int = :idOrdenOperatoriaCPT
			SET NOCOUNT ON 
			EXEC CQxOrdenOperatoriaCPTMod @idOrdenOperatoriaCPT OUTPUT, :idOrdenOperatoria, :idProducto, :idUsuario, :estacion, :idUsuarioAuditoria
			SELECT @idOrdenOperatoriaCPT AS idOrdenOperatoriaCPT";

		$params = [
			'idOrdenOperatoriaCPT' => 0, 
			'idOrdenOperatoria' => ($oTabla->idOrdenOperatoria == 0)? 0: $oTabla->idOrdenOperatoria, 
			'idProducto' => ($oTabla->idProducto == 0)? 0: $oTabla->idProducto, 
			'idUsuario' => ($oTabla->idUsuario == 0)? 0: $oTabla->idUsuario, 
			'estacion' => ($oTabla->estacion == "")? "": $oTabla->estacion), 
			'idUsuarioAuditoria' => ($oTabla->idUsuarioAuditoria == 0)? 0: $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CQxOrdenOperatoriaCPTModificar :idOrdenOperatoriaCPT, :idOrdenOperatoria, :idProducto, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idOrdenOperatoriaCPT' => ($oTabla->idOrdenOperatoriaCPT == 0)? Null: $oTabla->idOrdenOperatoriaCPT, 
			'idOrdenOperatoria' => ($oTabla->idOrdenOperatoria == 0)? Null: $oTabla->idOrdenOperatoria, 
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
			EXEC CQxOrdenOperatoriaCPTEliminar :idOrdenOperatoriaCPT, :idUsuarioAuditoria";

		$params = [
			'idOrdenOperatoriaCPT' => $oTabla->idOrdenOperatoriaCPT, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function EliminarCPT($oTabla)
	{
		$query = "
			EXEC CQxOrdenOperatoriaCPTEliminar :idOrdenOperatoria";

		$params = [
			'idOrdenOperatoria' => ($oTabla->idOrdenOperatoria == 0)? Null: $oTabla->idOrdenOperatoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function EliminarCPTMQ($oTabla)
	{
		$query = "
			EXEC CQxOrdenOperatoriaCPTMQEliminar :idOrdenOperatoriaMQ";

		$params = [
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxOrdenOperatoriaCPTSeleccionarPorId :idOrdenOperatoriaCPT";

		$params = [
			'idOrdenOperatoriaCPT' => $oTabla->idOrdenOperatoriaCPT, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}