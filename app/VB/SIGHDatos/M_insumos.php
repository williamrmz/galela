<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class M_insumos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC m_insumosAgregar :ins_CodIns, :ins_Nombre, :ins_FormaFarmaceutica, :ins_Presen, :ins_Concen, :ins_Costo, :ins_Observacion, :ins_Petitorio, :ins_FecBaja, :ins_DocBaja, :ins_IdEstado, :idUsuarioAuditoria";

		$params = [
			'ins_CodIns' => ($oTabla->ins_CodIns == "")? Null: $oTabla->ins_CodIns, 
			'ins_Nombre' => ($oTabla->ins_Nombre == "")? Null: $oTabla->ins_Nombre, 
			'ins_FormaFarmaceutica' => ($oTabla->ins_FormaFarmaceutica == "")? Null: $oTabla->ins_FormaFarmaceutica, 
			'ins_Presen' => ($oTabla->ins_Presen == "")? Null: $oTabla->ins_Presen, 
			'ins_Concen' => ($oTabla->ins_Concen == "")? Null: $oTabla->ins_Concen, 
			'ins_Costo' => $oTabla->ins_Costo, 
			'ins_Observacion' => ($oTabla->ins_Observacion == "")? Null: $oTabla->ins_Observacion, 
			'ins_Petitorio' => ($oTabla->ins_Petitorio == "")? "S": $oTabla->ins_Petitorio, 
			'ins_FecBaja' => ($oTabla->ins_FecBaja == 0)? Null: $oTabla->ins_FecBaja, 
			'ins_DocBaja' => ($oTabla->ins_DocBaja == "")? Null: $oTabla->ins_DocBaja, 
			'ins_IdEstado' => ($oTabla->ins_IdEstado == "")? Null: $oTabla->ins_IdEstado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC m_insumosModificar :ins_CodIns, :ins_Nombre, :ins_FormaFarmaceutica, :ins_Presen, :ins_Concen, :ins_Costo, :ins_Observacion, :ins_Petitorio, :ins_FecBaja, :ins_DocBaja, :ins_IdEstado, :idUsuarioAuditoria";

		$params = [
			'ins_CodIns' => ($oTabla->ins_CodIns == "")? Null: $oTabla->ins_CodIns, 
			'ins_Nombre' => ($oTabla->ins_Nombre == "")? Null: $oTabla->ins_Nombre, 
			'ins_FormaFarmaceutica' => ($oTabla->ins_FormaFarmaceutica == "")? Null: $oTabla->ins_FormaFarmaceutica, 
			'ins_Presen' => ($oTabla->ins_Presen == "")? Null: $oTabla->ins_Presen, 
			'ins_Concen' => ($oTabla->ins_Concen == "")? Null: $oTabla->ins_Concen, 
			'ins_Costo' => $oTabla->ins_Costo, 
			'ins_Observacion' => ($oTabla->ins_Observacion == "")? Null: $oTabla->ins_Observacion, 
			'ins_Petitorio' => ($oTabla->ins_Petitorio == "")? "S": $oTabla->ins_Petitorio, 
			'ins_FecBaja' => ($oTabla->ins_FecBaja == 0)? Null: $oTabla->ins_FecBaja, 
			'ins_DocBaja' => ($oTabla->ins_DocBaja == "")? Null: $oTabla->ins_DocBaja, 
			'ins_IdEstado' => ($oTabla->ins_IdEstado == "")? Null: $oTabla->ins_IdEstado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC m_insumosEliminar :ins_CodIns, :idUsuarioAuditoria";

		$params = [
			'ins_CodIns' => $oTabla->ins_CodIns, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC m_insumosSeleccionarPorId :ins_CodIns";

		$params = [
			'ins_CodIns' => $oTabla->ins_CodIns, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}