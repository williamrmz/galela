<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FactOrdenServicioPagos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idOrdenPago AS Int = :idOrdenPago
			SET NOCOUNT ON 
			EXEC FactOrdenServicioPagosAgregar @idOrdenPago OUTPUT, :idComprobantePago, :idOrden, :fechaCreacion, :idUsuario, :idEstadoFacturacion, :importeExonerado, :idUsuarioExonera, :idUsuarioAuditoria
			SELECT @idOrdenPago AS idOrdenPago";

		$params = [
			'idOrdenPago' => 0, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idEstadoFacturacion' => ($oTabla->idEstadoFacturacion == 0)? Null: $oTabla->idEstadoFacturacion, 
			'importeExonerado' => $oTabla->importeExonerado, 
			'idUsuarioExonera' => $oTabla->idUsuarioExonera, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactOrdenServicioPagosModificar :idOrdenPago, :idComprobantePago, :idOrden, :fechaCreacion, :idUsuario, :idEstadoFacturacion, :importeExonerado, :idUsuarioExonera, :idUsuarioAuditoria";

		$params = [
			'idOrdenPago' => ($oTabla->idOrdenPago == 0)? Null: $oTabla->idOrdenPago, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idOrden' => $oTabla->idOrden, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idEstadoFacturacion' => ($oTabla->idEstadoFacturacion == 0)? Null: $oTabla->idEstadoFacturacion, 
			'importeExonerado' => $oTabla->importeExonerado, 
			'idUsuarioExonera' => $oTabla->idUsuarioExonera, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactOrdenServicioPagosEliminar :idOrdenPago, :idUsuarioAuditoria";

		$params = [
			'idOrdenPago' => $oTabla->idOrdenPago, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactOrdenServicioPagosSeleccionarPorId :idOrdenPago";

		$params = [
			'idOrdenPago' => $oTabla->idOrdenPago, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}