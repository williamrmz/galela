<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FacturacionBienesDevol extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC FacturacionBienesDevolucionesAgregar :movNumero, :movTipo, :idProducto, :cantidadAdevolver, :idComprobantePago, :idEstadoDevolucion, :fechaAutoriza, :idUsuarioAutoriza, :movNumeroE, :movTipoE, :idUsuarioAuditoria";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidadAdevolver' => ($oTabla->cantidadAdevolver == 0)? Null: $oTabla->cantidadAdevolver, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idEstadoDevolucion' => $oTabla->idEstadoDevolucion, 
			'fechaAutoriza' => ($oTabla->fechaAutoriza == 0)? Null: $oTabla->fechaAutoriza, 
			'idUsuarioAutoriza' => ($oTabla->idUsuarioAutoriza == 0)? Null: $oTabla->idUsuarioAutoriza, 
			'movNumeroE' => ($oTabla->movNumeroE == "")? Null: $oTabla->movNumeroE, 
			'movTipoE' => ($oTabla->movTipoE == "")? Null: $oTabla->movTipoE, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FacturacionBienesDevolucionesModificar :movNumero, :movTipo, :idProducto, :cantidadAdevolver, :idComprobantePago, :idEstadoDevolucion, :fechaAutoriza, :idUsuarioAutoriza, :movNumeroE, :movTipoE, :idUsuarioAuditoria";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidadAdevolver' => ($oTabla->cantidadAdevolver == 0)? Null: $oTabla->cantidadAdevolver, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idEstadoDevolucion' => $oTabla->idEstadoDevolucion, 
			'fechaAutoriza' => ($oTabla->fechaAutoriza == 0)? Null: $oTabla->fechaAutoriza, 
			'idUsuarioAutoriza' => ($oTabla->idUsuarioAutoriza == 0)? Null: $oTabla->idUsuarioAutoriza, 
			'movNumeroE' => ($oTabla->movNumeroE == "")? Null: $oTabla->movNumeroE, 
			'movTipoE' => ($oTabla->movTipoE == "")? Null: $oTabla->movTipoE, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FacturacionBienesDevolucionesEliminar :movNumero, :movTipo, :idUsuarioAuditoria";

		$params = [
			'movNumero' => $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FacturacionBienesDevolucionesSeleccionarPorId :movNumero, :movTipo";

		$params = [
			'movNumero' => $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdProducto($lcMovNumero, $lcMovTipo, $lnIdProducto)
	{
		$query = "
			EXEC FacturacionBienesDevolucionesSeleccionarPorIdProducto :movNumero, :movTipo, :idProducto";

		$params = [
			'movNumero' => LcMovNumero, 
			'movTipo' => LcMovTipo, 
			'idProducto' => $lnIdProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorMovNumeroE($oTabla)
	{
		$query = "
			EXEC FacturacionBienesDevolucionesEliminarPorMovNumeroE :movNumeroE, :movTipoE, :idUsuarioAuditoria";

		$params = [
			'movNumeroE' => $oTabla->movNumeroE, 
			'movTipoE' => ($oTabla->movTipoE == "")? Null: $oTabla->movTipoE, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorMovNumeroE($oTabla)
	{
		$query = "
			EXEC FacturacionBienesDevolucionesSeleccionarPorMovNumeroE :movNumeroE, :movTipoE";

		$params = [
			'movNumeroE' => $oTabla->movNumero, 
			'movTipoE' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}