<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxReporteOperatorio extends Model
{
	public function RegReporteOperatorioCabAgregar($aDORepOpeCab)
	{
		$query = "
			EXEC pa_CQxReporteOperatorioCabAgregar :idProgramacionSala, :idOrdenOperatoriaMQ, :cama, :piso, :horaIngreso, :horaSalida, :procedimientos, :hallasgo, :idUsuario, :estacion";

		$params = [
			'idProgramacionSala' => ($aDORepOpeCab->idProgramacionSala == 0)? Null: $aDORepOpeCab->idProgramacionSala, 
			'idOrdenOperatoriaMQ' => ($aDORepOpeCab->idOrdenOperatoriaMQ == 0)? Null: $aDORepOpeCab->idOrdenOperatoriaMQ, 
			'cama' => ($aDORepOpeCab->cama == "")? Null: $aDORepOpeCab->cama, 
			'piso' => ($aDORepOpeCab->piso == "")? Null: $aDORepOpeCab->piso, 
			'horaIngreso' => ($aDORepOpeCab->horaIngreso == "")? Null: $aDORepOpeCab->horaIngreso, 
			'horaSalida' => ($aDORepOpeCab->horaSalida == "")? Null: $aDORepOpeCab->horaSalida, 
			'procedimientos' => ($aDORepOpeCab->procedimientos == "")? Null: $aDORepOpeCab->procedimientos, 
			'hallasgo' => ($aDORepOpeCab->hallasgos == "")? Null: $aDORepOpeCab->hallasgos, 
			'idUsuario' => ($aDORepOpeCab->idUsuario == 0)? Null: $aDORepOpeCab->idUsuario, 
			'estacion' => ($aDORepOpeCab->estacion == "")? Null: $aDORepOpeCab->estacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function BuscarReporteOperatorio($aDOAccionesDet)
	{
		$query = "
			EXEC pa_CQxReporteOperatorioCabListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $aDOAccionesDet->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function BuscarDiagnosticoCIEMQ($aDOAccionesDet)
	{
		$query = "
			EXEC pa_CQxDiagnosticoCIEMQListar :idOrdenOperartoriaMQ";

		$params = [
			'idOrdenOperartoriaMQ' => $aDOAccionesDet->idOrdenOperatoriaMQ, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ServicoioCPTMQListar($aDOAccionesDet)
	{
		$query = "
			EXEC pa_CQxCatalServicioCPTMQListar :idOrdenOperartoriaMQ";

		$params = [
			'idOrdenOperartoriaMQ' => $aDOAccionesDet->idOrdenOperatoriaMQ, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RegAnestCheqEnfermeriaListar($aDOAccionesDet)
	{
		$query = "
			EXEC pa_CQxRegAnestesiologiaChequeoEnfermeriaListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $aDOAccionesDet->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RegServicioEspecListar($aDOAccionesDet)
	{
		$query = "
			EXEC pa_CQxServicioxMQListar :idOrdenOperatoriaMQ";

		$params = [
			'idOrdenOperatoriaMQ' => $aDOAccionesDet->idOrdenOperatoriaMQ, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RegMedicoPrincipalListar($aDOAccionesDet)
	{
		$query = "
			EXEC pa_CQxMedicoPrincipalListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $aDOAccionesDet->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}