<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ChequeoCirujano extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC pa_CQxChequeoCirujanoAgregar :idOOpMQ, :idMedico, :edad, :idProgramacion, :idDiagnostico, :idUsuario, :estacion, :idS";

		$params = [
			'idOOpMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'edad' => ($oTabla->edad == 0)? Null: $oTabla->edad, 
			'idProgramacion' => ($oTabla->idProgramacion == 0)? Null: $oTabla->idProgramacion, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'idS' => ($oTabla->idS == 0)? Null: $oTabla->idS, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function ModificarDet($oCheqcab, $oTabla)
	{
		$query = "
			EXEC pa_CQxChequeoCirujanoActualizar :id, :idOMQ, :idProgramacion, :sI, :nO, :no_Aplica";

		$params = [
			'id' => ($oTabla->idChequeoCirujano == 0)? Null: $oTabla->idChequeoCirujano, 
			'idOMQ' => (OCheqcab->idOrdenOperatoriaMQ == 0)? Null: OCheqcab->idOrdenOperatoriaMQ, 
			'idProgramacion' => (OCheqcab->idProgramacion == 0)? Null: OCheqcab->idProgramacion, 
			'sI' => ($oTabla->sI == 0)? Null: $oTabla->sI, 
			'nO' => ($oTabla->nO == 0)? Null: $oTabla->nO, 
			'no_Aplica' => ($oTabla->nO_APLICA == 0)? Null: $oTabla->nO_APLICA, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function BuscarChequeoCirujano($aDOCheq)
	{
		$query = "
			EXEC pa_CQxObtenerChequeoCirujano :idProgramacion";

		$params = [
			'idProgramacion' => $aDOCheq->idProgramacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function UsuarioRegCirujano($id)
	{
		$query = "
			EXEC pa_UsuarioRegCirujano :idProgramacion";

		$params = [
			'idProgramacion' => Id, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}