<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxOperacionesSuspendidasCab extends Model
{
	public function Insertar($oTabla, $oTabladetalle)
	{
		$query = "
			DECLARE @idSuspensionOperacionCab AS Int = :idSuspensionOperacionCab
			SET NOCOUNT ON 
			EXEC CQxOperacionSuspendidasCabAgregar @idSuspensionOperacionCab OUTPUT, :idProgramacion, :idOrdenOperatoriaMQ, :idMedico, :idAnestesiologo, :idEnfermera, :idServicio, :horaProg, :idCausaSuspensionOperacion, :valor, :observacion, :idUsuario, :estacion, :idUsuarioAuditoria
			SELECT @idSuspensionOperacionCab AS idSuspensionOperacionCab";

		$params = [
			'idSuspensionOperacionCab' => 0, 
			'idProgramacion' => ($oTabla->idProgramacion == 0)? Null: $oTabla->idProgramacion, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idAnestesiologo' => ($oTabla->idAnestesiologo == 0)? Null: $oTabla->idAnestesiologo, 
			'idEnfermera' => ($oTabla->idEnfermera == 0)? Null: $oTabla->idEnfermera, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'horaProg' => ($oTabla->horaProg == "")? Null: $oTabla->horaProg, 
			'idCausaSuspensionOperacion' => ($$oTabladetalle->idCausaSuspensionOperacion == 0)? 0: $$oTabladetalle->idCausaSuspensionOperacion, 
			'valor' => ($$oTabladetalle->valor == 0)? Null: $$oTabladetalle->valor, 
			'observacion' => ($$oTabladetalle->observacion == "")? Null: $$oTabladetalle->observacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CQxOperacionSuspendidasCabModificar :idSuspensionOperacionCab, :idOrdenOperatoriaMQ, :idMedico, :idAnestesiologo, :idEnfermera, :idServicio, :horaProg, :horaSusp, :nroOperacionSuspendida, :estadoReg, :fechaReg, :idUsuario, :estacion, :idUsuarioAuditoria";

		$params = [
			'idSuspensionOperacionCab' => ($oTabla->idSuspensionOperacionCab == 0)? Null: $oTabla->idSuspensionOperacionCab, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idAnestesiologo' => ($oTabla->idAnestesiologo == 0)? Null: $oTabla->idAnestesiologo, 
			'idEnfermera' => ($oTabla->idEnfermera == 0)? Null: $oTabla->idEnfermera, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'horaProg' => ($oTabla->horaProg == "")? Null: $oTabla->horaProg, 
			'horaSusp' => ($oTabla->horaSusp == "")? Null: $oTabla->horaSusp, 
			'nroOperacionSuspendida' => $oTabla->nroOperacionSuspendida, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CQxOperacionSuspendidasCabEliminar :idSuspensionOperacionCab, :idUsuarioAuditoria";

		$params = [
			'idSuspensionOperacionCab' => $oTabla->idSuspensionOperacionCab, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxOperacionSuspendidasCabSeleccionarPorId :idSuspensionOperacionCab";

		$params = [
			'idSuspensionOperacionCab' => $oTabla->idSuspensionOperacionCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}