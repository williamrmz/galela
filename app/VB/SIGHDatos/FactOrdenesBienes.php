<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FactOrdenesBienes extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idOrden AS Int = :idOrden
			SET NOCOUNT ON 
			EXEC FactOrdenesBienesAgregar @idOrden OUTPUT, :idPuntoCarga, :idPaciente, :idCuentaAtencion, :idComprobantePago, :movNumero, :movTipo, :idPreventa, :fechaCreacion, :idUsuario, :idEstadoFacturacion, :importeExonerado, :idUsuarioExonera, :idUsuarioAuditoria, :descripcion, :paquete, :dni
			SELECT @idOrden AS idOrden";

		$params = [
			'idOrden' => 0, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idPreventa' => ($oTabla->idPreventa == 0)? Null: $oTabla->idPreventa, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idEstadoFacturacion' => $oTabla->idEstadoFacturacion, 
			'importeExonerado' => $oTabla->importeExonerado, 
			'idUsuarioExonera' => $oTabla->idUsuarioExonera, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'paquete' => ($oTabla->paquete == "")? Null: $oTabla->paquete, 
			'dni' => ($oTabla->dNI == "")? Null: $oTabla->dNI, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactOrdenesBienesModificar :idOrden, :idPuntoCarga, :idPaciente, :idCuentaAtencion, :idComprobantePago, :movNumero, :movTipo, :idPreventa, :fechaCreacion, :idUsuario, :idEstadoFacturacion, :importeExonerado, :idUsuarioExonera, :idUsuarioAuditoria, :descripcion, :paquete, :dni";

		$params = [
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idPreventa' => ($oTabla->idPreventa == 0)? Null: $oTabla->idPreventa, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idEstadoFacturacion' => $oTabla->idEstadoFacturacion, 
			'importeExonerado' => $oTabla->importeExonerado, 
			'idUsuarioExonera' => $oTabla->idUsuarioExonera, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'paquete' => ($oTabla->paquete == "")? Null: $oTabla->paquete, 
			'dni' => ($oTabla->dNI == "")? Null: $oTabla->dNI, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactOrdenesBienesEliminar :idOrden, :idUsuarioAuditoria";

		$params = [
			'idOrden' => $oTabla->idOrden, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactOrdenesBienesSeleccionarPorId :idOrden";

		$params = [
			'idOrden' => $oTabla->idOrden, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdPreventa($oTabla)
	{
		$query = "
			EXEC FactOrdenesBienesSeleccionarPorIdPreVenta :idPreVenta";

		$params = [
			'idPreVenta' => $oTabla->idPreventa, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorMovNumero($oTabla)
	{
		$query = "
			EXEC FactOrdenesBienesSeleccionarPorMovNumero :movNumero, :movTipo";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}