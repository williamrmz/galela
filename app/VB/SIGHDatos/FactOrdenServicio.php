<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FactOrdenServicio extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idOrden AS Int = :idOrden
			SET NOCOUNT ON 
			EXEC FactOrdenServicioAgregar @idOrden OUTPUT, :idPuntoCarga, :idPaciente, :idCuentaAtencion, :idServicioPaciente, :idTipoFinanciamiento, :idFuenteFinanciamiento, :fechaCreacion, :idUsuario, :fechaDespacho, :idUsuarioDespacho, :idEstadoFacturacion, :fechaHoraRealizaCpt, :idUsuarioAuditoria
			SELECT @idOrden AS idOrden";

		$params = [
			'idOrden' => 0, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioPaciente' => ($oTabla->idServicioPaciente == 0)? Null: $oTabla->idServicioPaciente, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'fechaDespacho' => ($oTabla->fechaDespacho == 0)? Null: $oTabla->fechaDespacho, 
			'idUsuarioDespacho' => ($oTabla->idUsuarioDespacho == 0)? Null: $oTabla->idUsuarioDespacho, 
			'idEstadoFacturacion' => ($oTabla->idEstadoFacturacion == 0)? Null: $oTabla->idEstadoFacturacion, 
			'fechaHoraRealizaCpt' => ($oTabla->fechaHoraRealizaCpt == 0)? Null: $oTabla->fechaHoraRealizaCpt, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Insertar1($oTabla)
	{
		$query = "
			DECLARE @idOrden AS Int = :idOrden
			SET NOCOUNT ON 
			EXEC FactOrdenServicioAgregar1 @idOrden OUTPUT, :idPuntoCarga, :idPaciente, :idCuentaAtencion, :idServicioPaciente, :idTipoFinanciamiento, :idFuenteFinanciamiento, :fechaCreacion, :idUsuario, :fechaDespacho, :idUsuarioDespacho, :idEstadoFacturacion, :fechaHoraRealizaCpt, :idUsuarioAuditoria
			SELECT @idOrden AS idOrden";

		$params = [
			'idOrden' => 0, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioPaciente' => ($oTabla->idServicioPaciente == 0)? Null: $oTabla->idServicioPaciente, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'fechaDespacho' => ($oTabla->fechaDespacho == 0)? Null: $oTabla->fechaDespacho, 
			'idUsuarioDespacho' => ($oTabla->idUsuarioDespacho == 0)? Null: $oTabla->idUsuarioDespacho, 
			'idEstadoFacturacion' => ($oTabla->idEstadoFacturacion == 0)? Null: $oTabla->idEstadoFacturacion, 
			'fechaHoraRealizaCpt' => ($oTabla->fechaHoraRealizaCpt == 0)? Null: $oTabla->fechaHoraRealizaCpt, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactOrdenServicioModificar :idOrden, :idPuntoCarga, :idPaciente, :idCuentaAtencion, :idServicioPaciente, :idTipoFinanciamiento, :idFuenteFinanciamiento, :fechaCreacion, :idUsuario, :fechaDespacho, :idUsuarioDespacho, :idEstadoFacturacion, :fechaHoraRealizaCpt, :idUsuarioAuditoria";

		$params = [
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioPaciente' => ($oTabla->idServicioPaciente == 0)? Null: $oTabla->idServicioPaciente, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'fechaDespacho' => ($oTabla->fechaDespacho == 0)? Null: $oTabla->fechaDespacho, 
			'idUsuarioDespacho' => ($oTabla->idUsuarioDespacho == 0)? Null: $oTabla->idUsuarioDespacho, 
			'idEstadoFacturacion' => ($oTabla->idEstadoFacturacion == 0)? Null: $oTabla->idEstadoFacturacion, 
			'fechaHoraRealizaCpt' => ($oTabla->fechaHoraRealizaCpt == 0)? Null: $oTabla->fechaHoraRealizaCpt, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactOrdenServicioEliminar :idOrden, :idUsuarioAuditoria";

		$params = [
			'idOrden' => $oTabla->idOrden, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactOrdenServicioSeleccionarPorId :idOrden";

		$params = [
			'idOrden' => $oTabla->idOrden, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ValidarCodPrestacion($oTabla)
	{
		$query = "
			DECLARE @idOrden AS Int = :idOrden
			DECLARE @codPrestacion AS VarChar = :codPrestacion
			SET NOCOUNT ON 
			EXEC ValidarCodigoPrestacion @idOrden OUTPUT, @codPrestacion OUTPUT, :fechaCreacion, :idPaciente, :idCuentaAtencion, :idServicioPaciente, :idFuenteFinanciamiento, :idUsuario, :idUsuarioDespacho, :idUsuarioAuditoriza
			SELECT @idOrden AS idOrden, @codPrestacion AS codPrestacion";

		$params = [
			'idOrden' => 0, 
			'codPrestacion' => " ", 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioPaciente' => ($oTabla->idServicioPaciente == 0)? Null: $oTabla->idServicioPaciente, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idUsuarioDespacho' => ($oTabla->idUsuarioDespacho == 0)? Null: $oTabla->idUsuarioDespacho, 
			'idUsuarioAuditoriza' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function ValidarCodPrestacionHosp($oTabla)
	{
		$query = "
			DECLARE @idOrden AS Int = :idOrden
			DECLARE @codPrestacion AS VarChar = :codPrestacion
			SET NOCOUNT ON 
			EXEC ValidarCodigoPrestacionHosp @idOrden OUTPUT, @codPrestacion OUTPUT, :fechaCreacion, :idPaciente, :idCuentaAtencion, :idServicioPaciente, :idFuenteFinanciamiento, :idUsuario, :idUsuarioDespacho, :idUsuarioAuditoriza
			SELECT @idOrden AS idOrden, @codPrestacion AS codPrestacion";

		$params = [
			'idOrden' => 0, 
			'codPrestacion' => "", 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioPaciente' => ($oTabla->idServicioPaciente == 0)? Null: $oTabla->idServicioPaciente, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idUsuarioDespacho' => ($oTabla->idUsuarioDespacho == 0)? Null: $oTabla->idUsuarioDespacho, 
			'idUsuarioAuditoriza' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function ValidarAdmisionEmergencia($oTabla)
	{
		$query = "
			DECLARE @idOrden AS Int = :idOrden
			SET NOCOUNT ON 
			EXEC ValidarAdmisionEmergencia @idOrden OUTPUT, :fechaCreacion, :idPaciente, :idCuentaAtencion, :idServicioPaciente, :idFuenteFinanciamiento, :idUsuario, :idUsuarioDespacho, :idUsuarioAuditoriza
			SELECT @idOrden AS idOrden";

		$params = [
			'idOrden' => 0, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioPaciente' => ($oTabla->idServicioPaciente == 0)? Null: $oTabla->idServicioPaciente, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idUsuarioDespacho' => ($oTabla->idUsuarioDespacho == 0)? Null: $oTabla->idUsuarioDespacho, 
			'idUsuarioAuditoriza' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function GeneraAtencionEnfermeria($oTabla, $lnDiasEstancia)
	{
		$query = "
			DECLARE @idOrden AS Int = :idOrden
			SET NOCOUNT ON 
			EXEC GeneraAtencionEnfermeria @idOrden OUTPUT, :fechaCreacion, :idPaciente, :idCuentaAtencion, :idServicioPaciente, :idFuenteFinanciamiento, :idUsuario, :idUsuarioDespacho, :lnDiasEstancia, :idUsuarioAuditoriza
			SELECT @idOrden AS idOrden";

		$params = [
			'idOrden' => 0, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioPaciente' => ($oTabla->idServicioPaciente == 0)? Null: $oTabla->idServicioPaciente, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idUsuarioDespacho' => ($oTabla->idUsuarioDespacho == 0)? Null: $oTabla->idUsuarioDespacho, 
			'lnDiasEstancia' => $lnDiasEstancia, 
			'idUsuarioAuditoriza' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function GeneraAtencionEnfermeriaSOAT($oTabla, $lnDiasEstancia)
	{
		$query = "
			DECLARE @idOrden AS Int = :idOrden
			SET NOCOUNT ON 
			EXEC GeneraAtencionEnfermeriaSOAT @idOrden OUTPUT, :fechaCreacion, :idPaciente, :idCuentaAtencion, :idServicioPaciente, :idFuenteFinanciamiento, :idUsuario, :idUsuarioDespacho, :lnDiasEstancia, :idUsuarioAuditoriza
			SELECT @idOrden AS idOrden";

		$params = [
			'idOrden' => 0, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioPaciente' => ($oTabla->idServicioPaciente == 0)? Null: $oTabla->idServicioPaciente, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idUsuarioDespacho' => ($oTabla->idUsuarioDespacho == 0)? Null: $oTabla->idUsuarioDespacho, 
			'lnDiasEstancia' => $lnDiasEstancia, 
			'idUsuarioAuditoriza' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function generaAtencionObservacion($oTabla)
	{
		$query = "
			DECLARE @idOrden AS Int = :idOrden
			SET NOCOUNT ON 
			EXEC GeneraAtencionObservacion @idOrden OUTPUT, :fechaCreacion, :idPaciente, :idCuentaAtencion, :idServicioPaciente, :idFuenteFinanciamiento, :idUsuario, :idUsuarioDespacho, :idUsuarioAuditoriza
			SELECT @idOrden AS idOrden";

		$params = [
			'idOrden' => 0, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioPaciente' => ($oTabla->idServicioPaciente == 0)? Null: $oTabla->idServicioPaciente, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idUsuarioDespacho' => ($oTabla->idUsuarioDespacho == 0)? Null: $oTabla->idUsuarioDespacho, 
			'idUsuarioAuditoriza' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function generaAtencionObservacionSOAT($oTabla)
	{
		$query = "
			DECLARE @idOrden AS Int = :idOrden
			SET NOCOUNT ON 
			EXEC GeneraAtencionObservacionSOAT @idOrden OUTPUT, :fechaCreacion, :idPaciente, :idCuentaAtencion, :idServicioPaciente, :idFuenteFinanciamiento, :idUsuario, :idUsuarioDespacho, :idUsuarioAuditoriza
			SELECT @idOrden AS idOrden";

		$params = [
			'idOrden' => 0, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioPaciente' => ($oTabla->idServicioPaciente == 0)? Null: $oTabla->idServicioPaciente, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idUsuarioDespacho' => ($oTabla->idUsuarioDespacho == 0)? Null: $oTabla->idUsuarioDespacho, 
			'idUsuarioAuditoriza' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function InsertarCE($oTabla, $lnFuenteFinanciamiento)
	{
		$query = "
			DECLARE @idOrden AS Int = :idOrden
			DECLARE @idOrdenPago AS Int = :idOrdenPago
			SET NOCOUNT ON 
			EXEC FactOrdenServicioAgregarCEParticular @idOrden OUTPUT, :idPuntoCarga, :idPaciente, :idCuentaAtencion, :idServicioPaciente, :idTipoFinanciamiento, :idFuenteFinanciamiento, :fechaCreacion, :idUsuario, :fechaDespacho, :idUsuarioDespacho, :idEstadoFacturacion, :fechaHoraRealizaCpt, :idUsuarioAuditoria, :lnFuenteFinanciamiento, @idOrdenPago OUTPUT
			SELECT @idOrden AS idOrden, @idOrdenPago AS idOrdenPago";

		$params = [
			'idOrden' => 0, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioPaciente' => ($oTabla->idServicioPaciente == 0)? Null: $oTabla->idServicioPaciente, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'fechaDespacho' => ($oTabla->fechaDespacho == 0)? Null: $oTabla->fechaDespacho, 
			'idUsuarioDespacho' => ($oTabla->idUsuarioDespacho == 0)? Null: $oTabla->idUsuarioDespacho, 
			'idEstadoFacturacion' => ($oTabla->idEstadoFacturacion == 0)? Null: $oTabla->idEstadoFacturacion, 
			'fechaHoraRealizaCpt' => ($oTabla->fechaHoraRealizaCpt == 0)? Null: $oTabla->fechaHoraRealizaCpt, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'lnFuenteFinanciamiento' => ($lnFuenteFinanciamiento == 0)? Null: $lnFuenteFinanciamiento, 
			'idOrdenPago' => 0, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function InsertarSeguro($oTabla)
	{
		$query = "
			DECLARE @idOrden AS Int = :idOrden
			SET NOCOUNT ON 
			EXEC FactOrdenServicioAgregarCE @idOrden OUTPUT, :idPuntoCarga, :idPaciente, :idCuentaAtencion, :idServicioPaciente, :idTipoFinanciamiento, :idFuenteFinanciamiento, :fechaCreacion, :idUsuario, :fechaDespacho, :idUsuarioDespacho, :idEstadoFacturacion, :fechaHoraRealizaCpt, :idUsuarioAuditoria
			SELECT @idOrden AS idOrden";

		$params = [
			'idOrden' => 0, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioPaciente' => ($oTabla->idServicioPaciente == 0)? Null: $oTabla->idServicioPaciente, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'fechaDespacho' => ($oTabla->fechaDespacho == 0)? Null: $oTabla->fechaDespacho, 
			'idUsuarioDespacho' => ($oTabla->idUsuarioDespacho == 0)? Null: $oTabla->idUsuarioDespacho, 
			'idEstadoFacturacion' => ($oTabla->idEstadoFacturacion == 0)? Null: $oTabla->idEstadoFacturacion, 
			'fechaHoraRealizaCpt' => ($oTabla->fechaHoraRealizaCpt == 0)? Null: $oTabla->fechaHoraRealizaCpt, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function InsertarPrioridad($oTabla, $idPrioridad)
	{
		$query = "
			DECLARE @idOrden AS Int = :idOrden
			SET NOCOUNT ON 
			EXEC FactOrdenServicioAgregarPrioridad @idOrden OUTPUT, :idPuntoCarga, :idPaciente, :idCuentaAtencion, :idServicioPaciente, :idTipoFinanciamiento, :idFuenteFinanciamiento, :fechaCreacion, :idUsuario, :fechaDespacho, :idUsuarioDespacho, :idEstadoFacturacion, :fechaHoraRealizaCpt, :idUsuarioAuditoria, :idPrioridad
			SELECT @idOrden AS idOrden";

		$params = [
			'idOrden' => 0, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioPaciente' => ($oTabla->idServicioPaciente == 0)? Null: $oTabla->idServicioPaciente, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'fechaDespacho' => ($oTabla->fechaDespacho == 0)? Null: $oTabla->fechaDespacho, 
			'idUsuarioDespacho' => ($oTabla->idUsuarioDespacho == 0)? Null: $oTabla->idUsuarioDespacho, 
			'idEstadoFacturacion' => ($oTabla->idEstadoFacturacion == 0)? Null: $oTabla->idEstadoFacturacion, 
			'fechaHoraRealizaCpt' => ($oTabla->fechaHoraRealizaCpt == 0)? Null: $oTabla->fechaHoraRealizaCpt, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idPrioridad' => $idPrioridad, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function InsertarPrioridadParticular($oTabla, $idPrioridad)
	{
		$query = "
			DECLARE @idOrden AS Int = :idOrden
			DECLARE @idOrdenPago AS Int = :idOrdenPago
			SET NOCOUNT ON 
			EXEC GenerarEnfermeriaParticular @idOrden OUTPUT, :idPuntoCarga, :idPaciente, :idCuentaAtencion, :idServicioPaciente, :idTipoFinanciamiento, :idFuenteFinanciamiento, :fechaCreacion, :idUsuario, :fechaDespacho, :idUsuarioDespacho, :idEstadoFacturacion, :fechaHoraRealizaCpt, :idUsuarioAuditoria, @idOrdenPago OUTPUT, :idPrioridad
			SELECT @idOrden AS idOrden, @idOrdenPago AS idOrdenPago";

		$params = [
			'idOrden' => 0, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioPaciente' => ($oTabla->idServicioPaciente == 0)? Null: $oTabla->idServicioPaciente, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'fechaDespacho' => ($oTabla->fechaDespacho == 0)? Null: $oTabla->fechaDespacho, 
			'idUsuarioDespacho' => ($oTabla->idUsuarioDespacho == 0)? Null: $oTabla->idUsuarioDespacho, 
			'idEstadoFacturacion' => ($oTabla->idEstadoFacturacion == 0)? Null: $oTabla->idEstadoFacturacion, 
			'fechaHoraRealizaCpt' => ($oTabla->fechaHoraRealizaCpt == 0)? Null: $oTabla->fechaHoraRealizaCpt, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idOrdenPago' => 0, 
			'idPrioridad' => $idPrioridad, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function EliminaPrioridadParticular($idatencion)
	{
		$query = "
			EXEC EliminaEnfermeriaParticular :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $idatencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminaPrioridadSeguros($idatencion)
	{
		$query = "
			EXEC EliminaEnfermeriaSeguros :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $idatencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}