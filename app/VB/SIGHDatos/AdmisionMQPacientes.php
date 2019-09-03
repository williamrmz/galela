<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AdmisionMQPacientes extends Model
{
	public function BuscarPacientesAdmitidos($aDOAdmitidos, $oDOPaciente)
	{
		$query = "
			EXEC pa_CQxAdmisionMQPacientes :liAdmitido, :lcFiltro";

		$params = [
			'liAdmitido' => $aDOAdmitidos->admitido, 
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AdmitirPacientes($oTabla)
	{
		$query = "
			EXEC pa_CQxAdmitirPacienteMQ :idOrdenOperatoria, :idUsuario, :estacion";

		$params = [
			'idOrdenOperatoria' => ($oTabla->idOrdenOperatoria == 0)? Null: $oTabla->idOrdenOperatoria, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RevertirAdmision($oTabla)
	{
		$query = "
			EXEC pa_CQxRevertirAdmisionMQ :idOrdenOperatoria";

		$params = [
			'idOrdenOperatoria' => ($oTabla->idOrdenOperatoria == 0)? Null: $oTabla->idOrdenOperatoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}