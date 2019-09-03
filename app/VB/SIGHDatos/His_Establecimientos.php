<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class His_Establecimientos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC His_EstablecimientosAgregar :idEstablecimiento, :idUsuarioAuditoria";

		$params = [
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC His_EstablecimientosModificar :idEstablecimiento, :idUsuarioAuditoria";

		$params = [
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC His_EstablecimientosEliminar :idEstablecimiento, :idUsuarioAuditoria";

		$params = [
			'idEstablecimiento' => $oTabla->idEstablecimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC His_EstablecimientosSeleccionarPorId :idEstablecimiento";

		$params = [
			'idEstablecimiento' => $oTabla->idEstablecimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}