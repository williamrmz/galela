<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TriajeExcepciones extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTriajeExcepciones AS Int = :idTriajeExcepciones
			SET NOCOUNT ON 
			EXEC TriajeExcepcionesAgregar @idTriajeExcepciones OUTPUT, :idTriajeVariable, :edadInicialEnDia, :edadFinalEnDia, :esDatoObligatorio, :idUsuarioAuditoria
			SELECT @idTriajeExcepciones AS idTriajeExcepciones";

		$params = [
			'idTriajeExcepciones' => 0, 
			'idTriajeVariable' => ($oTabla->idTriajeVariable == 0)? Null: $oTabla->idTriajeVariable, 
			'edadInicialEnDia' => ($oTabla->edadInicialEnDia == 0)? Null: $oTabla->edadInicialEnDia, 
			'edadFinalEnDia' => ($oTabla->edadFinalEnDia == 0)? Null: $oTabla->edadFinalEnDia, 
			'esDatoObligatorio' => ($oTabla->esDatoObligatorio == 0)? Null: $oTabla->esDatoObligatorio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TriajeExcepcionesModificar :idTriajeExcepciones, :idTriajeVariable, :edadInicialEnDia, :edadFinalEnDia, :esDatoObligatorio, :idUsuarioAuditoria";

		$params = [
			'idTriajeExcepciones' => ($oTabla->idTriajeExcepciones == 0)? Null: $oTabla->idTriajeExcepciones, 
			'idTriajeVariable' => ($oTabla->idTriajeVariable == 0)? Null: $oTabla->idTriajeVariable, 
			'edadInicialEnDia' => ($oTabla->edadInicialEnDia == 0)? Null: $oTabla->edadInicialEnDia, 
			'edadFinalEnDia' => ($oTabla->edadFinalEnDia == 0)? Null: $oTabla->edadFinalEnDia, 
			'esDatoObligatorio' => ($oTabla->esDatoObligatorio == 0)? Null: $oTabla->esDatoObligatorio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TriajeExcepcionesEliminar :idTriajeExcepciones, :idUsuarioAuditoria";

		$params = [
			'idTriajeExcepciones' => $oTabla->idTriajeExcepciones, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TriajeExcepcionesSeleccionarPorId :idTriajeExcepciones";

		$params = [
			'idTriajeExcepciones' => $oTabla->idTriajeExcepciones, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TriajeExcepcionesSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}