<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ImagSalaPuntoCarga extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC ImagSalaPuntoCargaAgregar :idSala, :idPuntoCarga, :esActivo, :fechsCrea, :fechaEdita, :idUsuarioAuditoria";

		$params = [
			'idSala' => ($oTabla->idSala == 0)? Null: $oTabla->idSala, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'esActivo' => ($oTabla->esActivo == 0)? Null: $oTabla->esActivo, 
			'fechsCrea' => ($oTabla->fechsCrea == 0)? Null: $oTabla->fechsCrea, 
			'fechaEdita' => ($oTabla->fechaEdita == 0)? Null: $oTabla->fechaEdita, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ImagSalaPuntoCargaModificar :idSala, :idPuntoCarga, :esActivo, :fechsCrea, :fechaEdita, :idUsuarioAuditoria";

		$params = [
			'idSala' => ($oTabla->idSala == 0)? Null: $oTabla->idSala, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'esActivo' => ($oTabla->esActivo == 0)? Null: $oTabla->esActivo, 
			'fechsCrea' => ($oTabla->fechsCrea == 0)? Null: $oTabla->fechsCrea, 
			'fechaEdita' => ($oTabla->fechaEdita == 0)? Null: $oTabla->fechaEdita, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ImagSalaPuntoCargaEliminar :idSala, :idPuntoCarga, :idUsuarioAuditoria";

		$params = [
			'idSala' => $oTabla->idSala, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ImagSalaPuntoCargaSeleccionarPorId :idSala, :idPuntoCarga";

		$params = [
			'idSala' => $oTabla->idSala, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorIdSala($oTabla)
	{
		$query = "
			EXEC ImagSalaPuntoCargaEliminarPorIdSala :idSala, :idUsuarioAuditoria";

		$params = [
			'idSala' => $oTabla->idSala, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function FiltrarPorIdSala($oTabla)
	{
		$query = "
			EXEC ImagSalaPuntoCargaSeleccionarPorIdSala :idSala";

		$params = [
			'idSala' => $oTabla->idSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}