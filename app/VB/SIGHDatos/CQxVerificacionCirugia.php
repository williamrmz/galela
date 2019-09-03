<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxVerificacionCirugia extends Model
{
	public function RegVerificacionCirugiaCabAgregar($aDORegVerCab)
	{
		$query = "
			EXEC pa_CQxVerificacionCirugiaCabAgregar :idProgramacionSala, :idOrdenOperatoriaMQ, :idUsuario, :estacion";

		$params = [
			'idProgramacionSala' => ($aDORegVerCab->idProgramacionSala == 0)? Null: $aDORegVerCab->idProgramacionSala, 
			'idOrdenOperatoriaMQ' => ($aDORegVerCab->idOrdenOperatoriaMQ == 0)? Null: $aDORegVerCab->idOrdenOperatoriaMQ, 
			'idUsuario' => ($aDORegVerCab->idUsuario == 0)? Null: $aDORegVerCab->idUsuario, 
			'estacion' => ($aDORegVerCab->estacion == "")? Null: $aDORegVerCab->estacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function VerificacionCirugiaEliminar($aDOAccionesDet)
	{
		$query = "
			DECLARE @idverificacionCirugiacab AS Int = :idverificacionCirugiacab
			SET NOCOUNT ON 
			EXEC pa_CQxVerificacionCirugiaDetEliminar @idverificacionCirugiacab OUTPUT, :idProgramacionSala
			SELECT @idverificacionCirugiacab AS idverificacionCirugiacab";

		$params = [
			'idverificacionCirugiacab' => 0, 
			'idProgramacionSala' => ($aDOAccionesDet->idProgramacionSala == 0)? Null: $aDOAccionesDet->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function VerificacionCirugiaModificar($aDOAccionesDet)
	{
		$query = "
			EXEC pa_CQxVerificacionCirugiaDetModificar :idProgramacionSala, :idPreguntasVerificacionCirugiaCQx, :sI, :nO, :idUsuario, :estacion";

		$params = [
			'idProgramacionSala' => ($aDOAccionesDet->idProgramacionSala == 0)? Null: $aDOAccionesDet->idProgramacionSala, 
			'idPreguntasVerificacionCirugiaCQx' => ($aDOAccionesDet->idPreguntasVerificacionCirugiaCQx == 0)? Null: $aDOAccionesDet->idPreguntasVerificacionCirugiaCQx, 
			'sI' => ($aDOAccionesDet->sI == 0)? 0: $aDOAccionesDet->sI, 
			'nO' => ($aDOAccionesDet->nO == 0)? 0: $aDOAccionesDet->nO, 
			'idUsuario' => ($aDOAccionesDet->idUsuario == 0)? Null: $aDOAccionesDet->idUsuario, 
			'estacion' => ($aDOAccionesDet->estacion == "")? Null: $aDOAccionesDet->estacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function BuscarVerificacionCirugia($aDOAccionesDet)
	{
		$query = "
			EXEC pa_CQxVerificacionCirugiaDetListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $aDOAccionesDet->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function BuscarVerificacionCirugiaCab($aDOAccionesDet)
	{
		$query = "
			EXEC pa_CQxVerificacionCirugiaCabListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $aDOAccionesDet->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}