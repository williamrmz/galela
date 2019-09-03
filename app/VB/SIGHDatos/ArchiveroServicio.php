<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ArchiveroServicio extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idArchivero AS Int = :idArchivero
			SET NOCOUNT ON 
			EXEC ArchiveroServicioAgregar :idServicio, :idEmpleado, @idArchivero OUTPUT, :idUsuarioAuditoria
			SELECT @idArchivero AS idArchivero";

		$params = [
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idEmpleado' => ($oTabla->idEmpleado == 0)? Null: $oTabla->idEmpleado, 
			'idArchivero' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];
		// dd($params);
		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ArchiveroServicioModificar :idServicio, :idEmpleado, :idArchivero, :idUsuarioAuditoria";

		$params = [
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idEmpleado' => ($oTabla->idEmpleado == 0)? Null: $oTabla->idEmpleado, 
			'idArchivero' => ($oTabla->idArchivero == 0)? Null: $oTabla->idArchivero, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ArchiveroServicioEliminar :idArchivero, :idUsuarioAuditoria";

		$params = [
			'idArchivero' => ($oTabla->idArchivero == 0)? Null: $oTabla->idArchivero, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ArchiveroServicioSeleccionarPorId :idArchivero";

		$params = [
			'idArchivero' => $oTabla->idArchivero, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AgregarVarios($oArchiveroServicio)
	{
		foreach( $oArchiveroServicio as $oDOArchivero){
			$isertarArchivos = $this->Insertar($oDOArchivero);
		}
		return true;
	}

	public function ModificarVarios($oArchiveroServicio, $idEmpleado)
	{
		$query = "EXEC ArchiveroServicioEliminarXIdEmpleado :idEmpleado";
		$params = [ 'idEmpleado' => $idEmpleado, ];
		$eliminarArchiveros = \DB::update($query, $params);
		// dd($eliminarArchiveros);
		foreach( $oArchiveroServicio as $oDOArchivero){
			$isertarArchivero = $this->Insertar($oDOArchivero);
		}
		return true;
	}

	public function EliminarVarios($oArchiveroServicio, $idEmpleado)
	{
		$query = "EXEC ArchiveroServicioEliminarXIdEmpleado :idEmpleado";
		$params = [ 'idEmpleado' => $idEmpleado, ];
		$eliminarArchiveros = \DB::update($query, $params);
		return true;
	}

	public function Filtrar($oDOEmpleado)
	{
		// dd($oDOEmpleado);
		$sWhere = "";
		if( $oDOEmpleado->apellidoPaterno <> "") {
			$sWhere = $sWhere . " Empleados.ApellidoPaterno like '" . $oDOEmpleado->apellidoPaterno . "%' and ";
		}
		if( $oDOEmpleado->apellidoMaterno <> "") {
			$sWhere = $sWhere . " Empleados.ApellidoMaterno like '" . $oDOEmpleado->apellidoMaterno . "%' and ";
		}
		if( $oDOEmpleado->nombres <> "") {
			$sWhere = $sWhere . " Empleados.Nombres like '" . $oDOEmpleado->nombres . "%' and ";
		}
		if( $oDOEmpleado->codigoPlanilla <> "") {
			$sWhere = $sWhere . " Empleados.CodigoPlanilla ='" . $oDOEmpleado->codigoPlanilla . "' and ";
		}
		if( $sWhere <> "") {
			$sWhere = substr($sWhere, 0, strlen($sWhere) - 4);
		}
		// dd($sWhere);

		$query = "
			EXEC ArchiveroServicioFiltro :lcFiltro";

		$params = [
			'lcFiltro' => $sWhere, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarPorEmpleado($lIdEmpleado)
	{
		$query = "
			EXEC ArchiveroServicioXidEmpleado :lIdEmpleado";

		$params = [
			'lIdEmpleado' => $lIdEmpleado, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}