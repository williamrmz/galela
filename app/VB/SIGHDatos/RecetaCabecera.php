<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class RecetaCabecera extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idReceta AS Int = :idReceta
			SET NOCOUNT ON 
			EXEC RecetaCabeceraAgregar @idReceta OUTPUT, :idPuntoCarga, :fechaReceta, :idCuentaAtencion, :idServicioReceta, :idEstado, :idComprobantePago, :idMedicoReceta, :fechaVigencia, :idUsuarioAuditoria
			SELECT @idReceta AS idReceta";

		$params = [
			'idReceta' => 0, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'fechaReceta' => ($oTabla->fechaReceta == 0)? Null: $oTabla->fechaReceta, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioReceta' => ($oTabla->idServicioReceta == 0)? Null: $oTabla->idServicioReceta, 
			'idEstado' => ($oTabla->idEstado == 0)? Null: $oTabla->idEstado, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idMedicoReceta' => ($oTabla->idMedicoReceta == 0)? Null: $oTabla->idMedicoReceta, 
			'fechaVigencia' => ($oTabla->fechaVigencia == 0)? Null: $oTabla->fechaVigencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC RecetaCabeceraModificar :idReceta, :idPuntoCarga, :fechaReceta, :idCuentaAtencion, :idServicioReceta, :idEstado, :idComprobantePago, :idMedicoReceta, :fechaVigencia, :idUsuarioAuditoria";

		$params = [
			'idReceta' => ($oTabla->idReceta == 0)? Null: $oTabla->idReceta, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'fechaReceta' => ($oTabla->fechaReceta == 0)? Null: $oTabla->fechaReceta, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idServicioReceta' => ($oTabla->idServicioReceta == 0)? Null: $oTabla->idServicioReceta, 
			'idEstado' => ($oTabla->idEstado == 0)? Null: $oTabla->idEstado, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idMedicoReceta' => ($oTabla->idMedicoReceta == 0)? Null: $oTabla->idMedicoReceta, 
			'fechaVigencia' => ($oTabla->fechaVigencia == 0)? Null: $oTabla->fechaVigencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC RecetaCabeceraEliminar :idReceta, :idUsuarioAuditoria";

		$params = [
			'idReceta' => $oTabla->idReceta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC RecetaCabeceraSeleccionarPorId :idReceta";

		$params = [
			'idReceta' => $oTabla->idReceta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdComprobantePago($oTabla)
	{
		$query = "
			EXEC RecetaCabeceraSeleccionarPorIdComprobantePago :idComprobantePago";

		$params = [
			'idComprobantePago' => $oTabla->idComprobantePago, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdCuentaAtencion($lnIdCuentaAtencion)
	{
		$query = "
			EXEC RecetaCabeceraSeleccionarPorIdCuentaAtencion :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $lnIdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ConsultaRecetaCabeceraFarmacia($oTabla, $lcDocumentoDespacho)
	{
		$query = "
			EXEC ConsultaRecetaCabeceraXIdPuntoCarga :documentoDespacho";

		$params = [
			'documentoDespacho' => $lcDocumentoDespacho, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function InsertarSolProc($oTabla)
	{
		$query = "
			DECLARE @idSolicitudProc AS Int = :idSolicitudProc
			SET NOCOUNT ON 
			EXEC OtrosCptAgregar @idSolicitudProc OUTPUT, :idCuenta, :idProducto, :cantidad, :et oParameter = .CreateParamete, :observación, :idUsuario
			SELECT @idSolicitudProc AS idSolicitudProc";

		$params = [
			'idSolicitudProc' => 0, 
			'idCuenta' => ($oTabla->idCuenta == 0)? Null: $oTabla->idCuenta, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidad' => ($oTabla->cantidad == "")? "": $oTabla->cantidad, 
			'et oParameter = .CreateParamete' => 0, 
			'observación' => ($oTabla->observación == "")? "": $oTabla->observación, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function ModificarSolProc($oTabla)
	{
		$query = "
			EXEC OtrosCptModificar :idSolicitudProc, :cantidad, :observación";

		$params = [
			'idSolicitudProc' => ($oTabla->idSolicitudProc == 0)? Null: $oTabla->idSolicitudProc, 
			'cantidad' => ($oTabla->cantidad == "")? "": $oTabla->cantidad, 
			'observación' => ($oTabla->observación == "")? "": $oTabla->observación, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function CargarProcedimientosCE($oTabla)
	{
		$query = "
			EXEC ListarOtrosProcedimientos :idCuenta";

		$params = [
			'idCuenta' => $oTabla->idCuenta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarExamenCPT($oTabla)
	{
		$query = "
			EXEC ExamenesCptEliminar :idSolicitudProc";

		$params = [
			'idSolicitudProc' => $oTabla->idSolicitudProc, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}