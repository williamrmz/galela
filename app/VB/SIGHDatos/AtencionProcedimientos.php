<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionProcedimientos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAtencionProcedimiento AS Int = :idAtencionProcedimiento
			SET NOCOUNT ON 
			EXEC AtencionProcedimientosAgregar :idServicioOrdena, :idMedicoOrdena, :idCuentaAtencion, :horaOrden, :fechaOrden, :nroOrden, @idAtencionProcedimiento OUTPUT, :idUsuarioAuditoria
			SELECT @idAtencionProcedimiento AS idAtencionProcedimiento";

		$params = [
			'idServicioOrdena' => ($oTabla->idServicioOrdena == 0)? Null: $oTabla->idServicioOrdena, 
			'idMedicoOrdena' => ($oTabla->idMedicoOrdena == 0)? Null: $oTabla->idMedicoOrdena, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'horaOrden' => ($oTabla->horaOrden == "")? Null: $oTabla->horaOrden, 
			'fechaOrden' => ($oTabla->fechaOrden == 0)? Null: $oTabla->fechaOrden, 
			'nroOrden' => ($oTabla->nroOrden == "")? Null: $oTabla->nroOrden, 
			'idAtencionProcedimiento' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionProcedimientosModificar :idServicioOrdena, :idMedicoOrdena, :idCuentaAtencion, :horaOrden, :fechaOrden, :nroOrden, :idAtencionProcedimiento, :idUsuarioAuditoria";

		$params = [
			'idServicioOrdena' => ($oTabla->idServicioOrdena == 0)? Null: $oTabla->idServicioOrdena, 
			'idMedicoOrdena' => ($oTabla->idMedicoOrdena == 0)? Null: $oTabla->idMedicoOrdena, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'horaOrden' => ($oTabla->horaOrden == "")? Null: $oTabla->horaOrden, 
			'fechaOrden' => ($oTabla->fechaOrden == 0)? Null: $oTabla->fechaOrden, 
			'nroOrden' => ($oTabla->nroOrden == "")? Null: $oTabla->nroOrden, 
			'idAtencionProcedimiento' => ($oTabla->idAtencionProcedimiento == 0)? Null: $oTabla->idAtencionProcedimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionProcedimientosEliminar :idAtencionProcedimiento, :idUsuarioAuditoria";

		$params = [
			'idAtencionProcedimiento' => ($oTabla->idAtencionProcedimiento == 0)? Null: $oTabla->idAtencionProcedimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionProcedimientosSeleccionarPorId :idAtencionProcedimiento";

		$params = [
			'idAtencionProcedimiento' => $oTabla->idAtencionProcedimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oTabla, $oDOPaciente)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCuentaAtencionSinIterconsultas($lIdCuentaAtencion)
	{
		$query = "
			EXEC AtencionesProcedimientosSeleccionarPorCuentaAtencionSinInterconsulta :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $lIdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCuentaAtencionEIterconsulta($lIdCuentaAtencion, $lIdInterconsulta)
	{
		$query = "
			EXEC AtencionesProcedimientosSeleccionarPorCuentaAtencionEInterconsulta :idCuentaAtencion, :idInterconsulta";

		$params = [
			'idCuentaAtencion' => $lIdCuentaAtencion, 
			'idInterconsulta' => $lIdInterconsulta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarProcedimientosAtencion($oProcedimientos, $lIdCuentaAtencion)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarProcedimientosInterconsultas($oProcedimientos, $lIdCuentaAtencion, $lIdInterconsulta)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarProcedimientosPorCuentaAtencion($lIdCuentaAtencion)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarProcedimientos($lIdCuentaAtencion)
	{
		$query = "
			EXEC AtencionesProcedimientosSeleccionarPorCuentaAtencion :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $lIdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}