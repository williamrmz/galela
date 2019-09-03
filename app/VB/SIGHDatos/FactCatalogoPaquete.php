<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FactCatalogoPaquete extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idFactPaquete AS Int = :idFactPaquete
			SET NOCOUNT ON 
			EXEC FactCatalogoPaqueteAgregar @idFactPaquete OUTPUT, :codigo, :descripcion, :idTipoFinanciamiento, :fechaCreacion, :idUsuario, :idEstado, :tipoPaquete, :idPuntoCarga, :idUsuarioAuditoria
			SELECT @idFactPaquete AS idFactPaquete";

		$params = [
			'idFactPaquete' => 0, 
			'codigo' => $oTabla->codigo, 
			'descripcion' => $oTabla->descripcion, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idEstado' => ($oTabla->idEstado == 0)? Null: $oTabla->idEstado, 
			'tipoPaquete' => ($oTabla->tipoPaquete == 0)? Null: $oTabla->tipoPaquete, 
			'idPuntoCarga' => ($oTabla->ptoCarga == 0)? Null: $oTabla->ptoCarga, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactCatalogoPaqueteModificar :idFactPaquete, :codigo, :descripcion, :idTipoFinanciamiento, :fechaCreacion, :idUsuario, :idEstado, :tipoPaquete, :idPuntoCarga, :idUsuarioAuditoria";

		$params = [
			'idFactPaquete' => ($oTabla->idFactPaquete == 0)? Null: $oTabla->idFactPaquete, 
			'codigo' => $oTabla->codigo, 
			'descripcion' => $oTabla->descripcion, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idEstado' => ($oTabla->idEstado == 0)? Null: $oTabla->idEstado, 
			'tipoPaquete' => ($oTabla->tipoPaquete == 0)? Null: $oTabla->tipoPaquete, 
			'idPuntoCarga' => ($oTabla->ptoCarga == 0)? Null: $oTabla->ptoCarga, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactCatalogoPaqueteEliminar :idFactPaquete, :idUsuarioAuditoria";

		$params = [
			'idFactPaquete' => $oTabla->idFactPaquete, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactCatalogoPaqueteSeleccionarPorId :idFactPaquete";

		$params = [
			'idFactPaquete' => $oTabla->idFactPaquete, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarPaquete($iid, $nombre)
	{
		$query = "
			EXEC FiltrarFactCatalogoPaqueteXtipoPaquete :idFactPaquete, :descripcion";

		$params = [
			'idFactPaquete' => $iid, 
			'descripcion' => $nombre, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarPuntosCarga()
	{
		$query = "
			EXEC ListarPtosCarga ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}