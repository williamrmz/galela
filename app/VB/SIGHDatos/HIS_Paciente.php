<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_Paciente extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idHisPaciente AS Int = :idHisPaciente
			SET NOCOUNT ON 
			EXEC HIS_PacienteAgregar @idHisPaciente OUTPUT, :sexo, :idNacionalidad, :nroDocIdentidad, :nroHijo, :idEtnia, :idPacienteGalenHos, :idTipoDocumento, :idUsuarioAuditoria
			SELECT @idHisPaciente AS idHisPaciente";

		$params = [
			'idHisPaciente' => 0, 
			'sexo' => ($oTabla->sexo == 0)? Null: $oTabla->sexo, 
			'idNacionalidad' => ($oTabla->idNacionalidad == 0)? Null: $oTabla->idNacionalidad, 
			'nroDocIdentidad' => ($oTabla->nroDocIdentidad == "")? Null: $oTabla->nroDocIdentidad, 
			'nroHijo' => ($oTabla->nroHijo == "")? Null: $oTabla->nroHijo, 
			'idEtnia' => ($oTabla->idEtnia == "")? Null: $oTabla->idEtnia, 
			'idPacienteGalenHos' => ($oTabla->idPacienteGalenHos == 0)? Null: $oTabla->idPacienteGalenHos, 
			'idTipoDocumento' => ($oTabla->idTipoDocumento == 0)? Null: $oTabla->idTipoDocumento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC HIS_PacienteModificar :idHisPaciente, :sexo, :idNacionalidad, :nroDocIdentidad, :nroHijo, :idEtnia, :idPacienteGalenHos, :idTipoDocumento, :idUsuarioAuditoria";

		$params = [
			'idHisPaciente' => ($oTabla->idHisPaciente == 0)? Null: $oTabla->idHisPaciente, 
			'sexo' => ($oTabla->sexo == 0)? Null: $oTabla->sexo, 
			'idNacionalidad' => ($oTabla->idNacionalidad == 0)? Null: $oTabla->idNacionalidad, 
			'nroDocIdentidad' => ($oTabla->nroDocIdentidad == "")? Null: $oTabla->nroDocIdentidad, 
			'nroHijo' => ($oTabla->nroHijo == "")? Null: $oTabla->nroHijo, 
			'idEtnia' => ($oTabla->idEtnia == "")? Null: $oTabla->idEtnia, 
			'idPacienteGalenHos' => ($oTabla->idPacienteGalenHos == 0)? Null: $oTabla->idPacienteGalenHos, 
			'idTipoDocumento' => ($oTabla->idTipoDocumento == 0)? Null: $oTabla->idTipoDocumento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC HIS_PacienteEliminar :idHisPaciente, :idUsuarioAuditoria";

		$params = [
			'idHisPaciente' => $oTabla->idHisPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_PacienteSeleccionarPorId :idHisPaciente";

		$params = [
			'idHisPaciente' => $oTabla->idHisPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function VerificarPaciente($nroDocumentoIdentidad, $idTipoDocIdent)
	{
		$query = "
			EXEC his_pacienteXdocumento :nroDocumentoIdentidad, :idDocIdentidad";

		$params = [
			'nroDocumentoIdentidad' => NroDocumentoIdentidad, 
			'idDocIdentidad' => IdTipoDocIdent, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function VerificarPacienteNroHijo($nroDocumentoIdentidad, $idTipoDocIdent, $nroHijo)
	{
		$query = "
			EXEC his_pacienteXdocumentoNroHijo :nroDocumentoIdentidad, :idDocIdentidad, :nroHijo";

		$params = [
			'nroDocumentoIdentidad' => NroDocumentoIdentidad, 
			'idDocIdentidad' => IdTipoDocIdent, 
			'nroHijo' => NroHijo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarPacienteHIS($nroDocumentoIdentidad, $idPacienteGalenHos)
	{
		$query = "
			EXEC HIS_PACIENTEactualizaIdPacienteGalenHos :idPacienteGalenHos, :nroDocumentoIdentidad";

		$params = [
			'idPacienteGalenHos' => IdPacienteGalenHos, 
			'nroDocumentoIdentidad' => NroDocumentoIdentidad, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function HISPacientesFiltraPorNroDocumentoYtipo($lcNroDocumento, $lnIdDocIdentidad)
	{
		$query = "
			EXEC HIS_PacientesFiltraPorNroDocumentoYtipo :nroDocumento, :idDocIdentidad";

		$params = [
			'nroDocumento' => $lcNroDocumento, 
			'idDocIdentidad' => $lnIdDocIdentidad, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}