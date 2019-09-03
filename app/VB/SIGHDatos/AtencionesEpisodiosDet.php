<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionesEpisodiosDet extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC AtencionesEpisodiosDetalleAgregar :idPaciente, :idEpisodio, :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idEpisodio' => ($oTabla->idEpisodio == 0)? Null: $oTabla->idEpisodio, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionesEpisodiosDetalleModificar :idPaciente, :idEpisodio, :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idEpisodio' => ($oTabla->idEpisodio == 0)? Null: $oTabla->idEpisodio, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionesEpisodiosDetalleEliminar :idPaciente, :idPaciente, :idPaciente, :idUsuarioAuditoria";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
			'idPaciente' => $oTabla->idEpisodio, 
			'idPaciente' => $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionesEpisodiosDetalleSeleccionarPorId :idPaciente";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}