<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposNumeracionHistoria extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTipoNumeracion AS Int = :idTipoNumeracion
			SET NOCOUNT ON 
			EXEC TiposNumeracionHistoriaAgregar :descripcion, @idTipoNumeracion OUTPUT, :idUsuarioAuditoria
			SELECT @idTipoNumeracion AS idTipoNumeracion";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoNumeracion' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposNumeracionHistoriaModificar :descripcion, :idTipoNumeracion, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoNumeracion' => ($oTabla->idTipoNumeracion == 0)? Null: $oTabla->idTipoNumeracion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposNumeracionHistoriaEliminar :idTipoNumeracion, :idUsuarioAuditoria";

		$params = [
			'idTipoNumeracion' => ($oTabla->idTipoNumeracion == 0)? Null: $oTabla->idTipoNumeracion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposNumeracionHistoriaSeleccionarPorId :idTipoNumeracion";

		$params = [
			'idTipoNumeracion' => $oTabla->idTipoNumeracion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposNumeracionHistoriaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDefinitivos($lIdTipoAdicional)
	{
		$query = "
			EXEC TiposNumeracionHistoriaSeleccionarDefinitivos :idTipoAdicional";

		$params = [
			'idTipoAdicional' => ($lIdTipoAdicional == 0)? Null: $lIdTipoAdicional, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDeConsultaExterna()
	{
		$query = "
			EXEC TiposNumeracionHistoriaSeleccionarDeConsultaExterna ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDeEmergencia()
	{
		$query = "
			EXEC TiposNumeracionHistoriaSeleccionarDeEmergencia ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDeHospitalizacion()
	{
		$query = "
			EXEC TiposNumeracionHistoriaSeleccionarDeHospitalizacion ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}