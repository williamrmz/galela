<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CPTResultados extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idCPTdResultado AS Int = :idCPTdResultado
			SET NOCOUNT ON 
			EXEC CPTResultadosAgregar @idCPTdResultado OUTPUT, :idOrden, :idProducto, :idCuentaAtencion, :resultados, :observaciones, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idCPTdResultado AS idCPTdResultado";

		$params = [
			'idCPTdResultado' => 0, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'resultados' => ($oTabla->resultados == "")? Null: $oTabla->resultados, 
			'observaciones' => ($oTabla->observaciones == "")? Null: $oTabla->observaciones, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => ($oTabla->estacion == "")? Null: $oTabla->estacion, 
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
			EXEC CPTResultadosModificar :idCPTdResultado, :idOrden, :idProducto, :idCuentaAtencion, :resultados, :observaciones, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idCPTdResultado' => ($oTabla->idCPTdResultado == 0)? Null: $oTabla->idCPTdResultado, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'resultados' => ($oTabla->resultados == "")? Null: $oTabla->resultados, 
			'observaciones' => ($oTabla->observaciones == "")? Null: $oTabla->observaciones, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => ($oTabla->estacion == "")? Null: $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CPTResultadosEliminar :idCPTdResultado, :idUsuarioAuditoria";

		$params = [
			'idCPTdResultado' => $oTabla->idCPTdResultado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CPTResultadosSeleccionarPorId :idCPTdResultado";

		$params = [
			'idCPTdResultado' => $oTabla->idCPTdResultado, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarResultados($oTabla)
	{
		$query = "
			EXEC CptResultadosListar :idCuentaAntencion, :idOrden, :idProducto";

		$params = [
			'idCuentaAntencion' => $oTabla->idCuentaAtencion, 
			'idOrden' => $oTabla->idOrden, 
			'idProducto' => $oTabla->idProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}