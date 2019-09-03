<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CitasWebCupos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC CitasWebCuposAgregar :idWeb, :fecha, :idServicio, :idMedico, :horaInicio, :horaFinal, :idEstadoCitaWeb, :idCitaBloqueada, :dNI, :apellidoPaterno, :apellidoMaterno, :primerNombre, :segundoNombre, :idTipoSexo, :fechaNacimiento, :ubigeo, :fechaConfirmacion, :horaConfirmacion, :idFuenteFinanciamiento, :idTurno, :email, :telefono, :idPaciente, :idUsuarioAuditoria";

		$params = [
			'idWeb' => ($oTabla->idWeb == 0)? Null: $oTabla->idWeb, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'horaInicio' => ($oTabla->horaInicio == "")? Null: $oTabla->horaInicio, 
			'horaFinal' => ($oTabla->horaFinal == "")? Null: $oTabla->horaFinal, 
			'idEstadoCitaWeb' => ($oTabla->idEstadoCitaWeb == 0)? Null: $oTabla->idEstadoCitaWeb, 
			'idCitaBloqueada' => ($oTabla->idCitaBloqueada == 0)? Null: $oTabla->idCitaBloqueada, 
			'dNI' => ($oTabla->dNI == "")? Null: $oTabla->dNI, 
			'apellidoPaterno' => ($oTabla->apellidoPaterno == "")? Null: $oTabla->apellidoPaterno, 
			'apellidoMaterno' => ($oTabla->apellidoMaterno == "")? Null: $oTabla->apellidoMaterno, 
			'primerNombre' => ($oTabla->primerNombre == "")? Null: $oTabla->primerNombre, 
			'segundoNombre' => ($oTabla->segundoNombre == "")? Null: $oTabla->segundoNombre, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'fechaNacimiento' => ($oTabla->fechanacimiento == 0)? Null: $oTabla->fechanacimiento, 
			'ubigeo' => ($oTabla->ubigeo == 0)? Null: $oTabla->ubigeo, 
			'fechaConfirmacion' => ($oTabla->fechaConfirmacion == 0)? Null: $oTabla->fechaConfirmacion, 
			'horaConfirmacion' => ($oTabla->horaConfirmacion == "")? Null: $oTabla->horaConfirmacion, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'email' => ($oTabla->email == "")? Null: $oTabla->email, 
			'telefono' => ($oTabla->telefono == "")? Null: $oTabla->telefono, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CitasWebCuposModificar :idWeb, :fecha, :idServicio, :idMedico, :horaInicio, :horaFinal, :idEstadoCitaWeb, :idCitaBloqueada, :dNI, :apellidoPaterno, :apellidoMaterno, :primerNombre, :segundoNombre, :idTipoSexo, :fechaNacimiento, :ubigeo, :fechaConfirmacion, :horaConfirmacion, :idFuenteFinanciamiento, :idTurno, :email, :telefono, :idUsuarioAuditoria";

		$params = [
			'idWeb' => ($oTabla->idWeb == 0)? Null: $oTabla->idWeb, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'horaInicio' => ($oTabla->horaInicio == "")? Null: $oTabla->horaInicio, 
			'horaFinal' => ($oTabla->horaFinal == "")? Null: $oTabla->horaFinal, 
			'idEstadoCitaWeb' => ($oTabla->idEstadoCitaWeb == 0)? Null: $oTabla->idEstadoCitaWeb, 
			'idCitaBloqueada' => ($oTabla->idCitaBloqueada == 0)? Null: $oTabla->idCitaBloqueada, 
			'dNI' => ($oTabla->dNI == "")? Null: $oTabla->dNI, 
			'apellidoPaterno' => ($oTabla->apellidoPaterno == "")? Null: $oTabla->apellidoPaterno, 
			'apellidoMaterno' => ($oTabla->apellidoMaterno == "")? Null: $oTabla->apellidoMaterno, 
			'primerNombre' => ($oTabla->primerNombre == "")? Null: $oTabla->primerNombre, 
			'segundoNombre' => ($oTabla->segundoNombre == "")? Null: $oTabla->segundoNombre, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'fechaNacimiento' => ($oTabla->fechanacimiento == 0)? Null: $oTabla->fechanacimiento, 
			'ubigeo' => ($oTabla->ubigeo == 0)? Null: $oTabla->ubigeo, 
			'fechaConfirmacion' => ($oTabla->fechaConfirmacion == 0)? Null: $oTabla->fechaConfirmacion, 
			'horaConfirmacion' => ($oTabla->horaConfirmacion == "")? Null: $oTabla->horaConfirmacion, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'email' => ($oTabla->email == "")? Null: $oTabla->email, 
			'telefono' => ($oTabla->telefono == "")? Null: $oTabla->telefono, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function ModificarDcitas($oTabla)
	{
		$query = "
			EXEC CitasWebCuposModificarDcitas :idWeb, :fecha, :idServicio, :idMedico, :horaInicio, :horaFinal, :idEstadoCitaWeb, :idCitaBloqueada, :dNI, :apellidoPaterno, :apellidoMaterno, :primerNombre, :segundoNombre, :idTipoSexo, :fechaNacimiento, :ubigeo, :fechaConfirmacion, :horaConfirmacion, :idFuenteFinanciamiento, :idTurno, :email, :telefono, :idPaciente, :idUsuarioAuditoria";

		$params = [
			'idWeb' => ($oTabla->idWeb == 0)? Null: $oTabla->idWeb, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'horaInicio' => ($oTabla->horaInicio == "")? Null: $oTabla->horaInicio, 
			'horaFinal' => ($oTabla->horaFinal == "")? Null: $oTabla->horaFinal, 
			'idEstadoCitaWeb' => ($oTabla->idEstadoCitaWeb == 0)? Null: $oTabla->idEstadoCitaWeb, 
			'idCitaBloqueada' => ($oTabla->idCitaBloqueada == 0)? Null: $oTabla->idCitaBloqueada, 
			'dNI' => ($oTabla->dNI == "")? Null: $oTabla->dNI, 
			'apellidoPaterno' => ($oTabla->apellidoPaterno == "")? Null: $oTabla->apellidoPaterno, 
			'apellidoMaterno' => ($oTabla->apellidoMaterno == "")? Null: $oTabla->apellidoMaterno, 
			'primerNombre' => ($oTabla->primerNombre == "")? Null: $oTabla->primerNombre, 
			'segundoNombre' => ($oTabla->segundoNombre == "")? Null: $oTabla->segundoNombre, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'fechaNacimiento' => ($oTabla->fechanacimiento == 0)? Null: $oTabla->fechanacimiento, 
			'ubigeo' => ($oTabla->ubigeo == 0)? Null: $oTabla->ubigeo, 
			'fechaConfirmacion' => ($oTabla->fechaConfirmacion == 0)? Null: $oTabla->fechaConfirmacion, 
			'horaConfirmacion' => ($oTabla->horaConfirmacion == "")? Null: $oTabla->horaConfirmacion, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'email' => ($oTabla->email == "")? Null: $oTabla->email, 
			'telefono' => ($oTabla->telefono == "")? Null: $oTabla->telefono, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CitasWebCuposEliminar :idWeb, :idUsuarioAuditoria";

		$params = [
			'idWeb' => $oTabla->idWeb, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CitasWebCuposSeleccionarPorId :idWeb";

		$params = [
			'idWeb' => $oTabla->idWeb, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdCitaBloqueada($lnIdCitaBloqueada)
	{
		$query = "
			EXEC CitasWebCuposSeleccionarPorIdCitaBloqueada :idCitaBloqueada";

		$params = [
			'idCitaBloqueada' => $lnIdCitaBloqueada, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorProgramacion($oTabla)
	{
		$query = "
			EXEC CitasWebCuposEliminarPorProgramacion :fecha, :idMedico, :idTurno, :idServicio";

		$params = [
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'idMedico' => $oTabla->idMedico, 
			'idTurno' => $oTabla->idTurno, 
			'idServicio' => $oTabla->idServicio, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}