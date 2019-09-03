<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class M_medicamentos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC m_medicamentosAgregar :med_CodMed, :med_Nombre, :med_FormaFarmaceutica, :med_Presen, :med_Concen, :med_Costo, :med_Petitorio, :med_Petitorio2005, :med_Petitorio2010, :med_FecBaja, :med_FFDigemid, :med_IdEstado, :idUsuarioAuditoria";

		$params = [
			'med_CodMed' => ($oTabla->med_CodMed == "")? Null: $oTabla->med_CodMed, 
			'med_Nombre' => ($oTabla->med_Nombre == "")? Null: $oTabla->med_Nombre, 
			'med_FormaFarmaceutica' => ($oTabla->med_FormaFarmaceutica == "")? Null: $oTabla->med_FormaFarmaceutica, 
			'med_Presen' => ($oTabla->med_Presen == "")? "": $oTabla->med_Presen, 
			'med_Concen' => ($oTabla->med_Concen == "")? Null: $oTabla->med_Concen, 
			'med_Costo' => $oTabla->med_Costo, 
			'med_Petitorio' => ($oTabla->med_Petitorio == "")? "S": $oTabla->med_Petitorio, 
			'med_Petitorio2005' => ($oTabla->med_Petitorio2005 == "")? Null: $oTabla->med_Petitorio2005, 
			'med_Petitorio2010' => ($oTabla->med_Petitorio2010 == "")? Null: $oTabla->med_Petitorio2010, 
			'med_FecBaja' => ($oTabla->med_FecBaja == 0)? Null: $oTabla->med_FecBaja, 
			'med_FFDigemid' => ($oTabla->med_FFDigemid == "")? Null: $oTabla->med_FFDigemid, 
			'med_IdEstado' => ($oTabla->med_IdEstado == "")? Null: $oTabla->med_IdEstado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC m_medicamentosModificar :med_CodMed, :med_Nombre, :med_FormaFarmaceutica, :med_Presen, :med_Concen, :med_Costo, :med_Petitorio, :med_Petitorio2005, :med_Petitorio2010, :med_FecBaja, :med_FFDigemid, :med_IdEstado, :idUsuarioAuditoria";

		$params = [
			'med_CodMed' => ($oTabla->med_CodMed == "")? Null: $oTabla->med_CodMed, 
			'med_Nombre' => ($oTabla->med_Nombre == "")? Null: $oTabla->med_Nombre, 
			'med_FormaFarmaceutica' => ($oTabla->med_FormaFarmaceutica == "")? Null: $oTabla->med_FormaFarmaceutica, 
			'med_Presen' => ($oTabla->med_Presen == "")? "": $oTabla->med_Presen, 
			'med_Concen' => ($oTabla->med_Concen == "")? Null: $oTabla->med_Concen, 
			'med_Costo' => $oTabla->med_Costo, 
			'med_Petitorio' => ($oTabla->med_Petitorio == "")? "S": $oTabla->med_Petitorio, 
			'med_Petitorio2005' => ($oTabla->med_Petitorio2005 == "")? Null: $oTabla->med_Petitorio2005, 
			'med_Petitorio2010' => ($oTabla->med_Petitorio2010 == "")? Null: $oTabla->med_Petitorio2010, 
			'med_FecBaja' => ($oTabla->med_FecBaja == 0)? Null: $oTabla->med_FecBaja, 
			'med_FFDigemid' => ($oTabla->med_FFDigemid == "")? Null: $oTabla->med_FFDigemid, 
			'med_IdEstado' => ($oTabla->med_IdEstado == "")? Null: $oTabla->med_IdEstado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC m_medicamentosEliminar :med_CodMed, :idUsuarioAuditoria";

		$params = [
			'med_CodMed' => $oTabla->med_CodMed, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC m_medicamentosSeleccionarPorId :med_CodMed";

		$params = [
			'med_CodMed' => $oTabla->med_CodMed, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}