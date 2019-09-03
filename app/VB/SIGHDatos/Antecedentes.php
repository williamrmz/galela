<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Antecedentes extends Model
{
	public function ListarEnfermedadxPaciente($lnIdPaciente)
	{
		$query = "
			EXEC Sp_CQx_Antecedentes_Listar :idPaciente";

		$params = [
			'idPaciente' => $lnIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarHabitosxPaciente($lnIdPaciente)
	{
		$query = "
			EXEC Sp_CQx_Antecedentes_ListarHabitos :idPaciente";

		$params = [
			'idPaciente' => $lnIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarOtrosxPaciente($lnIdPaciente)
	{
		$query = "
			EXEC SP_CQx_Antecedentes_ListarOtros :idPaciente";

		$params = [
			'idPaciente' => $lnIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function InsertarDatosAdicionales($oTabla)
	{
		$query = "
			DECLARE @idPaciente AS Int = :idPaciente
			SET NOCOUNT ON 
			EXEC CQxAntecedentesDatosAdicionalesAgregar @idPaciente OUTPUT, :alergias, :enfermedadActual, :antecedenteFamiliares, :otros, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idPaciente AS idPaciente";

		$params = [
			'idPaciente' => 0, 
			'alergias' => ($oTabla->alergias == "")? Null: $oTabla->alergias, 
			'enfermedadActual' => ($oTabla->enfermedadActual == "")? Null: $oTabla->enfermedadActual, 
			'antecedenteFamiliares' => ($oTabla->antecedenteFamiliares == "")? Null: $oTabla->antecedenteFamiliares, 
			'otros' => ($oTabla->otros == "")? Null: $oTabla->otros, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function ModificarDatosAdicionales($oTabla)
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

	public function SeleccionarPorIdDatosAdicionales($oTabla)
	{
		$query = "
			EXEC CQxAntecedentesDatosAdicionalesSeleccionarPorId :idPaciente";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function InsertarEnfermedadesDet($oTabla)
	{
		$query = "
			DECLARE @idAntecedenteEnfermedadDet AS Int = :idAntecedenteEnfermedadDet
			SET NOCOUNT ON 
			EXEC CQxAntecedenteEnfermedadesDetAgregar @idAntecedenteEnfermedadDet OUTPUT, :idAntecedenteEnfermedades, :idPaciente, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idAntecedenteEnfermedadDet AS idAntecedenteEnfermedadDet";

		$params = [
			'idAntecedenteEnfermedadDet' => 0, 
			'idAntecedenteEnfermedades' => ($oTabla->idAntecedenteEnfermedades == 0)? Null: $oTabla->idAntecedenteEnfermedades, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function ModificarEnfermedadesDet($oTabla)
	{
		$query = "
			EXEC CQxAntecedenteEnfermedadesDetModificar :idAntecedenteEnfermedadDet, :idAntecedenteEnfermedades, :idPaciente, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idAntecedenteEnfermedadDet' => ($oTabla->idAntecedenteEnfermedadDet == 0)? Null: $oTabla->idAntecedenteEnfermedadDet, 
			'idAntecedenteEnfermedades' => ($oTabla->idAntecedenteEnfermedades == 0)? Null: $oTabla->idAntecedenteEnfermedades, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorIdEnfermedadesDet($oTabla)
	{
		$query = "
			EXEC CQxAntecedenteEnfermedadesDetSeleccionarPorId :idAntecedenteEnfermedadDet";

		$params = [
			'idAntecedenteEnfermedadDet' => $oTabla->idAntecedenteEnfermedadDet, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function InsertarHabitosDet($oTabla)
	{
		$query = "
			DECLARE @idAntecedenteHabitosDet AS Int = :idAntecedenteHabitosDet
			SET NOCOUNT ON 
			EXEC CQxAntecedenteHabitosDetAgregar @idAntecedenteHabitosDet OUTPUT, :idAntecedenteHabitos, :idPaciente, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idAntecedenteHabitosDet AS idAntecedenteHabitosDet";

		$params = [
			'idAntecedenteHabitosDet' => 0, 
			'idAntecedenteHabitos' => ($oTabla->idAntecedenteHabitos == 0)? Null: $oTabla->idAntecedenteHabitos, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function ModificarHabitosDet($oTabla)
	{
		$query = "
			EXEC CQxAntecedenteHabitosDetModificar :idAntecedenteHabitosDet, :idAntecedenteHabitos, :idPaciente, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idAntecedenteHabitosDet' => ($oTabla->idAntecedenteHabitosDet == 0)? Null: $oTabla->idAntecedenteHabitosDet, 
			'idAntecedenteHabitos' => ($oTabla->idAntecedenteHabitos == 0)? Null: $oTabla->idAntecedenteHabitos, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorIdHabitosDet($oTabla)
	{
		$query = "
			EXEC CQxAntecedenteHabitosDetSeleccionarPorId :idAntecedenteHabitosDet";

		$params = [
			'idAntecedenteHabitosDet' => $oTabla->idAntecedenteHabitosDet, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdEnfermedades($oTabla)
	{
		$query = "
			EXEC CQxAntecedenteEnfermedadesSeleccionarPorId :idAntecedenteEnfermedades";

		$params = [
			'idAntecedenteEnfermedades' => $oTabla->idAntecedenteEnfermedades, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdHabitos($oTabla)
	{
		$query = "
			EXEC CQxAntecedenteHabitosSeleccionarPorId :idAntecedenteHabitos";

		$params = [
			'idAntecedenteHabitos' => $oTabla->idAntecedenteHabitos, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC CQxAntecedenteHabitosSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}