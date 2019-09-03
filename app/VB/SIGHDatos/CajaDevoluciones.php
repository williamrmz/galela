<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CajaDevoluciones extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idDevolucion AS Int = :idDevolucion
			SET NOCOUNT ON 
			EXEC CajaDevolucionesAgregar @idDevolucion OUTPUT, :idComprobantePago, :montoDevuelto, :montoTotal, :fechaDevolucion, :idUsuario, :motivo, :idUsuarioAuditoria
			SELECT @idDevolucion AS idDevolucion";

		$params = [
			'idDevolucion' => 0, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'montoDevuelto' => $oTabla->montoDevuelto, 
			'montoTotal' => $oTabla->montoTotal, 
			'fechaDevolucion' => ($oTabla->fechaDevolucion == 0)? Null: $oTabla->fechaDevolucion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'motivo' => ($oTabla->idUsuario == 0)? Null: $oTabla->mMotivo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CajaDevolucionesModificar :idDevolucion, :idComprobantePago, :montoDevuelto, :montoTotal, :fechaDevolucion, :idUsuario, :idUsuarioAuditoria";

		$params = [
			'idDevolucion' => ($oTabla->idDevolucion == 0)? Null: $oTabla->idDevolucion, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'montoDevuelto' => $oTabla->montoDevuelto, 
			'montoTotal' => $oTabla->montoTotal, 
			'fechaDevolucion' => ($oTabla->fechaDevolucion == 0)? Null: $oTabla->fechaDevolucion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CajaDevolucionesEliminar :idcomprobantepago, :idUsuarioAuditoria";

		$params = [
			'idcomprobantepago' => $oTabla->idComprobantePago, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CajaDevolucionesSeleccionarPorId :idDevolucion";

		$params = [
			'idDevolucion' => $oTabla->idDevolucion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}