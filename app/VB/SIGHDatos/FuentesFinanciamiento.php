<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FuentesFinanciamiento extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC FuentesFinanciamientoAgregar :descripcion, :idFuenteFinanciamiento, :idTipoConceptoFarmacia, :utilizadoEn, :codigoFuenteFinanciamientoSEM, :idAreaTramitaSeguros, :esUsadoEnCaja, :codigoHIS, :idUsuarioAuditoria, :idTipoFinanciador, :codigo";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idFuenteFinanciamiento' => $oTabla->idFuenteFinanciamiento, 
			'idTipoConceptoFarmacia' => $oTabla->idTipoConceptoFarmacia, 
			'utilizadoEn' => $oTabla->utilizadoEn, 
			'codigoFuenteFinanciamientoSEM' => $oTabla->codigoFuenteFinanciamientoSEM, 
			'idAreaTramitaSeguros' => $oTabla->idAreaTramitaSeguros, 
			'esUsadoEnCaja' => $oTabla->esUsadoEnCaja, 
			'codigoHIS' => $oTabla->codigoHIS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idTipoFinanciador' => $oTabla->idTipoFinanciador, 
			'codigo' => $oTabla->codigo, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FuentesFinanciamientoModificar :descripcion, :idFuenteFinanciamiento, :idTipoConceptoFarmacia, :utilizadoEn, :codigoFuenteFinanciamientoSEM, :idAreaTramitaSeguros, :esUsadoEnCaja, :codigoHIS, :idUsuarioAuditoria, :idTipoFinanciador, :codigo";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idTipoConceptoFarmacia' => $oTabla->idTipoConceptoFarmacia, 
			'utilizadoEn' => $oTabla->utilizadoEn, 
			'codigoFuenteFinanciamientoSEM' => $oTabla->codigoFuenteFinanciamientoSEM, 
			'idAreaTramitaSeguros' => $oTabla->idAreaTramitaSeguros, 
			'esUsadoEnCaja' => $oTabla->esUsadoEnCaja, 
			'codigoHIS' => $oTabla->codigoHIS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idTipoFinanciador' => $oTabla->idTipoFinanciador, 
			'codigo' => $oTabla->codigo, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FuentesFinanciamientoEliminar :idFuenteFinanciamiento, :idUsuarioAuditoria";

		$params = [
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FuentesFinanciamientoSeleccionarPorId :idFuenteFinanciamiento";

		$params = [
			'idFuenteFinanciamiento' => $oTabla->idFuenteFinanciamiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorTipoFinanciamiento($lIdFuenteFinanciamiento)
	{
		$query = "
			EXEC FuentesFinanciamientoSeleccionarPorTipoFinanciamiento :idTipoFinanciamiento";

		$params = [
			'idTipoFinanciamiento' => $lIdFuenteFinanciamiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC FuentesFinanciamientoSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdentificador($lnIdFuenteFinanciamiento)
	{
		$query = "
			EXEC FuentesFinanciamientoSeleccionarPorId :idFuenteFinanciamiento";

		$params = [
			'idFuenteFinanciamiento' => LnIdFuenteFinanciamiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FuentesFinanciamientoSegunFiltro($lcFiltro)
	{
		$query = "
			EXEC FuentesFinanciamientoSegunFiltro :lcfiltro";

		$params = [
			'lcfiltro' => $lcFiltro, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigo($sCodigo)
	{
		$query = "
			EXEC FuentesFinanciamientoSeleccionarPorCodigo :codigo";

		$params = [
			'codigo' => $sCodigo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}