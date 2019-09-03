<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Visitantes extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idVisitante AS Int = :idVisitante
			SET NOCOUNT ON 
			EXEC VisitantesAgregar @idVisitante OUTPUT, :idDocIdentidad, :apellidoPaterno, :apellidoMaterno, :primerNombre, :segundoNombre, :nroDocumento, :idTipoSexo, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idVisitante AS idVisitante";

		$params = [
			'idVisitante' => 0, 
			'idDocIdentidad' => ($oTabla->idDocIdentidad == 0)? Null: $oTabla->idDocIdentidad, 
			'apellidoPaterno' => ($oTabla->apellidoPaterno == "")? Null: $oTabla->apellidoPaterno, 
			'apellidoMaterno' => ($oTabla->apellidoMaterno == "")? Null: $oTabla->apellidoMaterno, 
			'primerNombre' => ($oTabla->primerNombre == "")? Null: $oTabla->primerNombre, 
			'segundoNombre' => ($oTabla->segundoNombre == "")? Null: $oTabla->segundoNombre, 
			'nroDocumento' => ($oTabla->nroDocumento == "")? Null: $oTabla->nroDocumento, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC VisitantesModificar :idVisitante, :idDocIdentidad, :apellidoPaterno, :apellidoMaterno, :primerNombre, :segundoNombre, :nroDocumento, :idTipoSexo, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idVisitante' => ($oTabla->idVisitante == 0)? Null: $oTabla->idVisitante, 
			'idDocIdentidad' => ($oTabla->idDocIdentidad == 0)? Null: $oTabla->idDocIdentidad, 
			'apellidoPaterno' => ($oTabla->apellidoPaterno == "")? Null: $oTabla->apellidoPaterno, 
			'apellidoMaterno' => ($oTabla->apellidoMaterno == "")? Null: $oTabla->apellidoMaterno, 
			'primerNombre' => ($oTabla->primerNombre == "")? Null: $oTabla->primerNombre, 
			'segundoNombre' => ($oTabla->segundoNombre == "")? Null: $oTabla->segundoNombre, 
			'nroDocumento' => ($oTabla->nroDocumento == "")? Null: $oTabla->nroDocumento, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC VisitantesEliminar :idVisitante, :idUsuarioAuditoria";

		$params = [
			'idVisitante' => $oTabla->idVisitante, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC VisitantesSeleccionarPorId :idVisitante";

		$params = [
			'idVisitante' => $oTabla->idVisitante, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDocumento()
	{
		$query = "
			EXEC ListarDocumentoPreIngreso ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarSexo()
	{
		$query = "
			EXEC ListarTipoSexo ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarVisitantes($oDOEmpleado)
	{
		$query = "
			EXEC VisitasFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorDoc($oTabla)
	{
		$query = "
			EXEC VisitanesSelPorDoc :idDocIdentidad, :nroDocumento";

		$params = [
			'idDocIdentidad' => $oTabla->idDocIdentidad, 
			'nroDocumento' => $oTabla->nroDocumento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}