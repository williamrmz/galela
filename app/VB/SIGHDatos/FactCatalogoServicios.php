<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FactCatalogoServicios extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idProducto AS Int = :idProducto
			SET NOCOUNT ON 
			EXEC FactCatalogoServiciosAgregar @idProducto OUTPUT, :codigo, :nombre, :idServicioGrupo, :idServicioSubGrupo, :idServicioSeccion, :idServicioSubSeccion, :idPartida, :idCentroCosto, :codMINSA, :codMINSAnoActualiza, :esCPT, :idOpcs, :nombreMINSA, :idEstado, :codigoSIS, :idUsuarioAuditoria
			SELECT @idProducto AS idProducto";

		$params = [
			'idProducto' => 0, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idServicioGrupo' => ($oTabla->idServicioGrupo == 0)? Null: $oTabla->idServicioGrupo, 
			'idServicioSubGrupo' => ($oTabla->idServicioSubGrupo == 0)? Null: $oTabla->idServicioSubGrupo, 
			'idServicioSeccion' => ($oTabla->idServicioSeccion == 0)? Null: $oTabla->idServicioSeccion, 
			'idServicioSubSeccion' => ($oTabla->idServicioSubSeccion == 0)? Null: $oTabla->idServicioSubSeccion, 
			'idPartida' => ($oTabla->idPartida == 0)? Null: $oTabla->idPartida, 
			'idCentroCosto' => ($oTabla->idCentroCosto == 0)? Null: $oTabla->idCentroCosto, 
			'codMINSA' => ($oTabla->codMINSA == "")? Null: $oTabla->codMINSA, 
			'codMINSAnoActualiza' => ($oTabla->codMINSAnoActualiza == 0)? Null: $oTabla->codMINSAnoActualiza, 
			'esCPT' => ($oTabla->esCpt == 0)? Null: $oTabla->esCpt, 
			'idOpcs' => ($oTabla->idOpcs == 0)? Null: $oTabla->idOpcs, 
			'nombreMINSA' => ($oTabla->nombreMINSA == "")? Null: $oTabla->nombreMINSA, 
			'idEstado' => ($oTabla->idEstado == 0)? Null: $oTabla->idEstado, 
			'codigoSIS' => ($oTabla->codigoSIS == "")? Null: $oTabla->codigoSIS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosModificar :idProducto, :codigo, :nombre, :idServicioGrupo, :idServicioSubGrupo, :idServicioSeccion, :idServicioSubSeccion, :idPartida, :idCentroCosto, :codMINSA, :codMINSAnoActualiza, :esCPT, :idOpcs, :nombreMINSA, :idEstado, :codigoSIS, :idUsuarioAuditoria";

		$params = [
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idServicioGrupo' => ($oTabla->idServicioGrupo == 0)? Null: $oTabla->idServicioGrupo, 
			'idServicioSubGrupo' => ($oTabla->idServicioSubGrupo == 0)? Null: $oTabla->idServicioSubGrupo, 
			'idServicioSeccion' => ($oTabla->idServicioSeccion == 0)? Null: $oTabla->idServicioSeccion, 
			'idServicioSubSeccion' => ($oTabla->idServicioSubSeccion == 0)? Null: $oTabla->idServicioSubSeccion, 
			'idPartida' => ($oTabla->idPartida == 0)? Null: $oTabla->idPartida, 
			'idCentroCosto' => ($oTabla->idCentroCosto == 0)? Null: $oTabla->idCentroCosto, 
			'codMINSA' => ($oTabla->codMINSA == "")? Null: $oTabla->codMINSA, 
			'codMINSAnoActualiza' => ($oTabla->codMINSAnoActualiza == 0)? Null: $oTabla->codMINSAnoActualiza, 
			'esCPT' => ($oTabla->esCpt == 0)? Null: $oTabla->esCpt, 
			'idOpcs' => ($oTabla->idOpcs == 0)? Null: $oTabla->idOpcs, 
			'nombreMINSA' => ($oTabla->nombreMINSA == "")? Null: $oTabla->nombreMINSA, 
			'idEstado' => ($oTabla->idEstado == 0)? Null: $oTabla->idEstado, 
			'codigoSIS' => ($oTabla->codigoSIS == "")? Null: $oTabla->codigoSIS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosEliminar :idProducto, :idUsuarioAuditoria";

		$params = [
			'idProducto' => $oTabla->idProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosSeleccionarPorId :idProducto";

		$params = [
			'idProducto' => $oTabla->idProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarProcedimientosMQ($iid, $nombre)
	{
		$query = "
			EXEC CQxProcedimientosFiltrar :id, :nombre";

		$params = [
			'id' => $iid, 
			'nombre' => $nombre, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdx($oTabla)
	{
		$query = "
			EXEC CQxProcedimientosSeleccionarPorId :idProducto";

		$params = [
			'idProducto' => $oTabla->idProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}