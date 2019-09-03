<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HistoriasClinicas extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC HistoriasClinicasAgregar :idTipoNumeracionAnterior, :nroHistoriaClinicaAnterior, :idTipoNumeracion, :nroHistoriaClinica, :fechaCreacion, :fechaPasoAPasivo, :idTipoHistoria, :idEstadoHistoria, :idPaciente, :idUsuarioAuditoria";

		$params = [
			'idTipoNumeracionAnterior' => ($oTabla->idTipoNumeracionAnterior == 0)? Null: $oTabla->idTipoNumeracionAnterior, 
			'nroHistoriaClinicaAnterior' => ($oTabla->nroHistoriaClinicaAnterior == "")? Null: $oTabla->nroHistoriaClinicaAnterior, 
			'idTipoNumeracion' => ($oTabla->idTipoNumeracion == 0)? Null: $oTabla->idTipoNumeracion, 
			'nroHistoriaClinica' => ($oTabla->nroHistoriaClinica == "")? Null: $oTabla->nroHistoriaClinica, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'fechaPasoAPasivo' => ($oTabla->fechaPasoAPasivo == 0)? Null: $oTabla->fechaPasoAPasivo, 
			'idTipoHistoria' => ($oTabla->idTipoHistoria == 0)? Null: $oTabla->idTipoHistoria, 
			'idEstadoHistoria' => ($oTabla->idEstadoHistoria == 0)? Null: $oTabla->idEstadoHistoria, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC HistoriasClinicasModificar :idTipoNumeracionAnterior, :nroHistoriaClinicaAnterior, :idTipoNumeracion, :nroHistoriaClinica, :fechaCreacion, :fechaPasoAPasivo, :idTipoHistoria, :idEstadoHistoria, :idPaciente, :idUsuarioAuditoria";

		$params = [
			'idTipoNumeracionAnterior' => ($oTabla->idTipoNumeracionAnterior == 0)? Null: $oTabla->idTipoNumeracionAnterior, 
			'nroHistoriaClinicaAnterior' => ($oTabla->nroHistoriaClinicaAnterior == "")? Null: $oTabla->nroHistoriaClinicaAnterior, 
			'idTipoNumeracion' => ($oTabla->idTipoNumeracion == 0)? Null: $oTabla->idTipoNumeracion, 
			'nroHistoriaClinica' => ($oTabla->nroHistoriaClinica == "")? Null: $oTabla->nroHistoriaClinica, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'fechaPasoAPasivo' => ($oTabla->fechaPasoAPasivo == 0)? Null: $oTabla->fechaPasoAPasivo, 
			'idTipoHistoria' => ($oTabla->idTipoHistoria == 0)? Null: $oTabla->idTipoHistoria, 
			'idEstadoHistoria' => ($oTabla->idEstadoHistoria == 0)? Null: $oTabla->idEstadoHistoria, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC HistoriasClinicasEliminar :nroHistoriaClinica, :idUsuarioAuditoria";

		$params = [
			'nroHistoriaClinica' => ($oTabla->nroHistoriaClinica == "")? Null: $oTabla->nroHistoriaClinica, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HistoriasClinicasSeleccionarPorId :nroHistoriaClinica";

		$params = [
			'nroHistoriaClinica' => $oTabla->nroHistoriaClinica, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function GenerarNroHistoria($lTipoNumeracion)
	{
		$query = "
			DECLARE @idHistoriaClinica AS Int = :idHistoriaClinica
			SET NOCOUNT ON 
			EXEC generadorNroHistoriaClinicaActualizaNroHistoria :idTipoNumeracion, @idHistoriaClinica OUTPUT, :nroHistoriaClinica, :nroHistoriaClinica
			SELECT @idHistoriaClinica AS idHistoriaClinica";

		$params = [
			'idTipoNumeracion' => $lTipoNumeracion, 
			'idHistoriaClinica' => 0, 
			'nroHistoriaClinica' => lnNroHistoriaClinica, 
			'nroHistoriaClinica' => lnNroHistoriaClinica, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Filtrar($oTabla, $lcSinApellido)
	{
		$query = "
			EXEC HistoriasClinicasSegunFiltro :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function UltimoNroHistoria()
	{
		$query = "
			EXEC HistoriasClinicasUltimoGenerado ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}