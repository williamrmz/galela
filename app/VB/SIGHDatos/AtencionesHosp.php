<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionesHosp extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAtencionHospitalizacion AS Int = :idAtencionHospitalizacion
			SET NOCOUNT ON 
			EXEC AtencionesHospitalizacionAgregar :idCamaEgreso, :idCamaIngreso, :tieneNecropsia, :huboInfeccionIntraHospitalaria, :idServicioEgreso, :idTipoAlta, :idCondicionAlta, :idAtencion, @idAtencionHospitalizacion OUTPUT, :horaEgresoAdministrativo, :fechaEgresoAdministrativo, :idUsuarioAuditoria
			SELECT @idAtencionHospitalizacion AS idAtencionHospitalizacion";

		$params = [
			'idCamaEgreso' => ($oTabla->idCamaEgreso == 0)? Null: $oTabla->idCamaEgreso, 
			'idCamaIngreso' => ($oTabla->idCamaIngreso == 0)? Null: $oTabla->idCamaIngreso, 
			'tieneNecropsia' => ($oTabla->tieneNecropsia == 0)? Null: $oTabla->tieneNecropsia, 
			'huboInfeccionIntraHospitalaria' => ($oTabla->huboInfeccionIntraHospitalaria == 0)? Null: $oTabla->huboInfeccionIntraHospitalaria, 
			'idServicioEgreso' => ($oTabla->idServicioEgreso == 0)? Null: $oTabla->idServicioEgreso, 
			'idTipoAlta' => ($oTabla->idTipoAlta == 0)? Null: $oTabla->idTipoAlta, 
			'idCondicionAlta' => ($oTabla->idCondicionAlta == 0)? Null: $oTabla->idCondicionAlta, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idAtencionHospitalizacion' => 0, 
			'horaEgresoAdministrativo' => ($oTabla->horaEgresoAdministrativo == "")? Null: $oTabla->horaEgresoAdministrativo, 
			'fechaEgresoAdministrativo' => ($oTabla->fechaEgresoAdministrativo == 0)? Null: $oTabla->fechaEgresoAdministrativo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionesHospitalizacionModificar :idCamaEgreso, :idCamaIngreso, :tieneNecropsia, :huboInfeccionIntraHospitalaria, :idServicioEgreso, :idTipoAlta, :idCondicionAlta, :idAtencion, :idAtencionHospitalizacion, :horaEgresoAdministrativo, :fechaEgresoAdministrativo, :idUsuarioAuditoria";

		$params = [
			'idCamaEgreso' => ($oTabla->idCamaEgreso == 0)? Null: $oTabla->idCamaEgreso, 
			'idCamaIngreso' => ($oTabla->idCamaIngreso == 0)? Null: $oTabla->idCamaIngreso, 
			'tieneNecropsia' => ($oTabla->tieneNecropsia == 0)? Null: $oTabla->tieneNecropsia, 
			'huboInfeccionIntraHospitalaria' => ($oTabla->huboInfeccionIntraHospitalaria == 0)? Null: $oTabla->huboInfeccionIntraHospitalaria, 
			'idServicioEgreso' => ($oTabla->idServicioEgreso == 0)? Null: $oTabla->idServicioEgreso, 
			'idTipoAlta' => ($oTabla->idTipoAlta == 0)? Null: $oTabla->idTipoAlta, 
			'idCondicionAlta' => ($oTabla->idCondicionAlta == 0)? Null: $oTabla->idCondicionAlta, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idAtencionHospitalizacion' => ($oTabla->idAtencionHospitalizacion == 0)? Null: $oTabla->idAtencionHospitalizacion, 
			'horaEgresoAdministrativo' => ($oTabla->horaEgresoAdministrativo == "")? Null: $oTabla->horaEgresoAdministrativo, 
			'fechaEgresoAdministrativo' => ($oTabla->fechaEgresoAdministrativo == 0)? Null: $oTabla->fechaEgresoAdministrativo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionesHospitalizacionEliminar :idAtencionHospitalizacion, :idUsuarioAuditoria";

		$params = [
			'idAtencionHospitalizacion' => ($oTabla->idAtencionHospitalizacion == 0)? Null: $oTabla->idAtencionHospitalizacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionesHospitalizacionSeleccionarPorId :idAtencionHospitalizacion";

		$params = [
			'idAtencionHospitalizacion' => $oTabla->idAtencionHospitalizacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarIdPorIdAtencion($lIdAtencion)
	{
		$query = "
			DECLARE @idAtencionHospitalizacion AS Int = :idAtencionHospitalizacion
			SET NOCOUNT ON 
			EXEC AtencionesHospitalizacionSeleccionarIdPorIdAtencion :idAtencion, @idAtencionHospitalizacion OUTPUT
			SELECT @idAtencionHospitalizacion AS idAtencionHospitalizacion";

		$params = [
			'idAtencion' => $lIdAtencion, 
			'idAtencionHospitalizacion' => 0, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

}