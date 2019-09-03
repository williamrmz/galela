<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FacturacionServicioDespacho extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC FacturacionServicioDespachoAgregar :idOrden, :idProducto, :cantidad, :precio, :total, :labConfHIS, :grupoHIS, :subGrupoHIS, :idUsuarioAuditoria, :idReceta, :idDiagnostico";

		$params = [
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidad' => $oTabla->cantidad, 
			'precio' => $oTabla->precio, 
			'total' => $oTabla->total, 
			'labConfHIS' => $oTabla->labConfHIS, 
			'grupoHIS' => $oTabla->grupoHIS, 
			'subGrupoHIS' => $oTabla->subGrupoHIS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idReceta' => ($oTabla->idReceta == 0)? Null: $oTabla->idReceta, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FacturacionServicioDespachoModificar :idOrden, :idProducto, :cantidad, :precio, :total, :grupoHIS, :subGrupoHIS, :idUsuarioAuditoria, :idReceta, :idDiagnostico";

		$params = [
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidad' => ($oTabla->cantidad == 0)? Null: $oTabla->cantidad, 
			'precio' => $oTabla->precio, 
			'total' => $oTabla->total, 
			'grupoHIS' => $oTabla->grupoHIS, 
			'subGrupoHIS' => $oTabla->subGrupoHIS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idReceta' => ($oTabla->idReceta == 0)? Null: $oTabla->idReceta, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FacturacionServicioDespachoEliminar :idOrden, :idUsuarioAuditoria";

		$params = [
			'idOrden' => $oTabla->idOrden, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function EliminarxIdProducto($oTabla)
	{
		$query = "
			EXEC FacturacionServicioDespachoEliminarXidProducto :idOrden, :idproducto, :idUsuarioAuditoria";

		$params = [
			'idOrden' => $oTabla->idOrden, 
			'idproducto' => $oTabla->idProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FacturacionServicioDespachoSeleccionarPorId :idOrden";

		$params = [
			'idOrden' => $oTabla->idOrden, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdProducto($lnIdProducto)
	{
		$query = "
			EXEC FacturacionServicioDespachoSeleccionarPorIdProducto :idProducto";

		$params = [
			'idProducto' => $lnIdProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}