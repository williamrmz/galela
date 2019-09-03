<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionesConvenio extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAtencionesConvenio AS Int = :idAtencionesConvenio
			SET NOCOUNT ON 
			EXEC AtencionesConvenioAgregar :idPaciente, :idProducto, :nroOficio, :fechaSesion, :importeSesion, @idAtencionesConvenio OUTPUT, :idUsuarioAuditoria
			SELECT @idAtencionesConvenio AS idAtencionesConvenio";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
			'idProducto' => $oTabla->idProducto, 
			'nroOficio' => $oTabla->nroOficio, 
			'fechaSesion' => $oTabla->fechaSesion, 
			'importeSesion' => $oTabla->importeSesion, 
			'idAtencionesConvenio' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionesConvenioModificar :idPaciente, :idProducto, :nroOficio, :fechaSesion, :importeSesion, :idAtencionesConvenio, :idUsuarioAuditoria";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
			'idProducto' => $oTabla->idProducto, 
			'nroOficio' => $oTabla->nroOficio, 
			'fechaSesion' => $oTabla->fechaSesion, 
			'importeSesion' => $oTabla->importeSesion, 
			'idAtencionesConvenio' => $oTabla->idAtencionesConvenio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionesConvenioEliminar :idAtencionesConvenio, :idUsuarioAuditoria";

		$params = [
			'idAtencionesConvenio' => $oTabla->idAtencionesConvenio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CommandText = sSq ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarAtencionesConvenio($oDOPaciente)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}