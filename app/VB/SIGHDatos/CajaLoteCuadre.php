<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CajaLoteCuadre extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idLoteCuadre AS Int = :idLoteCuadre
			SET NOCOUNT ON 
			EXEC CajaLoteCuadreAgregar :idLote, :diferencia, :cuadreUsuario, :calculado, @idLoteCuadre OUTPUT, :idTipoFormaPago, :idUsuarioAuditoria
			SELECT @idLoteCuadre AS idLoteCuadre";

		$params = [
			'idLote' => ($oTabla->idLote == 0)? Null: $oTabla->idLote, 
			'diferencia' => ($oTabla->diferencia == 0)? Null: $oTabla->diferencia, 
			'cuadreUsuario' => ($oTabla->cuadreUsuario == 0)? Null: $oTabla->cuadreUsuario, 
			'calculado' => ($oTabla->calculado == 0)? Null: $oTabla->calculado, 
			'idLoteCuadre' => 0, 
			'idTipoFormaPago' => ($oTabla->idTipoFormaPago == 0)? Null: $oTabla->idTipoFormaPago, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CajaLoteCuadreModificar :idLote, :diferencia, :cuadreUsuario, :calculado, :idLoteCuadre, :idTipoFormaPago, :idUsuarioAuditoria";

		$params = [
			'idLote' => ($oTabla->idLote == 0)? Null: $oTabla->idLote, 
			'diferencia' => ($oTabla->diferencia == 0)? Null: $oTabla->diferencia, 
			'cuadreUsuario' => ($oTabla->cuadreUsuario == 0)? Null: $oTabla->cuadreUsuario, 
			'calculado' => ($oTabla->calculado == 0)? Null: $oTabla->calculado, 
			'idLoteCuadre' => ($oTabla->idLoteCuadre == 0)? Null: $oTabla->idLoteCuadre, 
			'idTipoFormaPago' => ($oTabla->idTipoFormaPago == 0)? Null: $oTabla->idTipoFormaPago, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CajaLoteCuadreEliminar :idLoteCuadre, :idUsuarioAuditoria";

		$params = [
			'idLoteCuadre' => ($oTabla->idLoteCuadre == 0)? Null: $oTabla->idLoteCuadre, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC Select * from CajaLoteCuadre where IdLoteCuadre = ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RealizarFiltro($oLote)
	{
		$query = "
			EXEC CommandText = SQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}