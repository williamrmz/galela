<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class M_eess extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC m_eessAgregar :pre_IdEESS, :pre_Nombre, :pre_Afilia, :pre_UCI, :pre_IdCategoriaEESS, :pre_IdDisa, :pre_IdOdsis, :pre_IdUbigeo, :pre_CodEjeAdm, :pre_Vrae, :pre_Umbral, :pre_Aisped, :pre_esmn, :pre_IdEstado, :pre_CodigoRENAES, :idUsuarioAuditoria";

		$params = [
			'pre_IdEESS' => ($oTabla->pre_IdEESS == "")? Null: $oTabla->pre_IdEESS, 
			'pre_Nombre' => ($oTabla->pre_Nombre == "")? Null: $oTabla->pre_Nombre, 
			'pre_Afilia' => ($oTabla->pre_Afilia == "")? Null: $oTabla->pre_Afilia, 
			'pre_UCI' => ($oTabla->pre_UCI == "")? Null: $oTabla->pre_UCI, 
			'pre_IdCategoriaEESS' => ($oTabla->pre_IdCategoriaEESS == "")? Null: $oTabla->pre_IdCategoriaEESS, 
			'pre_IdDisa' => ($oTabla->pre_IdDisa == "")? Null: $oTabla->pre_IdDisa, 
			'pre_IdOdsis' => ($oTabla->pre_IdOdsis == "")? Null: $oTabla->pre_IdOdsis, 
			'pre_IdUbigeo' => ($oTabla->pre_IdUbigeo == "")? Null: $oTabla->pre_IdUbigeo, 
			'pre_CodEjeAdm' => ($oTabla->pre_CodEjeAdm == "")? Null: $oTabla->pre_CodEjeAdm, 
			'pre_Vrae' => ($oTabla->pre_Vrae == "")? Null: $oTabla->pre_Vrae, 
			'pre_Umbral' => ($oTabla->pre_Umbral == "")? Null: $oTabla->pre_Umbral, 
			'pre_Aisped' => ($oTabla->pre_Aisped == "")? Null: $oTabla->pre_Aisped, 
			'pre_esmn' => ($oTabla->pre_esmn == "")? Null: $oTabla->pre_esmn, 
			'pre_IdEstado' => ($oTabla->pre_IdEstado == "")? Null: $oTabla->pre_IdEstado, 
			'pre_CodigoRENAES' => ($oTabla->pre_CodigoRENAES == "")? Null: $oTabla->pre_CodigoRENAES, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC m_eessModificar :pre_IdEESS, :pre_Nombre, :pre_Afilia, :pre_UCI, :pre_IdCategoriaEESS, :pre_IdDisa, :pre_IdOdsis, :pre_IdUbigeo, :pre_CodEjeAdm, :pre_Vrae, :pre_Umbral, :pre_Aisped, :pre_esmn, :pre_IdEstado, :pre_CodigoRENAES, :idUsuarioAuditoria";

		$params = [
			'pre_IdEESS' => ($oTabla->pre_IdEESS == "")? Null: $oTabla->pre_IdEESS, 
			'pre_Nombre' => ($oTabla->pre_Nombre == "")? Null: $oTabla->pre_Nombre, 
			'pre_Afilia' => ($oTabla->pre_Afilia == "")? Null: $oTabla->pre_Afilia, 
			'pre_UCI' => ($oTabla->pre_UCI == "")? Null: $oTabla->pre_UCI, 
			'pre_IdCategoriaEESS' => ($oTabla->pre_IdCategoriaEESS == "")? Null: $oTabla->pre_IdCategoriaEESS, 
			'pre_IdDisa' => ($oTabla->pre_IdDisa == "")? Null: $oTabla->pre_IdDisa, 
			'pre_IdOdsis' => ($oTabla->pre_IdOdsis == "")? Null: $oTabla->pre_IdOdsis, 
			'pre_IdUbigeo' => ($oTabla->pre_IdUbigeo == "")? Null: $oTabla->pre_IdUbigeo, 
			'pre_CodEjeAdm' => ($oTabla->pre_CodEjeAdm == "")? Null: $oTabla->pre_CodEjeAdm, 
			'pre_Vrae' => ($oTabla->pre_Vrae == "")? Null: $oTabla->pre_Vrae, 
			'pre_Umbral' => ($oTabla->pre_Umbral == "")? Null: $oTabla->pre_Umbral, 
			'pre_Aisped' => ($oTabla->pre_Aisped == "")? Null: $oTabla->pre_Aisped, 
			'pre_esmn' => ($oTabla->pre_esmn == "")? Null: $oTabla->pre_esmn, 
			'pre_IdEstado' => ($oTabla->pre_IdEstado == "")? Null: $oTabla->pre_IdEstado, 
			'pre_CodigoRENAES' => ($oTabla->pre_CodigoRENAES == "")? Null: $oTabla->pre_CodigoRENAES, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC m_eessEliminar :pre_IdEESS, :idUsuarioAuditoria";

		$params = [
			'pre_IdEESS' => $oTabla->pre_IdEESS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC m_eessSeleccionarPorId :pre_IdEESS";

		$params = [
			'pre_IdEESS' => $oTabla->pre_IdEESS, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}