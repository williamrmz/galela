<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FactPuntosCarga extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC FactPuntosCargaAgregar :idPuntoCarga, :tipoPunto, :descripcion, :idUPS, :idServicio, :idUsuarioAuditoria";

		$params = [
			'idPuntoCarga' => $oTabla->idPuntoCarga, 
			'tipoPunto' => ($oTabla->tipoPunto == "")? Null: $oTabla->tipoPunto, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idUPS' => $oTabla->idUPS, 
			'idServicio' => $oTabla->idServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactPuntosCargaModificar :idPuntoCarga, :tipoPunto, :descripcion, :idUPS, :idServicio, :idUsuarioAuditoria";

		$params = [
			'idPuntoCarga' => $oTabla->idPuntoCarga, 
			'tipoPunto' => ($oTabla->tipoPunto == "")? Null: $oTabla->tipoPunto, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idUPS' => $oTabla->idUPS, 
			'idServicio' => $oTabla->idServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactPuntosCargaEliminar :idPuntoCarga, :idUsuarioAuditoria";

		$params = [
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactPuntosCargaSeleccionarPorId :idPuntoCarga";

		$params = [
			'idPuntoCarga' => $oTabla->idPuntoCarga, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC FactPuntosCargaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarSegunFiltro($lcFiltro)
	{
		$query = "
			EXEC FactPuntosCargaFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => $lcFiltro, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdServicio($lnIdServicio)
	{
		$query = "
			EXEC FactPuntosCargaSeleccionarPorIdServicio :idServicio";

		$params = [
			'idServicio' => $lnIdServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}