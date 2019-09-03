<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_situacio extends Model
{
	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_situacioSeleccionarPorId :idHisSituacio";

		$params = [
			'idHisSituacio' => $oTabla->idHisSituacio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerListaCodigosLAB()
	{
		$query = "
			EXEC HIS_situacioSeleccionarPorCodigoDescripcion ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerListaCodigosLABporCodigoyNombre($valores, $descripcio)
	{
		$query = "
			EXEC HIS_situacioSeleccionarPorCodigoDescripcion :valores, :descripcio";

		$params = [
			'valores' => $valores, 
			'descripcio' => $descripcio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}