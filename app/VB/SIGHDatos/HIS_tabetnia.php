<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_tabetnia extends Model
{
	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_tabetniaSeleccionarPorId :codetni";

		$params = [
			'codetni' => $oTabla->codetni, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListaEtnias()
	{
		$query = "
			EXEC HIS_tabetniaFiltrarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}