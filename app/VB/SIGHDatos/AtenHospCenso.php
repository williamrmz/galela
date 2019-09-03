<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenHospCenso extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC AtenHospCensoAgregar :idRangoCensoHosp, :rangoInicial, :rangoFinal, :rGBRojo, :rGBVerde, :rGBAzul, :idUsuarioAuditoria";

		$params = [
			'idRangoCensoHosp' => ($oTabla->idRangoCensoHosp == 0)? Null: $oTabla->idRangoCensoHosp, 
			'rangoInicial' => $oTabla->rangoInicial, 
			'rangoFinal' => $oTabla->rangoFinal, 
			'rGBRojo' => ($oTabla->rGBRojo == 0)? Null: $oTabla->rGBRojo, 
			'rGBVerde' => ($oTabla->rGBVerde == 0)? Null: $oTabla->rGBVerde, 
			'rGBAzul' => ($oTabla->rGBAzul == 0)? Null: $oTabla->rGBAzul, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtenHospCensoModificar :idRangoCensoHosp, :rangoInicial, :rangoFinal, :rGBRojo, :rGBVerde, :rGBAzul, :idUsuarioAuditoria";

		$params = [
			'idRangoCensoHosp' => ($oTabla->idRangoCensoHosp == 0)? Null: $oTabla->idRangoCensoHosp, 
			'rangoInicial' => $oTabla->rangoInicial, 
			'rangoFinal' => $oTabla->rangoFinal, 
			'rGBRojo' => ($oTabla->rGBRojo == 0)? Null: $oTabla->rGBRojo, 
			'rGBVerde' => ($oTabla->rGBVerde == 0)? Null: $oTabla->rGBVerde, 
			'rGBAzul' => ($oTabla->rGBAzul == 0)? Null: $oTabla->rGBAzul, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenHospCensoEliminar :idRangoCensoHosp, :idUsuarioAuditoria";

		$params = [
			'idRangoCensoHosp' => $oTabla->idRangoCensoHosp, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenHospCensoSeleccionarPorId :idRangoCensoHosp";

		$params = [
			'idRangoCensoHosp' => $oTabla->idRangoCensoHosp, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}