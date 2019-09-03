<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_CodigosActividades extends Model
{
	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_CodigosActividadesSeleccionarPorId :idHisCodActvidad";

		$params = [
			'idHisCodActvidad' => $oTabla->idHisCodActvidad, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerListaCodigosActividades($ml_CodigoTipoActividad)
	{
		$query = "
			EXEC HIS_CodigosActividadesObtenerListaCodigosActividades :ml_CodigoTipoActividad";

		$params = [
			'ml_CodigoTipoActividad' => $ml_CodigoTipoActividad, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerListaCodigosActividadesporCodigoyNombre($codigoActividad, $descripcion)
	{
		$query = "
			EXEC HIS_CodigosActividadesSeleccionarPorCodigoDescripcion :codigoActividad, :descripcion";

		$params = [
			'codigoActividad' => CodigoActividad, 
			'descripcion' => Descripcion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}