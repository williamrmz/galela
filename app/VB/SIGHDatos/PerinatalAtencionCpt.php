<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class PerinatalAtencionCpt extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionProcedimientosAgregar :idPerinatalAtencion, :idModulo, :idLista, :idProducto, :cptEsAutomatico, :codigoHIS, :idAtencion, :labConfHIS, :idUsuarioAuditoria";

		$params = [
			'idPerinatalAtencion' => ($oTabla->idPerinatalAtencion == 0)? Null: $oTabla->idPerinatalAtencion, 
			'idModulo' => ($oTabla->idModulo == 0)? Null: $oTabla->idModulo, 
			'idLista' => ($oTabla->idLista == 0)? Null: $oTabla->idLista, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cptEsAutomatico' => $oTabla->cptEsAutomatico, 
			'codigoHIS' => ($oTabla->codigoHIS == "")? Null: $oTabla->codigoHIS, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'labConfHIS' => ($oTabla->labConfHIS == "")? Null: $oTabla->labConfHIS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionProcedimientosModificar :idPerinatalAtencion, :idModulo, :idLista, :idProducto, :cptEsAutomatico, :codigoHIS, :idAtencion, :labConfHIS, :idUsuarioAuditoria";

		$params = [
			'idPerinatalAtencion' => ($oTabla->idPerinatalAtencion == 0)? Null: $oTabla->idPerinatalAtencion, 
			'idModulo' => ($oTabla->idModulo == 0)? Null: $oTabla->idModulo, 
			'idLista' => ($oTabla->idLista == 0)? Null: $oTabla->idLista, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cptEsAutomatico' => $oTabla->cptEsAutomatico, 
			'codigoHIS' => ($oTabla->codigoHIS == "")? Null: $oTabla->codigoHIS, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'labConfHIS' => ($oTabla->labConfHIS == "")? Null: $oTabla->labConfHIS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionProcedimientosEliminar :idPerinatalAtencion, :idUsuarioAuditoria";

		$params = [
			'idPerinatalAtencion' => $oTabla->idPerinatalAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionProcedimientosSeleccionarPorId :idPerinatalAtencion";

		$params = [
			'idPerinatalAtencion' => $oTabla->idPerinatalAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function PerinatalAtencionCptSeleccionarPorIdPerinatalAtencion($mo_idPerinatalAtencion)
	{
		$query = "
			EXEC PerinatalAtencionCptSeleccionarPorIdPerinatalAtencion :mo_idPerinatalAtencion";

		$params = [
			'mo_idPerinatalAtencion' => $mo_idPerinatalAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarXatencion($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionProcedimientosEliminarXidAtencion :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function ModificarOrdenServicio($oTabla)
	{
		$query = "
			EXEC PerinatalModificarOrdenServicio :idLista, :idAtencion, :idOrden, :idUsuarioAuditoria";

		$params = [
			'idLista' => ($oTabla->idLista == 0)? Null: $oTabla->idLista, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function PerinatalAtenBuscarOrdenServicioInmunizaciones($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionProcedimientoOrdenServicioInmunizaciones :idLista, :idAtencion";

		$params = [
			'idLista' => ($oTabla->idLista == 0)? Null: $oTabla->idLista, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}