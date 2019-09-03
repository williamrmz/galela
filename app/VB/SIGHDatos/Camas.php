<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Camas extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idCama AS Int = :idCama
			SET NOCOUNT ON 
			EXEC CamasAgregar :y, :x, :idPaciente, :idServicioUbicacionActual, :codigo, :idEstadoCama, :idCondicionOcupacion, :idTiposCama, :idServicioPropietario, @idCama OUTPUT, :idUsuarioAuditoria
			SELECT @idCama AS idCama";

		$params = [
			'y' => ($oTabla->y == 0)? Null: $oTabla->y, 
			'x' => ($oTabla->x == 0)? Null: $oTabla->x, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idServicioUbicacionActual' => ($oTabla->idServicioUbicacionActual == 0)? Null: $oTabla->idServicioUbicacionActual, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idEstadoCama' => ($oTabla->idEstadoCama == 0)? Null: $oTabla->idEstadoCama, 
			'idCondicionOcupacion' => ($oTabla->idCondicionOcupacion == 0)? Null: $oTabla->idCondicionOcupacion, 
			'idTiposCama' => ($oTabla->idTiposCama == 0)? Null: $oTabla->idTiposCama, 
			'idServicioPropietario' => ($oTabla->idServicioPropietario == 0)? Null: $oTabla->idServicioPropietario, 
			'idCama' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CamasModificar :y, :x, :idPaciente, :idServicioUbicacionActual, :codigo, :idEstadoCama, :idCondicionOcupacion, :idTiposCama, :idServicioPropietario, :idCama, :idUsuarioAuditoria";

		$params = [
			'y' => ($oTabla->y == 0)? Null: $oTabla->y, 
			'x' => ($oTabla->x == 0)? Null: $oTabla->x, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idServicioUbicacionActual' => ($oTabla->idServicioUbicacionActual == 0)? Null: $oTabla->idServicioUbicacionActual, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idEstadoCama' => ($oTabla->idEstadoCama == 0)? Null: $oTabla->idEstadoCama, 
			'idCondicionOcupacion' => ($oTabla->idCondicionOcupacion == 0)? Null: $oTabla->idCondicionOcupacion, 
			'idTiposCama' => ($oTabla->idTiposCama == 0)? Null: $oTabla->idTiposCama, 
			'idServicioPropietario' => ($oTabla->idServicioPropietario == 0)? Null: $oTabla->idServicioPropietario, 
			'idCama' => ($oTabla->idCama == 0)? Null: $oTabla->idCama, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CamasEliminar :idCama, :idUsuarioAuditoria";

		$params = [
			'idCama' => ($oTabla->idCama == 0)? Null: $oTabla->idCama, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CamasSeleccionarPorId :idCama";

		$params = [
			'idCama' => $oTabla->idCama, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorServicioUbicacionActual($lIdServicio)
	{
		$query = "
			EXEC CamasSeleccionarPorServicioUbicacionActual :idServicio";

		$params = [
			'idServicio' => $lIdServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDisponibilidadPorServicioUbicacionActual($lIdServicio)
	{
		$query = "
			EXEC CamasSeleccionarDisponibilidadPorServicioUbicacionActual :idServicio";

		$params = [
			'idServicio' => $lIdServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarIdPaciente($lIdPaciente, $lIdCama)
	{
		$query = "
			EXEC CamasActualizaIdPaciente :lIdPaciente, :lIdPaciente, :lIdCama";

		$params = [
			'lIdPaciente' => $lIdPaciente, 
			'lIdPaciente' => $lIdPaciente, 
			'lIdCama' => $lIdCama, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigo($oTabla)
	{
		$query = "
			EXEC CamasSeleccionarXcodigo :codigo";

		$params = [
			'codigo' => $oTabla->codigo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerConElMismoCodigo($oTabla)
	{
		$query = "
			EXEC CamasObtenerConElMismoCodigo :codigo, :idCama";

		$params = [
			'codigo' => $oTabla->codigo, 
			'idCama' => $oTabla->idCama, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}