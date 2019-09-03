<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class A_categoriaeess extends Model
{
	public function SeleccionarPorCatAbreviatura($oTabla)
	{
		$query = "
			EXEC a_categoriaeessSeleccionarPorCatAbreviatura :cat_Abreviatura";

		$params = [
			'cat_Abreviatura' => $oTabla->cat_Abreviatura, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerValorDefectoIdCategoriaEESS()
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}