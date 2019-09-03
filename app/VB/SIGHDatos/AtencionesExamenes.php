<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionesExamenes extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAtencionExamen AS Int = :idAtencionExamen
			SET NOCOUNT ON 
			EXEC AtencionesExamenesAgregar :idDetalleProducto, :horaOrden, :idServicioOrdena, :idExamen, :fechaOrden, :ordenNro, :idMedicoOrdena, :idCuentaAtencion, :horaResultado, :fechaResultado, @idAtencionExamen OUTPUT, :idUsuarioAuditoria
			SELECT @idAtencionExamen AS idAtencionExamen";

		$params = [
			'idDetalleProducto' => ($oTabla->idDetalleProducto == 0)? Null: $oTabla->idDetalleProducto, 
			'horaOrden' => ($oTabla->horaOrden == "")? Null: $oTabla->horaOrden, 
			'idServicioOrdena' => ($oTabla->idServicioOrdena == 0)? Null: $oTabla->idServicioOrdena, 
			'idExamen' => ($oTabla->idExamen == 0)? Null: $oTabla->idExamen, 
			'fechaOrden' => ($oTabla->fechaOrden == 0)? Null: $oTabla->fechaOrden, 
			'ordenNro' => ($oTabla->ordenNro == "")? Null: $oTabla->ordenNro, 
			'idMedicoOrdena' => ($oTabla->idMedicoOrdena == 0)? Null: $oTabla->idMedicoOrdena, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'horaResultado' => ($oTabla->horaResultado == "")? Null: $oTabla->horaResultado, 
			'fechaResultado' => ($oTabla->fechaResultado == 0)? Null: $oTabla->fechaResultado, 
			'idAtencionExamen' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionesExamenesModificar :idDetalleProducto, :horaOrden, :idServicioOrdena, :idExamen, :fechaOrden, :ordenNro, :idMedicoOrdena, :idCuentaAtencion, :horaResultado, :fechaResultado, :idAtencionExamen, :idUsuarioAuditoria";

		$params = [
			'idDetalleProducto' => ($oTabla->idDetalleProducto == 0)? Null: $oTabla->idDetalleProducto, 
			'horaOrden' => ($oTabla->horaOrden == "")? Null: $oTabla->horaOrden, 
			'idServicioOrdena' => ($oTabla->idServicioOrdena == 0)? Null: $oTabla->idServicioOrdena, 
			'idExamen' => ($oTabla->idExamen == 0)? Null: $oTabla->idExamen, 
			'fechaOrden' => ($oTabla->fechaOrden == 0)? Null: $oTabla->fechaOrden, 
			'ordenNro' => ($oTabla->ordenNro == "")? Null: $oTabla->ordenNro, 
			'idMedicoOrdena' => ($oTabla->idMedicoOrdena == 0)? Null: $oTabla->idMedicoOrdena, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'horaResultado' => ($oTabla->horaResultado == "")? Null: $oTabla->horaResultado, 
			'fechaResultado' => ($oTabla->fechaResultado == 0)? Null: $oTabla->fechaResultado, 
			'idAtencionExamen' => ($oTabla->idAtencionExamen == 0)? Null: $oTabla->idAtencionExamen, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionesExamenesEliminar :idAtencionExamen, :idUsuarioAuditoria";

		$params = [
			'idAtencionExamen' => ($oTabla->idAtencionExamen == 0)? Null: $oTabla->idAtencionExamen, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionesExamenesSeleccionarPorId :idAtencionExamen";

		$params = [
			'idAtencionExamen' => $oTabla->idAtencionExamen, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCuentaAtencion($lIdCuentaAtencion)
	{
		$query = "
			EXEC AtencionesExamenesSeleccionarPorCuentaAtencion :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $lIdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarExamenesAtencion($oExamenes, $lIdCuentaAtencion)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarExamenesPorCuentaAtencion($lIdCuentaAtencion)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}