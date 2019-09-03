<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionApoyoDiagnostico extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAtencionApoyoDx AS Int = :idAtencionApoyoDx
			SET NOCOUNT ON 
			EXEC AtencionApoyoDiagnosticoAgregar :idServicioOrdena, :horaOrden, :fechaOrden, :ordenNro, :idMedicoOrdena, :idCuentaAtencion, @idAtencionApoyoDx OUTPUT, :idUsuarioAuditoria
			SELECT @idAtencionApoyoDx AS idAtencionApoyoDx";

		$params = [
			'idServicioOrdena' => ($oTabla->idServicioOrdena == 0)? Null: $oTabla->idServicioOrdena, 
			'horaOrden' => ($oTabla->horaOrden == "")? Null: $oTabla->horaOrden, 
			'fechaOrden' => ($oTabla->fechaOrden == 0)? Null: $oTabla->fechaOrden, 
			'ordenNro' => ($oTabla->ordenNro == "")? Null: $oTabla->ordenNro, 
			'idMedicoOrdena' => ($oTabla->idMedicoOrdena == 0)? Null: $oTabla->idMedicoOrdena, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idAtencionApoyoDx' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionApoyoDiagnosticoModificar :idServicioOrdena, :horaOrden, :fechaOrden, :ordenNro, :idMedicoOrdena, :idCuentaAtencion, :idAtencionApoyoDx, :idUsuarioAuditoria";

		$params = [
			'idServicioOrdena' => ($oTabla->idServicioOrdena == 0)? Null: $oTabla->idServicioOrdena, 
			'horaOrden' => ($oTabla->horaOrden == "")? Null: $oTabla->horaOrden, 
			'fechaOrden' => ($oTabla->fechaOrden == 0)? Null: $oTabla->fechaOrden, 
			'ordenNro' => ($oTabla->ordenNro == "")? Null: $oTabla->ordenNro, 
			'idMedicoOrdena' => ($oTabla->idMedicoOrdena == 0)? Null: $oTabla->idMedicoOrdena, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idAtencionApoyoDx' => ($oTabla->idAtencionApoyoDx == 0)? Null: $oTabla->idAtencionApoyoDx, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionApoyoDiagnosticoEliminar :idAtencionApoyoDx, :idUsuarioAuditoria";

		$params = [
			'idAtencionApoyoDx' => ($oTabla->idAtencionApoyoDx == 0)? Null: $oTabla->idAtencionApoyoDx, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionApoyoDiagnosticoSeleccionarPorId :idAtencionApoyoDx";

		$params = [
			'idAtencionApoyoDx' => $oTabla->idAtencionApoyoDx, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oTabla, $oDOPaciente, $lDepartamento)
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

}