<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FactOrdenesBienesInsumo extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idOrden AS Int = :idOrden
			SET NOCOUNT ON 
			EXEC FactOrdenesBienesInsumoAgregar :fechaModificacion, :fechaCreacion, :idUsuarioModifica, :idUsuarioCrea, :idAtencion, :fechaOrden, @idOrden OUTPUT, :idEstadoOrden, :idComprobantePago, :idPuntoCarga, :idUsuarioAuditoria, :idPaciente, :idFormaPago, :idFarmacia
			SELECT @idOrden AS idOrden";

		$params = [
			'fechaModificacion' => ($oTabla->fechaModificacion == 0)? Null: $oTabla->fechaModificacion, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuarioModifica' => ($oTabla->idUsuarioModifica == 0)? Null: $oTabla->idUsuarioModifica, 
			'idUsuarioCrea' => ($oTabla->idUsuarioCrea == 0)? Null: $oTabla->idUsuarioCrea, 
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
			'fechaOrden' => ($oTabla->fechaOrden == 0)? Null: $oTabla->fechaOrden, 
			'idOrden' => 0, 
			'idEstadoOrden' => ($oTabla->idEstadoOrden == 0)? Null: $oTabla->idEstadoOrden, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idFormaPago' => ($oTabla->idFormaPago == 0)? Null: $oTabla->idFormaPago, 
			'idFarmacia' => ($oTabla->idFarmacia == 0)? Null: $oTabla->idFarmacia, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactOrdenesBienesInsumoModificar :fechaModificacion, :fechaCreacion, :idUsuarioModifica, :idUsuarioCrea, :idAtencion, :fechaOrden, :idOrden, :idEstadoOrden, :idComprobantePago, :idPuntoCarga, :idUsuarioAuditoria, :idPaciente, :idFormaPago, :idFarmacia";

		$params = [
			'fechaModificacion' => ($oTabla->fechaModificacion == 0)? Null: $oTabla->fechaModificacion, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuarioModifica' => ($oTabla->idUsuarioModifica == 0)? Null: $oTabla->idUsuarioModifica, 
			'idUsuarioCrea' => ($oTabla->idUsuarioCrea == 0)? Null: $oTabla->idUsuarioCrea, 
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
			'fechaOrden' => ($oTabla->fechaOrden == 0)? Null: $oTabla->fechaOrden, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idEstadoOrden' => ($oTabla->idEstadoOrden == 0)? Null: $oTabla->idEstadoOrden, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idFormaPago' => ($oTabla->idFormaPago == 0)? Null: $oTabla->idFormaPago, 
			'idFarmacia' => ($oTabla->idFarmacia == 0)? Null: $oTabla->idFarmacia, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactOrdenesBienesInsumoEliminar :idOrden, :idUsuarioAuditoria";

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
			EXEC FactOrdenesBienesInsumoSeleccionarPorId :idOrden";

		$params = [
			'idOrden' => $oTabla->idOrden, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oDOFactOrdenBienInsumo, $oDOPaciente)
	{
		$query = "
			EXEC EstablecimientosNoMinsaFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarDEBB($oDOFactOrdenBienInsumo, $oDOPaciente, $ldFechaInicial, $ldFechaFinal, $lnFarmacia)
	{
		$query = "
			EXEC FactOrdenesBienesInsumoFiltrado :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorIdAtencion($lIdAtencion)
	{
		$query = "
			EXEC FactOrdenesBienesInsumoEliminarV2 :idAtencion";

		$params = [
			'idAtencion' => ($lIdAtencion == 0)? Null: $lIdAtencion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function EliminarPorIdOrden($lIdOrden)
	{
		$query = "
			EXEC FactOrdenesBienesInsumoEliminarV3 :idOrden";

		$params = [
			'idOrden' => ($lIdOrden == 0)? Null: $lIdOrden, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorCuentaAtencion($idCuentaAtencion)
	{
		$query = "
			EXEC FactOrdenesBienesInsumoXidCuentaAtencion :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => IdCuentaAtencion, 
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

	public function SeleccionarPorIdComprobante($lIdComprobantePago)
	{
		$query = "
			EXEC FactOrdenesBienesInsumoXidComprobantePago :lIdComprobantePago";

		$params = [
			'lIdComprobantePago' => $lIdComprobantePago, 
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