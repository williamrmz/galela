<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ReporteConsultaExterna extends Model
{
	public function ListarPacientesConsultaExterna($dni, $apellidopaterno, $apellidomaterno, $hc)
	{
		$query = "
			EXEC ListarPacientesConsultaExterna :dni, :apellidopaterno, :apellidomaterno, :hc";

		$params = [
			'dni' => $dni, 
			'apellidopaterno' => $apellidopaterno, 
			'apellidomaterno' => $apellidomaterno, 
			'hc' => $hc, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}