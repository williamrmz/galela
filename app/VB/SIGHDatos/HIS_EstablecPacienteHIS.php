<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_EstablecPacienteHIS extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idEstablecPacienteHIS AS Int = :idEstablecPacienteHIS
			SET NOCOUNT ON 
			EXEC HIS_EstablecPacienteHISAgregar @idEstablecPacienteHIS OUTPUT, :idEstablecimiento, :idHisPaciente, :nroHC_FF, :idUsuarioAuditoria
			SELECT @idEstablecPacienteHIS AS idEstablecPacienteHIS";

		$params = [
			'idEstablecPacienteHIS' => 0, 
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'idHisPaciente' => ($oTabla->idHisPaciente == 0)? Null: $oTabla->idHisPaciente, 
			'nroHC_FF' => ($oTabla->nroHC_FF == "")? Null: $oTabla->nroHC_FF, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC HIS_EstablecPacienteHISModificar :idEstablecPacienteHIS, :idEstablecimiento, :idHisPaciente, :nroHC_FF, :idUsuarioAuditoria";

		$params = [
			'idEstablecPacienteHIS' => ($oTabla->idEstablecPacienteHIS == 0)? Null: $oTabla->idEstablecPacienteHIS, 
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'idHisPaciente' => ($oTabla->idHisPaciente == 0)? Null: $oTabla->idHisPaciente, 
			'nroHC_FF' => ($oTabla->nroHC_FF == "")? Null: $oTabla->nroHC_FF, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC HIS_EstablecPacienteHISEliminar :idEstablecPacienteHIS, :idUsuarioAuditoria";

		$params = [
			'idEstablecPacienteHIS' => $oTabla->idEstablecPacienteHIS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_EstablecPacienteHISSeleccionarPorId :idEstablecPacienteHIS";

		$params = [
			'idEstablecPacienteHIS' => $oTabla->idEstablecPacienteHIS, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}