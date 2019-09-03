<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FacturacionPagosACuenta extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPagosACuenta AS Int = :idPagosACuenta
			SET NOCOUNT ON 
			EXEC FacturacionPagosAcuentaAgregar :idAtencion, @idPagosACuenta OUTPUT, :totalPagado, :fechaPago, :idComprobantePago, :idEmpleadoCajero, :idUsuarioAuditoria
			SELECT @idPagosACuenta AS idPagosACuenta";

		$params = [
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idPagosACuenta' => ($oTabla->idPagosACuenta == 0)? Null: $oTabla->idPagosACuenta, 
			'totalPagado' => ($oTabla->totalPagado == 0)? Null: $oTabla->totalPagado, 
			'fechaPago' => ($oTabla->fechaPago == 0)? Null: $oTabla->fechaPago, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idEmpleadoCajero' => ($oTabla->idEmpleadoCajero == 0)? Null: $oTabla->idEmpleadoCajero, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FacturacionPagosAcuentaModificar :idPagosACuenta, :idAtencion, :totalPagado, :fechaPago, :idComprobantePago, :idEmpleadoCajero, :idUsuarioAuditoria";

		$params = [
			'idPagosACuenta' => ($oTabla->idPagosACuenta == 0)? Null: $oTabla->idPagosACuenta, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'totalPagado' => ($oTabla->totalPagado == 0)? Null: $oTabla->totalPagado, 
			'fechaPago' => ($oTabla->fechaPago == 0)? Null: $oTabla->fechaPago, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idEmpleadoCajero' => ($oTabla->idEmpleadoCajero == 0)? Null: $oTabla->idEmpleadoCajero, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FacturacionPagosAcuentaEliminar :idPagosACuenta, :idUsuarioAuditoria";

		$params = [
			'idPagosACuenta' => ($oTabla->idPagosACuenta == 0)? Null: $oTabla->idPagosACuenta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FacturacionPagosAcuentaSeleccionarPorId :idPagosACuenta";

		$params = [
			'idPagosACuenta' => $oTabla->idPagosACuenta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCuentaAtencion($idCuentaAtencion)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}