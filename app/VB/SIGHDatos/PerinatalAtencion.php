<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class PerinatalAtencion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPerinatalAtencion AS Int = :idPerinatalAtencion
			SET NOCOUNT ON 
			EXEC PerinatalAtencionAgregar @idPerinatalAtencion OUTPUT, :idPaciente, :idModulo, :grafXedadEnMeses, :grafYpercentilTE, :grafYpercentilPT, :grafYpercentilPE, :grafYimc, :fechaAtencion, :idUsuarioAuditoria
			SELECT @idPerinatalAtencion AS idPerinatalAtencion";

		$params = [
			'idPerinatalAtencion' => 0, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idModulo' => ($oTabla->idModulo == 0)? Null: $oTabla->idModulo, 
			'grafXedadEnMeses' => ($oTabla->grafXedadEnMeses == 0)? Null: $oTabla->grafXedadEnMeses, 
			'grafYpercentilTE' => ($oTabla->grafYpercentilTE == lnPercentilNull)? 0: $oTabla->grafYpercentilTE, 
			'grafYpercentilPT' => ($oTabla->grafYpercentilPT == lnPercentilNull)? 0: $oTabla->grafYpercentilPT, 
			'grafYpercentilPE' => ($oTabla->grafYpercentilPE == lnPercentilNull)? 0: $oTabla->grafYpercentilPE, 
			'grafYimc' => ($oTabla->grafYimc == lnPercentilNull)? Null: $oTabla->grafYimc, 
			'fechaAtencion' => ($oTabla->fechaAtencion == 0)? Null: $oTabla->fechaAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionModificar :idPerinatalAtencion, :idPaciente, :idModulo, :grafXedadEnMeses, :grafYpercentilTE, :grafYpercentilPT, :grafYpercentilPE, :grafYimc, :fechaAtencion, :idUsuarioAuditoria";

		$params = [
			'idPerinatalAtencion' => ($oTabla->idPerinatalAtencion == 0)? Null: $oTabla->idPerinatalAtencion, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idModulo' => ($oTabla->idModulo == 0)? Null: $oTabla->idModulo, 
			'grafXedadEnMeses' => ($oTabla->grafXedadEnMeses == 0)? Null: $oTabla->grafXedadEnMeses, 
			'grafYpercentilTE' => ($oTabla->grafYpercentilTE == lnPercentilNull)? Null: $oTabla->grafYpercentilTE, 
			'grafYpercentilPT' => ($oTabla->grafYpercentilPT == lnPercentilNull)? Null: $oTabla->grafYpercentilPT, 
			'grafYpercentilPE' => ($oTabla->grafYpercentilPE == lnPercentilNull)? Null: $oTabla->grafYpercentilPE, 
			'grafYimc' => ($oTabla->grafYimc == lnPercentilNull)? Null: $oTabla->grafYimc, 
			'fechaAtencion' => ($oTabla->fechaAtencion == 0)? Null: $oTabla->fechaAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionEliminar :idPerinatalAtencion, :idUsuarioAuditoria";

		$params = [
			'idPerinatalAtencion' => $oTabla->idPerinatalAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionSeleccionarPorId :idPerinatalAtencion";

		$params = [
			'idPerinatalAtencion' => $oTabla->idPerinatalAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdAtencion($oTabla, $lnIdAtencion)
	{
		$query = "
			EXEC PerinatalAtencionSeleccionarPorIdAtencion :idAtencion";

		$params = [
			'idAtencion' => $lnIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdPaciente($oTabla, $lnIdPaciente, $ldFechaAtencion)
	{
		$query = "
			EXEC PerinatalAtencionXidPaciente :lnIdPaciente";

		$params = [
			'lnIdPaciente' => $lnIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}