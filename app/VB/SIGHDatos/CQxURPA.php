<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxURPA extends Model
{
	public function CQxAccionesEnfermeriaURPADetAgregar($aDORegEnfCab)
	{
		$query = "
			EXEC pa_CQxAccionesEnfermeriaURPADetAgregar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => ($aDORegEnfCab->idProgramacion == 0)? Null: $aDORegEnfCab->idProgramacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function TestAldretteRecupDetAgregar($aDORegEnfCab)
	{
		$query = "
			EXEC pa_CQxTestAldretteRecuperacionDetAgregar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => ($aDORegEnfCab->idProgramacion == 0)? Null: $aDORegEnfCab->idProgramacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function BuscarTestAldrete($aDOCheq)
	{
		$query = "
			EXEC pa_CQxObtenerTestAldrete :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $aDOCheq->idProgramacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RegURPACabeceraAgregar($aDORegEnfCab)
	{
		$query = "
			EXEC pa_CQxRegistroEnfermeriaURPACabAgregar :idProgramacionSala, :idOrdenOperatoriaMQ, :idAnestesiologiaURPA, :horaIngreso, :horaSalida, :horaCoordinacion, :glucosa, :idUsuario, :estacion";

		$params = [
			'idProgramacionSala' => ($aDORegEnfCab->idProgramacion == 0)? Null: $aDORegEnfCab->idProgramacion, 
			'idOrdenOperatoriaMQ' => ($aDORegEnfCab->idOrdenOperatoriaMQ == 0)? Null: $aDORegEnfCab->idOrdenOperatoriaMQ, 
			'idAnestesiologiaURPA' => ($aDORegEnfCab->idAnestesiologiaURPA == 0)? Null: $aDORegEnfCab->idAnestesiologiaURPA, 
			'horaIngreso' => ($aDORegEnfCab->horaEntrada == "")? Null: $aDORegEnfCab->horaEntrada, 
			'horaSalida' => ($aDORegEnfCab->horaSalida == "")? Null: $aDORegEnfCab->horaSalida, 
			'horaCoordinacion' => ($aDORegEnfCab->horaCoordinacion == "")? Null: $aDORegEnfCab->horaCoordinacion, 
			'glucosa' => ($aDORegEnfCab->glucosa == "")? Null: $aDORegEnfCab->glucosa, 
			'idUsuario' => ($aDORegEnfCab->idUsuario == 0)? Null: $aDORegEnfCab->idUsuario, 
			'estacion' => ($aDORegEnfCab->estacion == "")? Null: $aDORegEnfCab->estacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function BuscarTipoAnestesia($aDOCheq)
	{
		$query = "
			EXEC pa_CQxTipoAnestesiaDetListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $aDOCheq->idProgramacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function CondIngresoAgregar($aDORegEnfCab, $aDOCondicionIngreso)
	{
		$query = "
			DECLARE @idCondicionIngresoURPADet AS Int = :idCondicionIngresoURPADet
			SET NOCOUNT ON 
			EXEC pa_CQxCondicionIngresoURPADetAgregar @idCondicionIngresoURPADet OUTPUT, :idProgramacionSala, :idCondicionIngresoURPA, :valor, :idUsuario, :estacion
			SELECT @idCondicionIngresoURPADet AS idCondicionIngresoURPADet";

		$params = [
			'idCondicionIngresoURPADet' => 0, 
			'idProgramacionSala' => ($aDORegEnfCab->idProgramacion == 0)? Null: $aDORegEnfCab->idProgramacion, 
			'idCondicionIngresoURPA' => ($aDOCondicionIngreso->idCondicionIngresoURPA == 0)? Null: $aDOCondicionIngreso->idCondicionIngresoURPA, 
			'valor' => ($aDOCondicionIngreso->valor == 0)? Null: $aDOCondicionIngreso->valor, 
			'idUsuario' => ($aDOCondicionIngreso->idUsuario == 0)? Null: $aDOCondicionIngreso->idUsuario, 
			'estacion' => ($aDOCondicionIngreso->estacion == "")? Null: $aDOCondicionIngreso->estacion, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function TestAldretteModificar($aDOTest)
	{
		$query = "
			EXEC pa_CQxTestAldretteRecuperacionDetModificar :idProgramacionSala, :idComponentesTestAldrette, :valorIngreso, :valorEgreso, :idUsuario, :estacion";

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

	public function AccionesEnfermeriaModificar($aDOAccionesDet)
	{
		$query = "
			EXEC pa_CQxAccionesEnfermeriaURPADetModificar :idProgramacionSala, :idAccionesEnfermeria, :valor, :idUsuario, :estacion";

		$params = [
			'idProgramacionSala' => ($aDOAccionesDet->idProgramacionSala == 0)? Null: $aDOAccionesDet->idProgramacionSala, 
			'idAccionesEnfermeria' => ($aDOAccionesDet->idAccionesEnfermeria == 0)? Null: $aDOAccionesDet->idAccionesEnfermeria, 
			'valor' => ($aDOAccionesDet->valor == 0)? Null: $aDOAccionesDet->valor, 
			'idUsuario' => ($aDOAccionesDet->idUsuario == 0)? Null: $aDOAccionesDet->idUsuario, 
			'estacion' => ($aDOAccionesDet->estacion == "")? Null: $aDOAccionesDet->estacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function BuscarAccionesEnfermeria($aDOAccionesDet)
	{
		$query = "
			EXEC pa_CQxAccionesEnfermeriaURPADetListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $aDOAccionesDet->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function BuscarCondicionesIngreso($aDOAccionesDet)
	{
		$query = "
			EXEC pa_CQxCondicionIngresoURPADetListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $aDOAccionesDet->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function BuscarCabeceraURPA($aDOAccionesDet)
	{
		$query = "
			EXEC pa_CQxRegistroEnfermeriaURPACabListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $aDOAccionesDet->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function CondIngresoEliminar($aDORegEnfCab)
	{
		$query = "
			DECLARE @idCondicionIngresoURPADet AS Int = :idCondicionIngresoURPADet
			SET NOCOUNT ON 
			EXEC pa_CQxCondicionIngresoURPADetEliminar @idCondicionIngresoURPADet OUTPUT, :idProgramacionSala
			SELECT @idCondicionIngresoURPADet AS idCondicionIngresoURPADet";

		$params = [
			'idCondicionIngresoURPADet' => 0, 
			'idProgramacionSala' => ($aDORegEnfCab->idProgramacion == 0)? Null: $aDORegEnfCab->idProgramacion, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function AccionesEnfermeriaEliminar($aDOAccionesDet)
	{
		$query = "
			EXEC pa_CQxAccionesEnfermeriaURPADetModificar :idProgramacionSala, :idAccionesEnfermeria, :valor, :idUsuario, :estacion";

		$params = [
			'idProgramacionSala' => ($aDOAccionesDet->idProgramacionSala == 0)? Null: $aDOAccionesDet->idProgramacionSala, 
			'idAccionesEnfermeria' => ($aDOAccionesDet->idAccionesEnfermeria == 0)? Null: $aDOAccionesDet->idAccionesEnfermeria, 
			'valor' => ($aDOAccionesDet->valor == 0)? Null: $aDOAccionesDet->valor, 
			'idUsuario' => ($aDOAccionesDet->idUsuario == 0)? Null: $aDOAccionesDet->idUsuario, 
			'estacion' => ($aDOAccionesDet->estacion == "")? Null: $aDOAccionesDet->estacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function UsuarioRegURPA($id)
	{
		$query = "
			EXEC pa_UsuarioRegURPA :idProgramacion";

		$params = [
			'idProgramacion' => Id, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}