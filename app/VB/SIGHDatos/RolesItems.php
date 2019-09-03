<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class RolesItems extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idRolItem AS Int = :idRolItem
			SET NOCOUNT ON 
			EXEC RolesItemsAgregar :consultar, :eliminar, :modificar, :agregar, :idRol, :idListItem, @idRolItem OUTPUT, :idUsuarioAuditoria
			SELECT @idRolItem AS idRolItem";

		$params = [
			'consultar' => ($oTabla->consultar == 0)? 0: $oTabla->consultar, 
			'eliminar' => ($oTabla->eliminar == 0)? 0: $oTabla->eliminar, 
			'modificar' => ($oTabla->modificar == 0)? 0: $oTabla->modificar, 
			'agregar' => ($oTabla->agregar == 0)? 0: $oTabla->agregar, 
			'idRol' => ($oTabla->idRol == 0)? 0: $oTabla->idRol, 
			'idListItem' => ($oTabla->idListItem == 0)? 0: $oTabla->idListItem, 
			'idRolItem' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC RolesItemsModificar :consultar, :eliminar, :modificar, :agregar, :idRol, :idListItem, :idRolItem, :idUsuarioAuditoria";

		$params = [
			'consultar' => ($oTabla->consultar == 0)? 0: $oTabla->consultar, 
			'eliminar' => ($oTabla->eliminar == 0)? 0: $oTabla->eliminar, 
			'modificar' => ($oTabla->modificar == 0)? 0: $oTabla->modificar, 
			'agregar' => ($oTabla->agregar == 0)? 0: $oTabla->agregar, 
			'idRol' => ($oTabla->idRol == 0)? 0: $oTabla->idRol, 
			'idListItem' => ($oTabla->idListItem == 0)? 0: $oTabla->idListItem, 
			'idRolItem' => ($oTabla->idRolItem == 0)? 0: $oTabla->idRolItem, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC RolesItemsEliminar :idRolItem, :idUsuarioAuditoria";

		$params = [
			'idRolItem' => ($oTabla->idRolItem == 0)? Null: $oTabla->idRolItem, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC RolesItemsSeleccionarPorId :idRolItem";

		$params = [
			'idRolItem' => $oTabla->idRolItem, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarGruposPorUsuario($lIdUsuario)
	{
		$query = "
			EXEC RolesItemsSeleccionarGruposPorUsuario :lIdUsuario";

		$params = [
			'lIdUsuario' => $lIdUsuario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarItemsPorUsuarioYGrupo($lIdUsuario, $lIdGrupo)
	{
		$query = "
			EXEC RolesItemsSeleccionarItemsPorUsuarioYGrupo :lIdGrupo, :lIdUsuario";

		$params = [
			'lIdGrupo' => $lIdGrupo, 
			'lIdUsuario' => $lIdUsuario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarRolesItems($oRolesItems, $lIdRol)
	{
		$query = "
			EXEC RolesItemsEliminarXidRol :lIdRol";

		$params = [
			'lIdRol' => $lIdRol, 
		];
		
		$data = \DB::update($query, $params);

		foreach($oRolesItems as $oRolItem){
			$oRolItem->idRol = $lIdRol;
			$data = $this->Insertar( $oRolItem );
		}

		return true;
	}

	public function EliminarRolesItems($lIdRol)
	{
		$query = "
			EXEC RolesItemsEliminarXidRol :lIdRol";

		$params = [
			'lIdRol' => $lIdRol, 
		];
		
		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorRol($lIdRol)
	{
		$query = "
			EXEC RolesItemsSeleccionarPorRol :idRol";

		$params = [
			'idRol' => $lIdRol, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPermisosPorIdEmpleadoYIdListItem($lIdEmpleado, $lIdListItem)
	{
		$query = "
			EXEC RolesItemSeleccionarPermisosPorIdEmpleadoYIdListItem :idEmpleado, :idListItem";

		$params = [
			'idEmpleado' => $lIdEmpleado, 
			'idListItem' => $lIdListItem, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}