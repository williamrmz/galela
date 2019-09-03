<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class LabPruebas extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPrueba AS Int = :idPrueba
			SET NOCOUNT ON 
			EXEC labPruebasAgregar @idPrueba OUTPUT, :codigoPrueba, :codigoCPT, :idUsuarioAuditoria
			SELECT @idPrueba AS idPrueba";

		$params = [
			'idPrueba' => 0, 
			'codigoPrueba' => ($oTabla->codigoPrueba == "")? Null: $oTabla->codigoPrueba, 
			'codigoCPT' => ($oTabla->codigoCPT == "")? Null: $oTabla->codigoCPT, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC labPruebasModificar :idPrueba, :codigoPrueba, :codigoCPT, :idUsuarioAuditoria";

		$params = [
			'idPrueba' => ($oTabla->idPrueba == 0)? Null: $oTabla->idPrueba, 
			'codigoPrueba' => ($oTabla->codigoPrueba == "")? Null: $oTabla->codigoPrueba, 
			'codigoCPT' => ($oTabla->codigoCPT == "")? Null: $oTabla->codigoCPT, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC labPruebasEliminar :idPrueba, :idUsuarioAuditoria";

		$params = [
			'idPrueba' => $oTabla->idPrueba, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC labPruebasSeleccionarPorId :idPrueba";

		$params = [
			'idPrueba' => $oTabla->idPrueba, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}