<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ImagCatalgoServicioDuracion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC ImagCatalgoServicioDuracionAgregar :idProducto, :duracionEnMin, :esActivo, :fechaCrea, :fechaEdita, :idUsuarioAuditoria";

		$params = [
			'idProducto' => $oTabla->idProducto, 
			'duracionEnMin' => $oTabla->duracionEnMin, 
			'esActivo' => ($oTabla->esActivo == 0)? Null: $oTabla->esActivo, 
			'fechaCrea' => ($oTabla->fechaCrea == 0)? Null: $oTabla->fechaCrea, 
			'fechaEdita' => ($oTabla->fechaEdita == 0)? Null: $oTabla->fechaEdita, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ImagCatalgoServicioDuracionModificar :idProducto, :duracionEnMin, :esActivo, :fechaCrea, :fechaEdita, :idUsuarioAuditoria";

		$params = [
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'duracionEnMin' => $oTabla->duracionEnMin, 
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
			EXEC ImagCatalgoServicioDuracionEliminar :idProducto, :idUsuarioAuditoria";

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
			EXEC ImagCatalgoServicioDuracionSeleccionarPorId :idProducto";

		$params = [
			'idProducto' => $oTabla->idProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarTodos($oTabla)
	{
		$query = "
			EXEC ImagCatalgoServicioDuracionFiltrarTodos :codigo, :nombre";

		$params = [
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}