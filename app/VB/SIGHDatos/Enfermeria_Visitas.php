<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Enfermeria_Visitas extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC Enfermeria_VisitasAgregar :idCuentaAtencion, :idVisita, :fechaHoraVisita, :idServicio, :observaciones, :idCama, :idEmpleadoEnfermera, :idUsuarioAuditoria, :ingresoValorizacion";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idVisita' => $oTabla->idVisita, 
			'fechaHoraVisita' => ($oTabla->fechaHoraVisita == 0)? Null: $oTabla->fechaHoraVisita, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'observaciones' => $oTabla->observaciones, 
			'idCama' => $oTabla->idCama, 
			'idEmpleadoEnfermera' => ($oTabla->idEmpleadoEnfermera == 0)? Null: $oTabla->idEmpleadoEnfermera, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'ingresoValorizacion' => $oTabla->ingresoValorizacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC Enfermeria_VisitasModificar :idCuentaAtencion, :idVisita, :fechaHoraVisita, :idServicio, :observaciones, :idCama, :idEmpleadoEnfermera, :idUsuarioAuditoria, :ingresoValorizacion";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idVisita' => ($oTabla->idVisita == 0)? Null: $oTabla->idVisita, 
			'fechaHoraVisita' => ($oTabla->fechaHoraVisita == 0)? Null: $oTabla->fechaHoraVisita, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'observaciones' => ($oTabla->observaciones == "")? Null: $oTabla->observaciones, 
			'idCama' => ($oTabla->idCama == 0)? Null: $oTabla->idCama, 
			'idEmpleadoEnfermera' => ($oTabla->idEmpleadoEnfermera == 0)? Null: $oTabla->idEmpleadoEnfermera, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'ingresoValorizacion' => $oTabla->ingresoValorizacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($lnIdCuentaAtencion, $lnIdVisita)
	{
		$query = "
			EXEC Enfermeria_VisitasEliminar :idCuentaAtencion, :idVisita, :idUsuarioAuditoria";

		$params = [
			'idCuentaAtencion' => $lnIdCuentaAtencion, 
			'idVisita' => $lnIdVisita, 
			'idUsuarioAuditoria' => 0, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC Enfermeria_VisitasSeleccionarPorId :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $oTabla->idCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}