<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxVisitaEnfermeraVariable extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idVisitaEnfermeraVariable AS Int = :idVisitaEnfermeraVariable
			SET NOCOUNT ON 
			EXEC CQxVisitaEnfermeraVariableAgregar @idVisitaEnfermeraVariable OUTPUT, :idVisitaEnfermera, :idSignosVitales, :variableDato, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idVisitaEnfermeraVariable AS idVisitaEnfermeraVariable";

		$params = [
			'idVisitaEnfermeraVariable' => 0, 
			'idVisitaEnfermera' => ($oTabla->idVisitaEnfermera == 0)? Null: $oTabla->idVisitaEnfermera, 
			'idSignosVitales' => ($oTabla->idSignosVitales == 0)? Null: $oTabla->idSignosVitales, 
			'variableDato' => ($oTabla->variableDato == "")? Null: $oTabla->variableDato, 
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

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CQxVisitaEnfermeraVariableModificar :idVisitaEnfermeraVariable, :idVisitaEnfermera, :idSignosVitales, :variableDato, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idVisitaEnfermeraVariable' => ($oTabla->idVisitaEnfermeraVariable == 0)? Null: $oTabla->idVisitaEnfermeraVariable, 
			'idVisitaEnfermera' => ($oTabla->idVisitaEnfermera == 0)? Null: $oTabla->idVisitaEnfermera, 
			'idSignosVitales' => ($oTabla->idSignosVitales == 0)? Null: $oTabla->idSignosVitales, 
			'variableDato' => ($oTabla->variableDato == "")? Null: $oTabla->variableDato, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CQxVisitaEnfermeraVariableEliminar :idVisitaEnfermeraVariable, :idUsuarioAuditoria";

		$params = [
			'idVisitaEnfermeraVariable' => $oTabla->idVisitaEnfermeraVariable, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxVisitaEnfermeraVariableSeleccionarPorId :idVisitaEnfermeraVariable";

		$params = [
			'idVisitaEnfermeraVariable' => $oTabla->idVisitaEnfermeraVariable, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdVisitaEnfermera($oTabla)
	{
		$query = "
			EXEC CQxVisitaEnfermeraVariableSelPorIdVisitaEnfermera :idVisitaEnfermera";

		$params = [
			'idVisitaEnfermera' => $oTabla->idVisitaEnfermera, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}