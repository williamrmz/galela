<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;
use App\VB\SIGHEntidades\Enumerados;

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

		$params = 
		[
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
		$lnNroHistoriaClinica = '';

		$params = [
			'idTipoNumeracion' => $lTipoNumeracion,
			'nroHistoriaClinica' => 0,
		];

		$dataTmp = proc( 'HistoriasClinicasGenerarNroHistoria', $params );
		$lnNroHistoriaClinica = $dataTmp->nroHistoriaClinica;
		$GenerarNroHistoria = $lnNroHistoriaClinica;

		if( Enumerados::param('sghHistoriaDefinitivaAutomatica') == $lTipoNumeracion) {
			$oRsTmp1 = execute('HistoriasClinicasSeleccionarPorId', ['nroHistoriaClinica'=>$lnNroHistoriaClinica]);

			if( count( $oRsTmp1 ) > 0 ){
				$oRsTmp1 = execute('HistoriasClinicasUltimoGenerado');

				$lnNroHistoriaClinica = $oRsTmp1[0]->nroHistoriaClinica + 1;

				$update = execute('generadorNroHistoriaClinicaActualizaNroHistoria', ['nroHistoriaClinica'=>$lnNroHistoriaClinica], true );
				
				$GenerarNroHistoria = $lnNroHistoriaClinica;
			}
		}

		return $GenerarNroHistoria;

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