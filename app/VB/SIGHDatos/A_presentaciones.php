<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class A_presentaciones extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC a_presentacionesAgregar :tpre_IdPresentacion, :tpre_Descripcion, :tpre_Abreviatura, :tpre_TopeMinimo, :tpre_TopeNoHosp, :tpre_TopeHosp, :tpre_IdEstado, :idUsuarioAuditoria";

		$params = [
			'tpre_IdPresentacion' => ($oTabla->tpre_IdPresentacion == "")? Null: $oTabla->tpre_IdPresentacion, 
			'tpre_Descripcion' => ($oTabla->tpre_Descripcion == "")? Null: $oTabla->tpre_Descripcion, 
			'tpre_Abreviatura' => ($oTabla->tpre_Abreviatura == "")? Null: $oTabla->tpre_Abreviatura, 
			'tpre_TopeMinimo' => ($oTabla->tpre_TopeMinimo == 0)? Null: $oTabla->tpre_TopeMinimo, 
			'tpre_TopeNoHosp' => ($oTabla->tpre_TopeNoHosp == 0)? Null: $oTabla->tpre_TopeNoHosp, 
			'tpre_TopeHosp' => ($oTabla->tpre_TopeHosp == 0)? Null: $oTabla->tpre_TopeHosp, 
			'tpre_IdEstado' => $oTabla->tpre_IdEstado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC a_presentacionesModificar :tpre_IdPresentacion, :tpre_Descripcion, :tpre_Abreviatura, :tpre_TopeMinimo, :tpre_TopeNoHosp, :tpre_TopeHosp, :tpre_IdEstado, :idUsuarioAuditoria";

		$params = [
			'tpre_IdPresentacion' => ($oTabla->tpre_IdPresentacion == "")? Null: $oTabla->tpre_IdPresentacion, 
			'tpre_Descripcion' => ($oTabla->tpre_Descripcion == "")? Null: $oTabla->tpre_Descripcion, 
			'tpre_Abreviatura' => ($oTabla->tpre_Abreviatura == "")? Null: $oTabla->tpre_Abreviatura, 
			'tpre_TopeMinimo' => ($oTabla->tpre_TopeMinimo == 0)? Null: $oTabla->tpre_TopeMinimo, 
			'tpre_TopeNoHosp' => ($oTabla->tpre_TopeNoHosp == 0)? Null: $oTabla->tpre_TopeNoHosp, 
			'tpre_TopeHosp' => ($oTabla->tpre_TopeHosp == 0)? Null: $oTabla->tpre_TopeHosp, 
			'tpre_IdEstado' => $oTabla->tpre_IdEstado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC a_presentacionesEliminar :tpre_IdPresentacion, :idUsuarioAuditoria";

		$params = [
			'tpre_IdPresentacion' => $oTabla->tpre_IdPresentacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC a_presentacionesSeleccionarPorId :tpre_IdPresentacion";

		$params = [
			'tpre_IdPresentacion' => $oTabla->tpre_IdPresentacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}