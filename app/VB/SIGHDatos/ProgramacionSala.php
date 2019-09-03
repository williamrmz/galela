<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ProgramacionSala extends Model
{
	public function Filtrar($oDOEmpleado)
	{
		$query = "
			EXEC pa_CQxBuscarProgramacionSala :lcSala, :lcFecha";

		$params = [
			'lcSala' => $oDOEmpleado->idSala, 
			'lcFecha' => $oDOEmpleado->fecha, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar1($oDOEmpleado)
	{
		$query = "
			EXEC pa_CQxBuscarProgramacionSala1 :lcSala, :lcFecha";

		$params = [
			'lcSala' => $oDOEmpleado->idSala, 
			'lcFecha' => $oDOEmpleado->fecha, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function BuscarSalas($oDOSala)
	{
		$query = "
			EXEC pa_CQxObtenerSala :sparam";

		$params = [
			'sparam' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarFiFf($oTabla)
	{
		$query = "
			EXEC pa_CQxObtenerRFechas :sfecha";

		$params = [
			'sfecha' => $oTabla->fecha, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function BuscarDias($oDOSala)
	{
		$query = "
			EXEC pa_CQxObtenerDias :lcFecha";

		$params = [
			'lcFecha' => $oDOSala->fecha, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function PSObtenerPaciente($oTabla)
	{
		$query = "
			EXEC pa_CQxPSObtenerPaciente :lcSala, :lsCad, :lcFecha";

		$params = [
			'lcSala' => $oTabla->idSala, 
			'lsCad' => $oTabla->cadena, 
			'lcFecha' => $oTabla->fecha, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function PacSeleccionarPorId($oTabla)
	{
		$query = "
			EXEC pa_CQxObtenerPacienteID :lcIDp";

		$params = [
			'lcIDp' => $oTabla->idPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function BuscarProgramacion($oDOProg)
	{
		$query = "
			EXEC pa_CQxProgramacionSalaListar :sparam";

		$params = [
			'sparam' => $oDOProg->idOrdenOperatoriaMQ, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SelPorFechayServicio($vFecha, $vIdServicio)
	{
		$query = "
			EXEC CQxProgramacionSalaSelPorFechayServicio :fecha, :idServicio";

		$params = [
			'fecha' => $vFecha, 
			'idServicio' => $vIdServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}