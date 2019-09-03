<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class A_resatencion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC a_resatencionAgregar :pers_IdResAtencion, :pers_IdTipoDocumento, :pers_ApePaterno, :pers_ApeMaterno, :pers_PriNombre, :pers_OtrNombre, :pers_IdTipoPersonalSalud, :pers_Colegiatura, :pers_IdEspecialidad, :pers_NroEspecialidad, :pers_IdEstado, :idUsuarioAuditoria";

		$params = [
			'pers_IdResAtencion' => ($oTabla->pers_IdResAtencion == "")? Null: $oTabla->pers_IdResAtencion, 
			'pers_IdTipoDocumento' => ($oTabla->pers_IdTipoDocumento == "")? Null: $oTabla->pers_IdTipoDocumento, 
			'pers_ApePaterno' => ($oTabla->pers_ApePaterno == "")? Null: $oTabla->pers_ApePaterno, 
			'pers_ApeMaterno' => ($oTabla->pers_ApeMaterno == "")? Null: $oTabla->pers_ApeMaterno, 
			'pers_PriNombre' => ($oTabla->pers_PriNombre == "")? Null: $oTabla->pers_PriNombre, 
			'pers_OtrNombre' => ($oTabla->pers_OtrNombre == "")? Null: $oTabla->pers_OtrNombre, 
			'pers_IdTipoPersonalSalud' => ($oTabla->pers_IdTipoPersonalSalud == "")? Null: $oTabla->pers_IdTipoPersonalSalud, 
			'pers_Colegiatura' => ($oTabla->pers_Colegiatura == "")? Null: $oTabla->pers_Colegiatura, 
			'pers_IdEspecialidad' => (Val($oTabla->pers_IdEspecialidad) == 0)? Null: $oTabla->pers_IdEspecialidad, 
			'pers_NroEspecialidad' => ($oTabla->pers_NroEspecialidad == "")? Null: $oTabla->pers_NroEspecialidad, 
			'pers_IdEstado' => ($oTabla->pers_IdEstado == "")? Null: $oTabla->pers_IdEstado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC a_resatencionModificar :pers_IdResAtencion, :pers_IdTipoDocumento, :pers_ApePaterno, :pers_ApeMaterno, :pers_PriNombre, :pers_OtrNombre, :pers_IdTipoPersonalSalud, :pers_Colegiatura, :pers_IdEspecialidad, :pers_NroEspecialidad, :pers_IdEstado, :idUsuarioAuditoria";

		$params = [
			'pers_IdResAtencion' => ($oTabla->pers_IdResAtencion == "")? Null: $oTabla->pers_IdResAtencion, 
			'pers_IdTipoDocumento' => ($oTabla->pers_IdTipoDocumento == "")? Null: $oTabla->pers_IdTipoDocumento, 
			'pers_ApePaterno' => ($oTabla->pers_ApePaterno == "")? Null: $oTabla->pers_ApePaterno, 
			'pers_ApeMaterno' => ($oTabla->pers_ApeMaterno == "")? Null: $oTabla->pers_ApeMaterno, 
			'pers_PriNombre' => ($oTabla->pers_PriNombre == "")? Null: $oTabla->pers_PriNombre, 
			'pers_OtrNombre' => ($oTabla->pers_OtrNombre == "")? Null: $oTabla->pers_OtrNombre, 
			'pers_IdTipoPersonalSalud' => ($oTabla->pers_IdTipoPersonalSalud == "")? Null: $oTabla->pers_IdTipoPersonalSalud, 
			'pers_Colegiatura' => ($oTabla->pers_Colegiatura == "")? Null: $oTabla->pers_Colegiatura, 
			'pers_IdEspecialidad' => (Val($oTabla->pers_IdEspecialidad) == 0)? Null: $oTabla->pers_IdEspecialidad, 
			'pers_NroEspecialidad' => ($oTabla->pers_NroEspecialidad == "")? Null: $oTabla->pers_NroEspecialidad, 
			'pers_IdEstado' => ($oTabla->pers_IdEstado == "")? Null: $oTabla->pers_IdEstado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC a_resatencionEliminar :pers_IdResAtencion, :pers_IdTipoDocumento, :idUsuarioAuditoria";

		$params = [
			'pers_IdResAtencion' => $oTabla->pers_IdResAtencion, 
			'pers_IdTipoDocumento' => $oTabla->pers_IdTipoDocumento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC a_resatencionSeleccionarPorId :pers_IdResAtencion, :pers_IdTipoDocumento";

		$params = [
			'pers_IdResAtencion' => $oTabla->pers_IdResAtencion, 
			'pers_IdTipoDocumento' => $oTabla->pers_IdTipoDocumento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}