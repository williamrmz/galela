<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ImagSala extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idSala AS Int = :idSala
			SET NOCOUNT ON 
			EXEC ImagSalaAgregar @idSala OUTPUT, :idTipoModalidadSala, :sala, :codigo, :esActivo, :fechaCrea, :fechaEdita, :idUsuarioAuditoria
			SELECT @idSala AS idSala";

		$params = [
			'idSala' => 0, 
			'idTipoModalidadSala' => ($oTabla->idTipoModalidadSala == 0)? Null: $oTabla->idTipoModalidadSala, 
			'sala' => ($oTabla->sala == "")? Null: $oTabla->sala, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'esActivo' => ($oTabla->esActivo == 0)? Null: $oTabla->esActivo, 
			'fechaCrea' => ($oTabla->fechaCrea == 0)? Null: $oTabla->fechaCrea, 
			'fechaEdita' => ($oTabla->fechaEdita == 0)? Null: $oTabla->fechaEdita, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ImagSalaModificar :idSala, :idTipoModalidadSala, :sala, :codigo, :esActivo, :fechaCrea, :fechaEdita, :idUsuarioAuditoria";

		$params = [
			'idSala' => ($oTabla->idSala == 0)? Null: $oTabla->idSala, 
			'idTipoModalidadSala' => ($oTabla->idTipoModalidadSala == 0)? Null: $oTabla->idTipoModalidadSala, 
			'sala' => ($oTabla->sala == "")? Null: $oTabla->sala, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'esActivo' => ($oTabla->esActivo == 0)? Null: $oTabla->esActivo, 
			'fechaCrea' => ($oTabla->fechaCrea == 0)? Null: $oTabla->fechaCrea, 
			'fechaEdita' => ($oTabla->fechaEdita == 0)? Null: $oTabla->fechaEdita, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ImagSalaEliminar :idSala, :idUsuarioAuditoria";

		$params = [
			'idSala' => $oTabla->idSala, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ImagSalaSeleccionarPorId :idSala";

		$params = [
			'idSala' => $oTabla->idSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC ImagSalaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function VerificarPorNombre($oTabla)
	{
		$query = "
			EXEC ImagSalaVerificaNombre :idSala, :sala, :codigo";

		$params = [
			'idSala' => $oTabla->idSala, 
			'sala' => ($oTabla->sala == "")? Null: $oTabla->sala, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarPorTipoModalidad($oTabla)
	{
		$query = "
			EXEC ImagSalaSeleccionarPorTipoModalidad :idTipoModalidadSala";

		$params = [
			'idTipoModalidadSala' => $oTabla->idTipoModalidadSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarTodos($oTabla)
	{
		$query = "
			EXEC ImagSalaFiltrarTodos :sala, :codigo";

		$params = [
			'sala' => ($oTabla->sala == "")? Null: $oTabla->sala, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}