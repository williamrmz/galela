<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ReportesHospitalizacion extends Model
{
	public function FiltrarReporteHospitalizacion($dni, $apellidopaterno, $apellidomaterno, $hc)
	{
		$query = "
			EXEC ReportePacientes :dni, :apellidopaterno, :apellidomaterno, :hc";

		$params = [
			'dni' => $dni, 
			'apellidopaterno' => $apellidopaterno, 
			'apellidomaterno' => $apellidomaterno, 
			'hc' => $hc, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ReporteHospitalizacionSeleccionarPorId :id";

		$params = [
			'id' => $oTabla->idPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarReportes()
	{
		$query = "
			EXEC ListarReportesHospitalizacion ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}