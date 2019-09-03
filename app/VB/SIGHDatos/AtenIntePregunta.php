<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenIntePregunta extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPregunta AS Int = :idPregunta
			SET NOCOUNT ON 
			EXEC AtenIntePreguntaAgregar @idPregunta OUTPUT, :pregunta, :tipoRespuesta, :tipoValorRespuesta, :idUsuarioAuditoria
			SELECT @idPregunta AS idPregunta";

		$params = [
			'idPregunta' => 0, 
			'pregunta' => ($oTabla->pregunta == "")? Null: $oTabla->pregunta, 
			'tipoRespuesta' => ($oTabla->tipoRespuesta == 0)? Null: $oTabla->tipoRespuesta, 
			'tipoValorRespuesta' => ($oTabla->tipoValorRespuesta == 0)? Null: $oTabla->tipoValorRespuesta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtenIntePreguntaModificar :idPregunta, :pregunta, :tipoRespuesta, :tipoValorRespuesta, :idUsuarioAuditoria";

		$params = [
			'idPregunta' => ($oTabla->idPregunta == 0)? Null: $oTabla->idPregunta, 
			'pregunta' => ($oTabla->pregunta == "")? Null: $oTabla->pregunta, 
			'tipoRespuesta' => ($oTabla->tipoRespuesta == 0)? Null: $oTabla->tipoRespuesta, 
			'tipoValorRespuesta' => ($oTabla->tipoValorRespuesta == 0)? Null: $oTabla->tipoValorRespuesta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenIntePreguntaEliminar :idPregunta, :idUsuarioAuditoria";

		$params = [
			'idPregunta' => $oTabla->idPregunta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenIntePreguntaSeleccionarPorId :idPregunta";

		$params = [
			'idPregunta' => $oTabla->idPregunta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}