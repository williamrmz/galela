<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposEdad extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTipoEdad AS Int = :idTipoEdad
			SET NOCOUNT ON 
			EXEC TiposEdadAgregar :descripcion, :codigo, @idTipoEdad OUTPUT, :idUsuarioAuditoria
			SELECT @idTipoEdad AS idTipoEdad";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idTipoEdad' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposEdadModificar :descripcion, :codigo, :idTipoEdad, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idTipoEdad' => ($oTabla->idTipoEdad == 0)? Null: $oTabla->idTipoEdad, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposEdadEliminar :idTipoEdad, :idUsuarioAuditoria";

		$params = [
			'idTipoEdad' => ($oTabla->idTipoEdad == 0)? Null: $oTabla->idTipoEdad, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposEdadSeleccionarPorId :idTipoEdad";

		$params = [
			'idTipoEdad' => $oTabla->idTipoEdad, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigo($oTabla)
	{
		$query = "
			EXEC TiposEdadXcodigo :codigo";

		$params = [
			'codigo' => $oTabla->codigo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposEdadSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}