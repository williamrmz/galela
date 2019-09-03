<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposCondicionRecienNacido extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idCondicionRN AS Int = :idCondicionRN
			SET NOCOUNT ON 
			EXEC TiposCondicionRecienNacidoAgregar :descripcion, @idCondicionRN OUTPUT, :idUsuarioAuditoria
			SELECT @idCondicionRN AS idCondicionRN";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idCondicionRN' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposCondicionRecienNacidoModificar :descripcion, :idCondicionRN, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idCondicionRN' => ($oTabla->idCondicionRN == 0)? Null: $oTabla->idCondicionRN, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposCondicionRecienNacidoEliminar :idCondicionRN, :idUsuarioAuditoria";

		$params = [
			'idCondicionRN' => ($oTabla->idCondicionRN == 0)? Null: $oTabla->idCondicionRN, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposCondicionRecienNacidoSeleccionarPorId :idCondicionRN";

		$params = [
			'idCondicionRN' => $oTabla->idCondicionRN, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposCondicionRecienNacidoSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}