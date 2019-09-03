<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class EstadosFacturacion extends Model
{
	public function SeleccionarTodos()
	{
		$query = "
			EXEC EstadosFacturacionSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodosExceptoPagado()
	{
		$query = "
			EXEC EstadosFacturacionSeleccionarTodosExceptoPagado ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDescripcionPorId($idEstadoFacturacion)
	{
		$query = "
			EXEC EstadosFacturacionObtenerDescripcionPorId :idEstadoFacturacion";

		$params = [
			'idEstadoFacturacion' => IdEstadoFacturacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}