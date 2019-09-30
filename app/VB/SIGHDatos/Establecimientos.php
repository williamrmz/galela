<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;
use App\VB\SIGHEntidades\Enumerados;
use App\VB\SIGHEntidades\Cadena;

use DB;

class Establecimientos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC EstablecimientosAgregar :idEstablecimiento, :codigo, :nombre, :idDistrito, :idTipo, :idUsuarioAuditoria";

		$params = [
			'idEstablecimiento' => $oTabla->idEstablecimiento, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idDistrito' => ($oTabla->idDistrito == 0)? Null: $oTabla->idDistrito, 
			'idTipo' => ($oTabla->idTipo == 0)? Null: $oTabla->idTipo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			DECLARE @idEstablecimiento AS Int = :idEstablecimiento
			SET NOCOUNT ON 
			EXEC EstablecimientosModificar @idEstablecimiento OUTPUT, :codigo, :nombre, :idDistrito, :idTipo, :idUsuarioAuditoria
			SELECT @idEstablecimiento AS idEstablecimiento";

		$params = [
			'idEstablecimiento' => 0, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idDistrito' => ($oTabla->idDistrito == 0)? Null: $oTabla->idDistrito, 
			'idTipo' => ($oTabla->idTipo == 0)? Null: $oTabla->idTipo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC EstablecimientosEliminar :idEstablecimiento, :idUsuarioAuditoria";

		$params = [
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC EstablecimientosSeleccionarPorId :idEstablecimiento";

		$params = [
			'idEstablecimiento' => $oTabla->idEstablecimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	// Updated By Romel Diaz at 2019-09-04 
	public function Filtrar($oTabla, $lDepartamento, $lProvincia)
	{
		$sSql = ""; $sWhere = "";
		if ($oTabla->codigo <> "") {
			//'mgaray201503
			$sWhere = $sWhere . " Establecimientos.Codigo = '" . Cadena::FormatoCodigoRENAES($oTabla->codigo, Enumerados::param('GALENHOS')) . "' and ";
		}
		
		if ($oTabla->nombre <> "") {
			$sWhere = $sWhere . " Establecimientos.Nombre like '%" . $oTabla->nombre . "%' and ";
		}

		if ($oTabla->idDistrito <> 0) {
			$sWhere = $sWhere . " Establecimientos.IdDistrito = " . $oTabla->idDistrito . " and ";
		}

		//'JVG - Adicion de Nivel maximo de Establecimiento
		if ($oTabla->idTipo <> 0 ) {
			$sWhere = $sWhere . " Establecimientos.IdTipo >= " . $oTabla->idTipo . " and ";
		}

		if ($lDepartamento <> 0) {
			$sWhere = $sWhere . " Departamentos.IdDepartamento = " . $lDepartamento . " and ";
		}
		if ($lProvincia <> 0) {
			$sWhere = $sWhere . " Provincias.IdProvincia = " . $lProvincia . " and ";
		}

		if ($sWhere <> "") {
			$sSql = $sSql . " where " . substr($sWhere, 0, strlen($sWhere) - 4);
		}

		$query = "
			EXEC EstablecimientosFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => $sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigo($oDoEstablecimiento)
	{
		$query = "
			EXEC EstablecimientosXcodigo :codi";

		$params = [
			'codi' => 0, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosEstablecimientoPorIdUsuario($idUsuario)
	{
		$query = "
			EXEC EstablecimientosPorIdUsuario :idUsuario";

		$params = [
			'idUsuario' => IdUsuario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosEstablecimientoPorId($oTabla)
	{
		$query = "
			EXEC EstablecimientosXid :idEstablecimiento";

		$params = [
			'idEstablecimiento' => $oTabla->idEstablecimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC EstablecimientosSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}