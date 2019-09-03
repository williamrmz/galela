<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ReporteCentroObstetrico extends Model
{
	public function ListarPacientesCentroObstetrico($dni, $apellidopaterno, $apellidomaterno, $hc)
	{
		$query = "
			EXEC ListarPacientesCentroObstetrico :dni, :apellidopaterno, :apellidomaterno, :hc";

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