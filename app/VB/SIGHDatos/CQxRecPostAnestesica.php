<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxRecPostAnestesica extends Model
{
	public function BuscarTestAldrete($aDOCheq)
	{
		$query = "
			EXEC pa_CQxObtenerTestAldreteRecPostAnestesica :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $aDOCheq->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function CQxRecuperacionPostAnestesicaAgregar($aDORPostAnestCab)
	{
		$query = "
			EXEC pa_CQxRecuperacionPostAnestesicaAgregar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => ($aDORPostAnestCab->idProgramacionSala == 0)? Null: $aDORPostAnestCab->idProgramacionSala, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function BuscarCabeceraPosAnestesica($aDOPosAnestCab)
	{
		$query = "
			EXEC pa_CQRecuperacionPostAnestesicaCabListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $aDOPosAnestCab->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function BuscarVentilacionMecanica($aDOCheq)
	{
		$query = "
			EXEC pa_CQxObtenerVentilacionMecanicaDet :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $aDOCheq->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function BuscarMonitoreoInvasivo($oDOPostAnestCab)
	{
		$query = "
			EXEC pa_CQxMonitoreoInvasivoListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $oDOPostAnestCab->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function BuscarSignosVitalesRecuperacion($oDOPostAnestCab)
	{
		$query = "
			EXEC pa_CQxSignosVitalesRecuperacionListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $oDOPostAnestCab->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function BuscarSignosVitalesAlta($oDOPostAnestCab)
	{
		$query = "
			EXEC pa_CQxSignosVitalesAltaListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $oDOPostAnestCab->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function BuscarComponentesRecuperacionPostAnestesica($oDOPostAnestCab)
	{
		$query = "
			EXEC pa_CQxComponentesRecPostListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $oDOPostAnestCab->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RegRecuperacionPostAnestesicaCabeceraAgregar($aDORegEnfCab)
	{
		$query = "
			EXEC pa_CQxRecuperacionPostAnestesicaCabAgregar :idProgramacionSala, :idOrdenOperatoriaMQ, :idAnestesiologiaURPA, :fechaIngreso, :horaIngreso, :fechaEgreso, :horaEgreso, :observacionMedica, :pendientes, :idUsuario, :estacion";

		$params = [
			'idProgramacionSala' => ($aDORegEnfCab->idProgramacionSala == 0)? Null: $aDORegEnfCab->idProgramacionSala, 
			'idOrdenOperatoriaMQ' => ($aDORegEnfCab->idOrdenOperatoriaMQ == 0)? Null: $aDORegEnfCab->idOrdenOperatoriaMQ, 
			'idAnestesiologiaURPA' => ($aDORegEnfCab->idAnestesiologoURPA == 0)? Null: $aDORegEnfCab->idAnestesiologoURPA, 
			'fechaIngreso' => ($aDORegEnfCab->fechaIngreso == 0)? Null: $aDORegEnfCab->fechaIngreso, 
			'horaIngreso' => ($aDORegEnfCab->horaIngreso == "")? Null: $aDORegEnfCab->horaIngreso, 
			'fechaEgreso' => ($aDORegEnfCab->fechaEgreso == 0)? Null: $aDORegEnfCab->fechaEgreso, 
			'horaEgreso' => ($aDORegEnfCab->horaEgreso == "")? Null: $aDORegEnfCab->horaEgreso, 
			'observacionMedica' => ($aDORegEnfCab->observacionIndicacionMedica == "")? Null: $aDORegEnfCab->observacionIndicacionMedica, 
			'pendientes' => ($aDORegEnfCab->pendientes == "")? Null: $aDORegEnfCab->pendientes, 
			'idUsuario' => ($aDORegEnfCab->idUsuario == 0)? Null: $aDORegEnfCab->idUsuario, 
			'estacion' => ($aDORegEnfCab->estacion == "")? Null: $aDORegEnfCab->estacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function MonitoreoInvasivoEliminar($aDOAccionesDet)
	{
		$query = "
			EXEC pa_CQxRecuperacionPostAnestesicaEliminar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => ($aDOAccionesDet->idProgramacionSala == 0)? Null: $aDOAccionesDet->idProgramacionSala, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function TestAldretteModificar($aDOTest)
	{
		$query = "
			EXEC pa_CQxTestAldretteRecuperacionPostAnestDetModificar :idProgramacionSala, :idComponentesTestAldrette, :valorIngreso, :valorEgreso, :idUsuario, :estacion";

		$params = [
			'idProgramacionSala' => ($aDOTest->idProgramacionSala == 0)? Null: $aDOTest->idProgramacionSala, 
			'idComponentesTestAldrette' => ($aDOTest->idComponentesTestAldrette == 0)? Null: $aDOTest->idComponentesTestAldrette, 
			'valorIngreso' => ($aDOTest->valorIngreso == 3)? Null: $aDOTest->valorIngreso, 
			'valorEgreso' => ($aDOTest->valorEgreso == 3)? Null: $aDOTest->valorEgreso, 
			'idUsuario' => ($aDOTest->idUsuario == 0)? Null: $aDOTest->idUsuario, 
			'estacion' => ($aDOTest->estacion == "")? Null: $aDOTest->estacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function VentilacionMecanicaModificar($aDOTest)
	{
		$query = "
			EXEC pa_CQxVentilacionMecanicaModificar :idProgramacionSala, :idComponentesVentilacionMecanica, :valorIngreso, :valorAlta, :idUsuario, :estacion";

		$params = [
			'idProgramacionSala' => ($aDOTest->idProgramacionSala == 0)? Null: $aDOTest->idProgramacionSala, 
			'idComponentesVentilacionMecanica' => ($aDOTest->idComponentesVentilacionMecanica == 0)? Null: $aDOTest->idComponentesVentilacionMecanica, 
			'valorIngreso' => ($aDOTest->valorIngresoVentilacion == "")? Null: $aDOTest->valorIngresoVentilacion, 
			'valorAlta' => ($aDOTest->valorAltaVentilacion == "")? Null: $aDOTest->valorAltaVentilacion, 
			'idUsuario' => ($aDOTest->idUsuario == 0)? Null: $aDOTest->idUsuario, 
			'estacion' => ($aDOTest->estacion == "")? Null: $aDOTest->estacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function MonitoreoInvasivoModificar($oDOMonito)
	{
		$query = "
			EXEC pa_CQxMonitoreoInvasivoModificar :idProgramacionSala, :idMonitoreoInvasivo, :valor, :idUsuario, :estacion";

		$params = [
			'idProgramacionSala' => ($oDOMonito->idProgramacionSala == 0)? Null: $oDOMonito->idProgramacionSala, 
			'idMonitoreoInvasivo' => ($oDOMonito->idMonitoreoInvasivo == 0)? Null: $oDOMonito->idMonitoreoInvasivo, 
			'valor' => ($oDOMonito->valor == "")? Null: $oDOMonito->valor, 
			'idUsuario' => ($oDOMonito->idUsuario == 0)? Null: $oDOMonito->idUsuario, 
			'estacion' => ($oDOMonito->estacion == "")? Null: $oDOMonito->estacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SignosVitalesRecuperacionModificar($aDOSignos)
	{
		$query = "
			EXEC pa_CQxSignosVitalesRecuperacionModificar :idProgramacionSala, :idSignosVitales, :variableDato, :idUsuario, :estacion";

		$params = [
			'idProgramacionSala' => ($aDOSignos->idProgramacionSala == 0)? Null: $aDOSignos->idProgramacionSala, 
			'idSignosVitales' => ($aDOSignos->idSignosVitales == 0)? Null: $aDOSignos->idSignosVitales, 
			'variableDato' => ($aDOSignos->variableDato == "")? Null: $aDOSignos->variableDato, 
			'idUsuario' => ($aDOSignos->idUsuario == 0)? Null: $aDOSignos->idUsuario, 
			'estacion' => ($aDOSignos->estacion == "")? Null: $aDOSignos->estacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SignosVitalesAltaModificar($aDOSignos)
	{
		$query = "
			EXEC pa_CQxSignosVitalesAltaModificar :idProgramacionSala, :idSignosVitales, :variableDato, :idUsuario, :estacion";

		$params = [
			'idProgramacionSala' => ($aDOSignos->idProgramacionSala == 0)? Null: $aDOSignos->idProgramacionSala, 
			'idSignosVitales' => ($aDOSignos->idSignosVitales == 0)? Null: $aDOSignos->idSignosVitales, 
			'variableDato' => ($aDOSignos->variableDato == "")? Null: $aDOSignos->variableDato, 
			'idUsuario' => ($aDOSignos->idUsuario == 0)? Null: $aDOSignos->idUsuario, 
			'estacion' => ($aDOSignos->estacion == "")? Null: $aDOSignos->estacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function ComponentesRecuperacionModificar($aDOSignos)
	{
		$query = "
			EXEC pa_CQxComponentesRecuperacionModificar :idProgramacionSala, :idComponentesRecPostAnestesica, :valorIngreso, :valorIngreso, :idUsuario, :estacion";

		$params = [
			'idProgramacionSala' => ($aDOSignos->idProgramacionSala == 0)? Null: $aDOSignos->idProgramacionSala, 
			'idComponentesRecPostAnestesica' => ($aDOSignos->idComponentesRecPostAnestesica == 0)? Null: $aDOSignos->idComponentesRecPostAnestesica, 
			'valorIngreso' => ($aDOSignos->valorIngreso == "")? Null: $aDOSignos->valorIngreso, 
			'valorIngreso' => ($aDOSignos->valorEgreso == "")? Null: $aDOSignos->valorEgreso, 
			'idUsuario' => ($aDOSignos->idUsuario == 0)? Null: $aDOSignos->idUsuario, 
			'estacion' => ($aDOSignos->estacion == "")? Null: $aDOSignos->estacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function UsuarioRegRecuPostAnestesica($id)
	{
		$query = "
			EXEC pa_UsuarioRegRecPostAnestesica :idProgramacion";

		$params = [
			'idProgramacion' => Id, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}