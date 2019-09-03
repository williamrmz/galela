<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_TipoEdad extends Model
{
	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_TipoEdadSeleccionarPorId :idHisTipoEdad";

		$params = [
			'idHisTipoEdad' => $oTabla->idHisTipoEdad, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListaTiposEdad()
	{
		$query = "
			EXEC HIS_TipoEdadSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}