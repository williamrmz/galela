<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class NotaCreditoDebito extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idNota AS Int = :idNota
			SET NOCOUNT ON 
			EXEC NotaCreditoDebitoAgregar @idNota OUTPUT, :idComprobantePago, :idTipoNota, :nroSerie, :nroDocumento, :razonSocial, :rUC, :subTotal, :iGV, :total, :idUsuarioAutoriza, :fechaAprueba, :tipoCambio, :observaciones, :idEstadoNota, :fechaPagado, :idGestionCaja, :idPaciente, :idCajero, :idTurno, :idCaja, :idFarmacia, :idMotivo, :direccion, :tipoAnulacion, :idUsuarioAuditoria
			SELECT @idNota AS idNota";

		$params = [
			'idNota' => 0, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idTipoNota' => ($oTabla->idTipoNota == 0)? Null: $oTabla->idTipoNota, 
			'nroSerie' => ($oTabla->nroSerie == "")? Null: $oTabla->nroSerie, 
			'nroDocumento' => ($oTabla->nroDocumento == "")? Null: $oTabla->nroDocumento, 
			'razonSocial' => ($oTabla->razonSocial == "")? Null: $oTabla->razonSocial, 
			'rUC' => ($oTabla->rUC == "")? Null: $oTabla->rUC, 
			'subTotal' => $oTabla->subTotal, 
			'iGV' => $oTabla->iGV, 
			'total' => $oTabla->total, 
			'idUsuarioAutoriza' => ($oTabla->idUsuarioAutoriza == 0)? Null: $oTabla->idUsuarioAutoriza, 
			'fechaAprueba' => ($oTabla->fechaAprueba == 0)? Null: $oTabla->fechaAprueba, 
			'tipoCambio' => $oTabla->tipoCambio, 
			'observaciones' => ($oTabla->observaciones == "")? Null: $oTabla->observaciones, 
			'idEstadoNota' => ($oTabla->idEstadoNota == 0)? Null: $oTabla->idEstadoNota, 
			'fechaPagado' => ($oTabla->fechaPagado == 0)? Null: $oTabla->fechaPagado, 
			'idGestionCaja' => ($oTabla->idGestionCaja == 0)? Null: $oTabla->idGestionCaja, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCajero' => ($oTabla->idCajero == 0)? Null: $oTabla->idCajero, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'idCaja' => ($oTabla->idCaja == 0)? Null: $oTabla->idCaja, 
			'idFarmacia' => ($oTabla->idFarmacia == 0)? Null: $oTabla->idFarmacia, 
			'idMotivo' => ($oTabla->idMotivo == 0)? Null: $oTabla->idMotivo, 
			'direccion' => ($oTabla->direccion == "")? Null: $oTabla->direccion, 
			'tipoAnulacion' => ($oTabla->tipoAnulacion == 0)? Null: $oTabla->tipoAnulacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC NotaCreditoDebitoModificar :idNota, :idComprobantePago, :idTipoNota, :nroSerie, :nroDocumento, :razonSocial, :rUC, :subTotal, :iGV, :total, :idUsuarioAutoriza, :fechaAprueba, :tipoCambio, :observaciones, :idEstadoNota, :fechaPagado, :idGestionCaja, :idPaciente, :idCajero, :idTurno, :idCaja, :idFarmacia, :idMotivo, :direccion, :tipoAnulacion, :idUsuarioAuditoria";

		$params = [
			'idNota' => ($oTabla->idNota == 0)? Null: $oTabla->idNota, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idTipoNota' => ($oTabla->idTipoNota == 0)? Null: $oTabla->idTipoNota, 
			'nroSerie' => ($oTabla->nroSerie == "")? Null: $oTabla->nroSerie, 
			'nroDocumento' => ($oTabla->nroDocumento == "")? Null: $oTabla->nroDocumento, 
			'razonSocial' => ($oTabla->razonSocial == "")? Null: $oTabla->razonSocial, 
			'rUC' => ($oTabla->rUC == "")? Null: $oTabla->rUC, 
			'subTotal' => $oTabla->subTotal, 
			'iGV' => $oTabla->iGV, 
			'total' => $oTabla->total, 
			'idUsuarioAutoriza' => ($oTabla->idUsuarioAutoriza == 0)? Null: $oTabla->idUsuarioAutoriza, 
			'fechaAprueba' => ($oTabla->fechaAprueba == 0)? Null: $oTabla->fechaAprueba, 
			'tipoCambio' => $oTabla->tipoCambio, 
			'observaciones' => ($oTabla->observaciones == "")? Null: $oTabla->observaciones, 
			'idEstadoNota' => ($oTabla->idEstadoNota == 0)? Null: $oTabla->idEstadoNota, 
			'fechaPagado' => ($oTabla->fechaPagado == 0)? Null: $oTabla->fechaPagado, 
			'idGestionCaja' => ($oTabla->idGestionCaja == 0)? Null: $oTabla->idGestionCaja, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCajero' => ($oTabla->idCajero == 0)? Null: $oTabla->idCajero, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'idCaja' => ($oTabla->idCaja == 0)? Null: $oTabla->idCaja, 
			'idFarmacia' => ($oTabla->idFarmacia == 0)? Null: $oTabla->idFarmacia, 
			'idMotivo' => ($oTabla->idMotivo == 0)? Null: $oTabla->idMotivo, 
			'direccion' => ($oTabla->direccion == "")? Null: $oTabla->direccion, 
			'tipoAnulacion' => ($oTabla->tipoAnulacion == 0)? Null: $oTabla->tipoAnulacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC NotaCreditoDebitoEliminar :idNota, :idUsuarioAuditoria";

		$params = [
			'idNota' => $oTabla->idNota, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC NotaCreditoDebitoSeleccionarPorId :idNota";

		$params = [
			'idNota' => $oTabla->idNota, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}