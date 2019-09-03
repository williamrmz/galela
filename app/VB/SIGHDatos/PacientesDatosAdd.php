<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class PacientesDatosAdd extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC PacientesDatosAdicionalesAgregar :idPaciente, :antecedentes, :antecedAlergico, :antecedObstetrico, :antecedQuirurgico, :antecedFamiliar, :antecedPatologico, :idUsuarioAuditoria";

		$params = [
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'antecedentes' => ($oTabla->antecedentes == "")? Null: $oTabla->antecedentes, 
			'antecedAlergico' => ($oTabla->antecedAlergico == "")? Null: $oTabla->antecedAlergico, 
			'antecedObstetrico' => ($oTabla->antecedObstetrico == "")? Null: $oTabla->antecedObstetrico, 
			'antecedQuirurgico' => ($oTabla->antecedQuirurgico == "")? Null: $oTabla->antecedQuirurgico, 
			'antecedFamiliar' => ($oTabla->antecedFamiliar == "")? Null: $oTabla->antecedFamiliar, 
			'antecedPatologico' => ($oTabla->antecedPatologico == "")? Null: $oTabla->antecedPatologico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PacientesDatosAdicionalesModificar :idPaciente, :antecedentes, :antecedAlergico, :antecedObstetrico, :antecedQuirurgico, :antecedFamiliar, :antecedPatologico, :idUsuarioAuditoria";

		$params = [
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'antecedentes' => ($oTabla->antecedentes == "")? Null: $oTabla->antecedentes, 
			'antecedAlergico' => ($oTabla->antecedAlergico == "")? Null: $oTabla->antecedAlergico, 
			'antecedObstetrico' => ($oTabla->antecedObstetrico == "")? Null: $oTabla->antecedObstetrico, 
			'antecedQuirurgico' => ($oTabla->antecedQuirurgico == "")? Null: $oTabla->antecedQuirurgico, 
			'antecedFamiliar' => ($oTabla->antecedFamiliar == "")? Null: $oTabla->antecedFamiliar, 
			'antecedPatologico' => ($oTabla->antecedPatologico == "")? Null: $oTabla->antecedPatologico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PacientesDatosAdicionalesEliminar :idPaciente, :idUsuarioAuditoria";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC PacientesDatosAdicionalesSeleccionarPorId :idPaciente";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function DatosPersonalesAgregar($oTabla)
	{
		$query = "
			EXEC PacientesDatosAdicionalesPersonalesAgregar :idPaciente, :fNacimientoCalculada";

		$params = [
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'fNacimientoCalculada' => $oTabla->fNacimientoCalculada, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}