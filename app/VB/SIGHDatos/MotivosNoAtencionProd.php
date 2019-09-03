<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class MotivosNoAtencionProd extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idMotivoNoAtencion AS Int = :idMotivoNoAtencion
			SET NOCOUNT ON 
			EXEC MotivosNoAtencionProductoAgregar :descripcion, @idMotivoNoAtencion OUTPUT, :idUsuarioAuditoria
			SELECT @idMotivoNoAtencion AS idMotivoNoAtencion";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idMotivoNoAtencion' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC MotivosNoAtencionProductoModificar :descripcion, :idMotivoNoAtencion, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idMotivoNoAtencion' => ($oTabla->idMotivoNoAtencion == 0)? Null: $oTabla->idMotivoNoAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC MotivosNoAtencionProductoEliminar :idMotivoNoAtencion, :idUsuarioAuditoria";

		$params = [
			'idMotivoNoAtencion' => ($oTabla->idMotivoNoAtencion == 0)? Null: $oTabla->idMotivoNoAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC MotivosNoAtencionProductoSeleccionarPorId :idMotivoNoAtencion";

		$params = [
			'idMotivoNoAtencion' => $oTabla->idMotivoNoAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}