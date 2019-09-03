<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class PadronNominal_Cabecera extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPaNomCabecera AS Int = :idPaNomCabecera
			SET NOCOUNT ON 
			EXEC PadronNominal_CabeceraAgregar @idPaNomCabecera OUTPUT, :idResponsableAtencion, :idCodigoRenaes, :mes, :año, :idUsuarioAuditoria
			SELECT @idPaNomCabecera AS idPaNomCabecera";

		$params = [
			'idPaNomCabecera' => 0, 
			'idResponsableAtencion' => ($oTabla->idResponsableAtencion == 0)? Null: $oTabla->idResponsableAtencion, 
			'idCodigoRenaes' => ($oTabla->idCodigoRenaes == 0)? Null: $oTabla->idCodigoRenaes, 
			'mes' => ($oTabla->mes == 0)? Null: $oTabla->mes, 
			'año' => ($oTabla->año == "")? Null: $oTabla->año, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PadronNominal_CabeceraModificar :idPaNomCabecera, :idResponsableAtencion, :idCodigoRenaes, :mes, :año, :idUsuarioAuditoria";

		$params = [
			'idPaNomCabecera' => ($oTabla->idPaNomCabecera == 0)? Null: $oTabla->idPaNomCabecera, 
			'idResponsableAtencion' => ($oTabla->idResponsableAtencion == 0)? Null: $oTabla->idResponsableAtencion, 
			'idCodigoRenaes' => ($oTabla->idCodigoRenaes == 0)? Null: $oTabla->idCodigoRenaes, 
			'mes' => ($oTabla->mes == 0)? Null: $oTabla->mes, 
			'año' => ($oTabla->año == "")? Null: $oTabla->año, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PadronNominal_CabeceraEliminar :idPaNomCabecera, :idUsuarioAuditoria";

		$params = [
			'idPaNomCabecera' => $oTabla->idPaNomCabecera, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC PadronNominal_CabeceraSeleccionarPorId :idPaNomCabecera";

		$params = [
			'idPaNomCabecera' => $oTabla->idPaNomCabecera, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}