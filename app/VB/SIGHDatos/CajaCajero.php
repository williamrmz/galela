<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CajaCajero extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idCajero AS Int = :idCajero
			SET NOCOUNT ON 
			EXEC CajaCajeroAgregar :idEmpleado, :estadoCajero, :idCaja, @idCajero OUTPUT, :idUsuarioAuditoria
			SELECT @idCajero AS idCajero";

		$params = [
			'idEmpleado' => ($oTabla->idEmpleado == 0)? Null: $oTabla->idEmpleado, 
			'estadoCajero' => ($oTabla->estadoCajero == 0)? Null: $oTabla->estadoCajero, 
			'idCaja' => ($oTabla->idCaja == 0)? Null: $oTabla->idCaja, 
			'idCajero' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CajaCajeroModificar :idEmpleado, :estadoCajero, :idCaja, :idCajero, :idUsuarioAuditoria";

		$params = [
			'idEmpleado' => ($oTabla->idEmpleado == 0)? Null: $oTabla->idEmpleado, 
			'estadoCajero' => ($oTabla->estadoCajero == 0)? Null: $oTabla->estadoCajero, 
			'idCaja' => ($oTabla->idCaja == 0)? Null: $oTabla->idCaja, 
			'idCajero' => ($oTabla->idCajero == 0)? Null: $oTabla->idCajero, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CajaCajeroEliminar :idCajero, :idUsuarioAuditoria";

		$params = [
			'idCajero' => ($oTabla->idCajero == 0)? Null: $oTabla->idCajero, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CajaCajeroSeleccionarPorId :idCajero";

		$params = [
			'idCajero' => $oTabla->idCajero, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC CajerosSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodosParaLista()
	{
		$query = "
			EXEC CajaCajeroSeleccionarTodosParaLista ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarSegunUsuario($idEmpleado)
	{
		$query = "
			EXEC cajacajeroSeleccionarXidEmpleado :idEmpleado";

		$params = [
			'idEmpleado' => IdEmpleado, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RealizarFiltro($oEmpleado)
	{
		$query = "
			EXEC EstablecimientosNoMinsaFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => SQL, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarSegunUsuarioYCaja($doCajero)
	{
		$query = "
			EXEC cajacajeroSeleccionarSegunUsuarioYCaja :idCaja, :idEmpleado";

		$params = [
			'idCaja' => $doCajero->idCaja, 
			'idEmpleado' => $doCajero->idEmpleado, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}