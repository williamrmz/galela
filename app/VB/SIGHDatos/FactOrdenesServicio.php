<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FactOrdenesServicio extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idOrden AS Int = :idOrden
			SET NOCOUNT ON 
			EXEC FactOrdenesServicioAgregar :fechaModificacion, :fechaCreacion, :idUsuarioModifica, :idUsuarioCrea, :idAtencion, :fechaOrden, :idPuntoCarga, @idOrden OUTPUT, :idEstadoOrden, :idComprobantePago, :idUsuarioAuditoria, :idFormaPago
			SELECT @idOrden AS idOrden";

		$params = [
			'fechaModificacion' => ($oTabla->fechaModificacion == 0)? Null: $oTabla->fechaModificacion, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuarioModifica' => ($oTabla->idUsuarioModifica == 0)? Null: $oTabla->idUsuarioModifica, 
			'idUsuarioCrea' => ($oTabla->idUsuarioCrea == 0)? Null: $oTabla->idUsuarioCrea, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'fechaOrden' => ($oTabla->fechaOrden == 0)? Null: $oTabla->fechaOrden, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idOrden' => 0, 
			'idEstadoOrden' => ($oTabla->idEstadoOrden == 0)? Null: $oTabla->idEstadoOrden, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idFormaPago' => ($oTabla->idFormaPago == 0)? Null: $oTabla->idFormaPago, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactOrdenesServicioModificar :fechaModificacion, :fechaCreacion, :idUsuarioModifica, :idUsuarioCrea, :idAtencion, :fechaOrden, :idPuntoCarga, :idOrden, :idEstadoOrden, :idComprobantePago, :idUsuarioAuditoria, :idFormaPago";

		$params = [
			'fechaModificacion' => ($oTabla->fechaModificacion == 0)? Null: $oTabla->fechaModificacion, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuarioModifica' => ($oTabla->idUsuarioModifica == 0)? Null: $oTabla->idUsuarioModifica, 
			'idUsuarioCrea' => ($oTabla->idUsuarioCrea == 0)? Null: $oTabla->idUsuarioCrea, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'fechaOrden' => ($oTabla->fechaOrden == 0)? Null: $oTabla->fechaOrden, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idEstadoOrden' => ($oTabla->idEstadoOrden == 0)? Null: $oTabla->idEstadoOrden, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idFormaPago' => ($oTabla->idFormaPago == 0)? Null: $oTabla->idFormaPago, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactOrdenesServicioEliminar :idOrden, :idUsuarioAuditoria";

		$params = [
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactOrdenesServicioSeleccionarPorId :idOrden";

		$params = [
			'idOrden' => $oTabla->idOrden, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdComprobante($lIdComprobantePago)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oDoFactordenServicio, $oDOPaciente)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarDEBB($oDoFactordenServicio, $oDOPaciente, $lcFecha)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorIdAtencion($lIdAtencion)
	{
		$query = "
			EXEC FactOrdenesServicioEliminarV2 :idAtencion";

		$params = [
			'idAtencion' => ($lIdAtencion == 0)? Null: $lIdAtencion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function EliminarPorIdOrden($lIdOrden)
	{
		$query = "
			EXEC FactOrdenesServicioEliminarV3 :idOrden";

		$params = [
			'idOrden' => ($lIdOrden == 0)? Null: $lIdOrden, 
		];

		$data = \DB::update($query, $params);

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

	public function ActualizarPagoDeOrdenesProcesadas($sOrdenesProcesadas, $idComprobantePago, $lIdUsuario)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdComprobanteDevolucion($lIdComprobantePago)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}