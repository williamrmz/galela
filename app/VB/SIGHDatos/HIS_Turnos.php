<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_Turnos extends Model
{
	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_TurnosSeleccionarPorId :idHisTurno";

		$params = [
			'idHisTurno' => $oTabla->idHisTurno, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListaTurnos()
	{
		$query = "
			EXEC HIS_TurnosSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}