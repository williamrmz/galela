<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class InterconsultaCabecera extends Model
{
	public function Insertar($oTabla, $oTabla2)
	{
		$query = "
			DECLARE @idInterconsultaCab AS Int = :idInterconsultaCab
			SET NOCOUNT ON 
			EXEC InsertarDatosInicialesCabySol @idInterconsultaCab OUTPUT, :idCuentaAtencion, :idServicioS, :idEspecialidad, :idMedicoS, :idMedicoR, :idPaciente, :idCama, :estacion, :hora, :fecha, :resumenHC, :motivo, :idUsuario, :estacion1
			SELECT @idInterconsultaCab AS idInterconsultaCab";

		$params = [
			'idInterconsultaCab' => 0, 
			'idCuentaAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
			'idServicioS' => ($oTabla->idServicioS == 0)? Null: $oTabla->idServicioS, 
			'idEspecialidad' => ($oTabla->idEspecialidad == 0)? Null: $oTabla->idEspecialidad, 
			'idMedicoS' => ($oTabla->idMedicoS == 0)? Null: $oTabla->idMedicoS, 
			'idMedicoR' => ($oTabla->idMedicoR == 0)? Null: $oTabla->idMedicoR, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCama' => ($oTabla->idCama == 0)? Null: $oTabla->idCama, 
			'estacion' => $oTabla->estacion, 
			'hora' => ($$oTabla2->horaS == "")? Null: $$oTabla2->horaS, 
			'fecha' => ($$oTabla2->fechaS == 0)? Null: $$oTabla2->fechaS, 
			'resumenHC' => ($$oTabla2->resumenHC == "")? Null: $$oTabla2->resumenHC, 
			'motivo' => ($$oTabla2->motivo == "")? Null: $$oTabla2->motivo, 
			'idUsuario' => ($$oTabla2->idUsuario == 0)? Null: $$oTabla2->idUsuario, 
			'estacion1' => $$oTabla2->estacion, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla, $oTabla2)
	{
		$query = "
			EXEC ModificarDatosInicialesCabySol :idInterconsultaCab, :idAtencion, :idServicioS, :idEspecialidad, :idMedicoS, :idMedicoR, :idCama, :estacion, :horaS, :fechaS, :resumenHC, :motivo, :estacion1";

		$params = [
			'idInterconsultaCab' => ($oTabla->idInterconsultaCab == 0)? Null: $oTabla->idInterconsultaCab, 
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
			'idServicioS' => ($oTabla->idServicioS == 0)? Null: $oTabla->idServicioS, 
			'idEspecialidad' => ($oTabla->idEspecialidad == 0)? Null: $oTabla->idEspecialidad, 
			'idMedicoS' => ($oTabla->idMedicoS == 0)? Null: $oTabla->idMedicoS, 
			'idMedicoR' => ($oTabla->idMedicoR == 0)? Null: $oTabla->idMedicoR, 
			'idCama' => ($oTabla->idCama == 0)? Null: $oTabla->idCama, 
			'estacion' => $oTabla->estacion, 
			'horaS' => ($$oTabla2->horaS == "")? Null: $$oTabla2->horaS, 
			'fechaS' => ($$oTabla2->fechaS == 0)? Null: $$oTabla2->fechaS, 
			'resumenHC' => ($$oTabla2->resumenHC == "")? Null: $$oTabla2->resumenHC, 
			'motivo' => ($$oTabla2->motivo == "")? Null: $$oTabla2->motivo, 
			'estacion1' => ($$oTabla2->estacion == "")? Null: $$oTabla2->estacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			DECLARE @idInterconsultaSol AS Int = :idInterconsultaSol
			SET NOCOUNT ON 
			EXEC pa_CQxExamenFisicoDetEliminar @idInterconsultaSol OUTPUT, :idAtencion
			SELECT @idInterconsultaSol AS idInterconsultaSol";

		$params = [
			'idInterconsultaSol' => 0, 
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC InterconsultaCabSeleccionarPorId :idInterconsultaCab";

		$params = [
			'idInterconsultaCab' => $oTabla->idInterconsultaCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Validar($oTabla)
	{
		$query = "
			EXEC ValidarUusarioISolicitud :idAtencion, :idCab";

		$params = [
			'idAtencion' => $oTabla->idatencion, 
			'idCab' => $oTabla->idInterconsultaCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function HistoricoInterconsulta($oTabla)
	{
		$query = "
			EXEC InterconsultaCatologoVisitas :idAtencion";

		$params = [
			'idAtencion' => $oTabla->idatencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function CargarDatosInterconsulta($oTabla)
	{
		$query = "
			EXEC CargarDatosInterconsulta :idAtencion, :idIcab";

		$params = [
			'idAtencion' => $oTabla->idatencion, 
			'idIcab' => $oTabla->idInterconsultaCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function CargarDatosInterconsultaResp($oTabla)
	{
		$query = "
			EXEC CargarDatosInterconsultaResp :idAtencion, :idIcab";

		$params = [
			'idAtencion' => $oTabla->idatencion, 
			'idIcab' => $oTabla->idInterconsultaCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function CargarDiagnosticosInterconsultaResp($oTabla)
	{
		$query = "
			EXEC FiltrarDiagxAtencionInterconsultaResp :idCuenta, :idDiag";

		$params = [
			'idCuenta' => $oTabla->idCuentaAtencion, 
			'idDiag' => $oTabla->idDiagnosticoIC, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function CargarDiagnosticosInterconsulta($oTabla)
	{
		$query = "
			EXEC FiltrarDiagxAtencionInterconsulta :idCuenta, :idDiag";

		$params = [
			'idCuenta' => $oTabla->idCuentaAtencion, 
			'idDiag' => $oTabla->idDiagnosticoIC, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function InsertarInterDiag($oTabla)
	{
		$query = "
			DECLARE @idAtencionDiagnostico2 AS Int = :idAtencionDiagnostico2
			SET NOCOUNT ON 
			EXEC AgregarDiagnosticoInterconsulta @idAtencionDiagnostico2 OUTPUT, :idAtencion, :idClasificacionDx, :idDiagnostico, :idSubclasificacionDx, :idUsuario
			SELECT @idAtencionDiagnostico2 AS idAtencionDiagnostico2";

		$params = [
			'idAtencionDiagnostico2' => 0, 
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
			'idClasificacionDx' => ($oTabla->idClasificacionDx == 0)? Null: $oTabla->idClasificacionDx, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idSubclasificacionDx' => ($oTabla->idSubClasificacionDX == 0)? Null: $oTabla->idSubClasificacionDX, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function InsertarInterconsultaDiag($oTabla)
	{
		$query = "
			DECLARE @idInterconsultaDiagnostico AS Int = :idInterconsultaDiagnostico
			SET NOCOUNT ON 
			EXEC DiagnosticosInterconsultaAgregar @idInterconsultaDiagnostico OUTPUT, :idCuentaAtencion, :idDiagnostico, :idSubclasificacionDx, :tipoInterconsulta, :idUsuario, :estacion
			SELECT @idInterconsultaDiagnostico AS idInterconsultaDiagnostico";

		$params = [
			'idInterconsultaDiagnostico' => 0, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idSubclasificacionDx' => ($oTabla->idSubClasificacionDX == 0)? Null: $oTabla->idSubClasificacionDX, 
			'tipoInterconsulta' => ($oTabla->tipoInterconsulta == "")? Null: $oTabla->tipoInterconsulta, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => ($oTabla->estacion == "")? Null: $oTabla->estacion, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function EliminarDiagnostico($oTabla)
	{
		$query = "
			EXEC AtencionesDiagnosticos2Eliminar :idInterconsultaDiagnostico";

		$params = [
			'idInterconsultaDiagnostico' => $oTabla->idInterconsultaDiagnostico, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function EliminarDiagnosticoResp($oTabla)
	{
		$query = "
			EXEC AtencionesDiagnosticos2EliminarResp :idInterconsultaDiagnostico";

		$params = [
			'idInterconsultaDiagnostico' => $oTabla->idInterconsultaDiagnostico, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function InsertarIRespuesta($oTabla)
	{
		$query = "
			DECLARE @idInterconsultaRespuesta AS Int = :idInterconsultaRespuesta
			SET NOCOUNT ON 
			EXEC InsertarInterconsultaRespuesta @idInterconsultaRespuesta OUTPUT, :idInterconsultaCab, :horaR, :fechaR, :resumenHC, :motivo, :idUsuario, :estacion
			SELECT @idInterconsultaRespuesta AS idInterconsultaRespuesta";

		$params = [
			'idInterconsultaRespuesta' => 0, 
			'idInterconsultaCab' => ($oTabla->idInterconsultaCab == 0)? Null: $oTabla->idInterconsultaCab, 
			'horaR' => ($oTabla->horaR == "")? Null: $oTabla->horaR, 
			'fechaR' => ($oTabla->fechaR == 0)? Null: $oTabla->fechaR, 
			'resumenHC' => ($oTabla->resumenHC == "")? Null: $oTabla->resumenHC, 
			'motivo' => ($oTabla->motivo == "")? Null: $oTabla->motivo, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => ($oTabla->estacion == "")? Null: $oTabla->estacion, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function ModificarIRespuesta($oTabla)
	{
		$query = "
			EXEC ModificarInterconsultaResp :idInterconsultaCab, :fechaR, :resumenHC, :motivo, :estacion";

		$params = [
			'idInterconsultaCab' => ($oTabla->idInterconsultaCab == 0)? Null: $oTabla->idInterconsultaCab, 
			'fechaR' => ($oTabla->fechaR == 0)? Null: $oTabla->fechaR, 
			'resumenHC' => ($oTabla->resumenHC == "")? Null: $oTabla->resumenHC, 
			'motivo' => ($oTabla->motivo == "")? Null: $oTabla->motivo, 
			'estacion' => ($oTabla->estacion == "")? Null: $oTabla->estacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function InsertarInterconsultaDiagResp($oTabla)
	{
		$query = "
			DECLARE @idInterconsultaDiagnostico AS Int = :idInterconsultaDiagnostico
			SET NOCOUNT ON 
			EXEC DiagnosticosInterconsultaAgregarResp @idInterconsultaDiagnostico OUTPUT, :idCuentaAtencion, :idDiagnostico, :idSubclasificacionDx, :tipoInterconsulta, :idUsuario, :estacion
			SELECT @idInterconsultaDiagnostico AS idInterconsultaDiagnostico";

		$params = [
			'idInterconsultaDiagnostico' => 0, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idSubclasificacionDx' => ($oTabla->idSubClasificacionDX == 0)? Null: $oTabla->idSubClasificacionDX, 
			'tipoInterconsulta' => ($oTabla->tipoInterconsulta == "")? Null: $oTabla->tipoInterconsulta, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => ($oTabla->estacion == "")? Null: $oTabla->estacion, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function ListarDiagnosticoInterSol($lIdAtencion, $lIdCab)
	{
		$query = "
			EXEC ListarDiagnosticoInterconsultaSolicitud :idCuenta, :idDiag";

		$params = [
			'idCuenta' => $lIdAtencion, 
			'idDiag' => $lIdCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarCodigoInterSol($lIdAtencion, $lIdCab)
	{
		$query = "
			EXEC ListarCodigoInterconsultaSolicitud :idCuenta, :idDiag";

		$params = [
			'idCuenta' => $lIdAtencion, 
			'idDiag' => $lIdCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarTipoDiagInterSol($lIdAtencion, $lIdCab)
	{
		$query = "
			EXEC ListarTipoDiagInterconsultaSolicitud :idCuenta, :idDiag";

		$params = [
			'idCuenta' => $lIdAtencion, 
			'idDiag' => $lIdCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarDiagnosticoInterResp($lIdAtencion, $lIdCab)
	{
		$query = "
			EXEC ListarDiagnosticoInterconsultaSolicitudR :idCuenta, :idDiag";

		$params = [
			'idCuenta' => $lIdAtencion, 
			'idDiag' => $lIdCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarCodigoInterResp($lIdAtencion, $lIdCab)
	{
		$query = "
			EXEC ListarCodigoInterconsultaSolicitudR :idCuenta, :idDiag";

		$params = [
			'idCuenta' => $lIdAtencion, 
			'idDiag' => $lIdCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarTipoDiagInterResp($lIdAtencion, $lIdCab)
	{
		$query = "
			EXEC ListarTipoInterconsultaSolicitudR :idCuenta, :idDiag";

		$params = [
			'idCuenta' => $lIdAtencion, 
			'idDiag' => $lIdCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarInterconsulta($oTabla)
	{
		$query = "
			EXEC EliminarCab :idCab";

		$params = [
			'idCab' => $oTabla->idInterconsultaCab, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function EliminarInterconsultaxAtencion($oTabla)
	{
		$query = "
			EXEC EliminarInterconsultaxIdCuentaAtencion :idCuenta, :idCab";

		$params = [
			'idCuenta' => $oTabla->idatencion, 
			'idCab' => $oTabla->idInterconsultaCab, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function InsertarFactOrdenServicio($oTabla, $oTabla2, $oTabla3)
	{
		$query = "
			DECLARE @idOrden AS Int = :idOrden
			SET NOCOUNT ON 
			EXEC FactOrdenServicioAgregarInter @idOrden OUTPUT, :idPaciente, :idCuentaAtencion, :idServicioPaciente, :idTipoFinanciamiento, :idFuenteFinanciamiento, :idUsuario, :idUsuarioDespacho, :idComprobantePago, :idUsuario2, :idUsuarioAutoriza
			SELECT @idOrden AS idOrden";

		$params = [
			'idOrden' => 0, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioPaciente' => ($oTabla->idServicioPaciente == 0)? Null: $oTabla->idServicioPaciente, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idUsuarioDespacho' => ($oTabla->idUsuarioDespacho == 0)? Null: $oTabla->idUsuarioDespacho, 
			'idComprobantePago' => ($$oTabla2->idComprobantePago == 0)? Null: $$oTabla2->idComprobantePago, 
			'idUsuario2' => ($$oTabla2->idUsuario == 0)? Null: $$oTabla2->idUsuario, 
			'idUsuarioAutoriza' => ($$oTabla3->idUsuarioAutoriza == 0)? Null: $$oTabla3->idUsuarioAutoriza, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

}