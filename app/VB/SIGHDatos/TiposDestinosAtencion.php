<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposDestinosAtencion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idDestinoAtencion AS Int = :idDestinoAtencion
			SET NOCOUNT ON 
			EXEC TiposDestinoAtencionAgregar :idTipoServicio, :descripcion, :codigo, @idDestinoAtencion OUTPUT, :idUsuarioAuditoria
			SELECT @idDestinoAtencion AS idDestinoAtencion";

		$params = [
			'idTipoServicio' => ($oTabla->idTipoServicio == 0)? Null: $oTabla->idTipoServicio, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idDestinoAtencion' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposDestinoAtencionModificar :idTipoServicio, :descripcion, :codigo, :idDestinoAtencion, :idUsuarioAuditoria";

		$params = [
			'idTipoServicio' => ($oTabla->idTipoServicio == 0)? Null: $oTabla->idTipoServicio, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idDestinoAtencion' => ($oTabla->idDestinoAtencion == 0)? Null: $oTabla->idDestinoAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposDestinoAtencionEliminar :idDestinoAtencion, :idUsuarioAuditoria";

		$params = [
			'idDestinoAtencion' => ($oTabla->idDestinoAtencion == 0)? Null: $oTabla->idDestinoAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposDestinoAtencionSeleccionarPorId :idDestinoAtencion";

		$params = [
			'idDestinoAtencion' => $oTabla->idDestinoAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDestinosDeObsEmergencia()
	{
		$query = "
			EXEC TiposDestinoAtencionSeleccionarDestinosDeObsEmergencia ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDestinosDeConsultorioEmergencia()
	{
		$query = "
			EXEC TiposDestinoAtencionSeleccionarDestinosDeConsultorioEmergencia ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDestinosDeHospitalizacion($lnTipoServicioHospitalizacion)
	{
		$query = "
			EXEC TiposDestinoAtencionSeleccionarDestinosDeHospitalizacion :tipoServicioHosp";

		$params = [
			'tipoServicioHosp' => $lnTipoServicioHospitalizacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDestinosDeConsultoriosExternos()
	{
		$query = "
			EXEC TiposDestinoAtencionSeleccionarDestinosDeConsultorioExterno ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDestinosDeConsultoriosExternosXIdCuentaAtencion($ml_IdCuentaAtencion)
	{
		dd( "NO EXISTE PROC:  SeleccionarDestinosDeConsultoriosExternosXIdCuentaAtencion( @idCuentaAtencion )");
		$query = "
			EXEC TiposDestinoAtencionSeleccionarDestinosDeConsultorioExternoXIdcuentaAtencion :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $ml_IdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigo($oTabla)
	{
		$query = "
			EXEC TiposDestinoAtencionXidtipoServicioCodigo :idTipoServicio, :codigo, :descripcion";

		$params = [
			'idTipoServicio' => $oTabla->idTipoServicio, 
			'codigo' => $oTabla->codigo, 
			'descripcion' => $oTabla->codigo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}