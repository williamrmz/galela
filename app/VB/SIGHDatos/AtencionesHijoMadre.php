<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionesHijoMadre extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC AtencionesHijoMadreAgregar :idAtencion, :idAtencionMadre, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idAtencionMadre' => ($oTabla->idAtencionMadre == 0)? Null: $oTabla->idAtencionMadre, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionesHijoMadreModificar :idAtencion, :idAtencionMadre, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idAtencionMadre' => ($oTabla->idAtencionMadre == 0)? Null: $oTabla->idAtencionMadre, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionesHijoMadreEliminar :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionesHijoMadreSeleccionarPorId :idAtencion";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}