<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionesEpisodiosCab extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC AtencionesEpisodiosCabeceraAgregar :idPaciente, :idEpisodio, :fechaApertura, :fechaCierre, :idUsuarioAuditoria";

		$params = [
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idEpisodio' => ($oTabla->idEpisodio == 0)? Null: $oTabla->idEpisodio, 
			'fechaApertura' => ($oTabla->fechaApertura == 0)? Null: $oTabla->fechaApertura, 
			'fechaCierre' => ($oTabla->fechaCierre == 0)? Null: $oTabla->fechaCierre, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionesEpisodiosCabeceraModificar :idPaciente, :idEpisodio, :fechaApertura, :fechaCierre, :idUsuarioAuditoria";

		$params = [
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idEpisodio' => ($oTabla->idEpisodio == 0)? Null: $oTabla->idEpisodio, 
			'fechaApertura' => ($oTabla->fechaApertura == 0)? Null: $oTabla->fechaApertura, 
			'fechaCierre' => ($oTabla->fechaCierre == 0)? Null: $oTabla->fechaCierre, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionesEpisodiosCabeceraEliminar :idPaciente, :idEpisodio, :idUsuarioAuditoria";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
			'idEpisodio' => $oTabla->idEpisodio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionesEpisodiosCabeceraSeleccionarPorId :idPaciente";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}