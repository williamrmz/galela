<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposOrigenAtencion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idOrigenAtencion AS Int = :idOrigenAtencion
			SET NOCOUNT ON 
			EXEC TiposOrigenAtencionAgregar :idTipoServicio, :descripcion, :codigo, @idOrigenAtencion OUTPUT, :idUsuarioAuditoria
			SELECT @idOrigenAtencion AS idOrigenAtencion";

		$params = [
			'idTipoServicio' => ($oTabla->idTipoServicio == 0)? Null: $oTabla->idTipoServicio, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idOrigenAtencion' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposOrigenAtencionModificar :idTipoServicio, :descripcion, :codigo, :idOrigenAtencion, :idUsuarioAuditoria";

		$params = [
			'idTipoServicio' => ($oTabla->idTipoServicio == 0)? Null: $oTabla->idTipoServicio, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idOrigenAtencion' => ($oTabla->idOrigenAtencion == 0)? Null: $oTabla->idOrigenAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposOrigenAtencionEliminar :idOrigenAtencion, :idUsuarioAuditoria";

		$params = [
			'idOrigenAtencion' => ($oTabla->idOrigenAtencion == 0)? Null: $oTabla->idOrigenAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposOrigenAtencionSeleccionarPorId :idOrigenAtencion";

		$params = [
			'idOrigenAtencion' => $oTabla->idOrigenAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarViasDeObservacionEmergencia()
	{
		$query = "
			EXEC TiposOrigenAtencionSeleccionarViasDeObservacionEmergencia ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarViasDeConsultorioEmergencia()
	{
		$query = "
			EXEC TiposOrigenAtencionSeleccionarViasDeConsultoriosEmergencia ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarViasDeHospitalizacion($lnTipoServicioHospitalizacion)
	{
		$query = "
			EXEC TiposOrigenAtencionSeleccionarViasDeHospitalizacion :tipoServicioHosp";

		$params = [
			'tipoServicioHosp' => $lnTipoServicioHospitalizacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarViasDeConsultoriosExternos()
	{
		$query = "
			EXEC TiposOrigenAtencionSeleccionarViasDeConsultoriosExternos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigo($oTabla)
	{
		$query = "
			EXEC TiposOrigenAtencionXcodigoTipoServicio :codigo, :idTipoServicio";

		$params = [
			'codigo' => $oTabla->codigo, 
			'idTipoServicio' => $oTabla->idTipoServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}