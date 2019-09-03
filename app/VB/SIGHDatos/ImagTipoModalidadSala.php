<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ImagTipoModalidadSala extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTipoModalidadSala AS Int = :idTipoModalidadSala
			SET NOCOUNT ON 
			EXEC ImagTipoModalidadSalaAgregar @idTipoModalidadSala OUTPUT, :tipoModalidadSala, :codigo, :esActivo, :fechaCrea, :fechaEdita, :idUsuarioAuditoria
			SELECT @idTipoModalidadSala AS idTipoModalidadSala";

		$params = [
			'idTipoModalidadSala' => 0, 
			'tipoModalidadSala' => ($oTabla->tipoModalidadSala == "")? Null: $oTabla->tipoModalidadSala, 
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
			EXEC ImagTipoModalidadSalaModificar :idTipoModalidadSala, :tipoModalidadSala, :codigo, :esActivo, :fechaCrea, :fechaEdita, :idUsuarioAuditoria";

		$params = [
			'idTipoModalidadSala' => ($oTabla->idTipoModalidadSala == 0)? Null: $oTabla->idTipoModalidadSala, 
			'tipoModalidadSala' => ($oTabla->tipoModalidadSala == "")? Null: $oTabla->tipoModalidadSala, 
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
			EXEC ImagTipoModalidadSalaEliminar :idTipoModalidadSala, :idUsuarioAuditoria";

		$params = [
			'idTipoModalidadSala' => $oTabla->idTipoModalidadSala, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ImagTipoModalidadSalaSeleccionarPorId :idTipoModalidadSala";

		$params = [
			'idTipoModalidadSala' => $oTabla->idTipoModalidadSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC ImagTipoModalidadSalaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function VerificarPorNombre($oTabla)
	{
		$query = "
			EXEC ImagTipoModalidadSalaVerificaNombre :idTipoModalidadSala, :tipoModalidadSala, :codigo";

		$params = [
			'idTipoModalidadSala' => $oTabla->idTipoModalidadSala, 
			'tipoModalidadSala' => ($oTabla->tipoModalidadSala == "")? Null: $oTabla->tipoModalidadSala, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarTodos($oTabla)
	{
		$query = "
			EXEC ImagTipoModalidadSalaFiltrarTodos :tipoModalidadSala, :codigo";

		$params = [
			'tipoModalidadSala' => ($oTabla->tipoModalidadSala == "")? Null: $oTabla->tipoModalidadSala, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}