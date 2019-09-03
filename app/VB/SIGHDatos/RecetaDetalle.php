<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class RecetaDetalle extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC RecetaDetalleAgregar :idReceta, :idItem, :cantidadPedida, :precio, :total, :saldoEnRegistroReceta, :saldoEnDespachoReceta, :cantidadDespachada, :idDosisRecetada, :idEstadoDetalle, :motivoAnulacionMedico, :observaciones, :idViaAdministracion, :idDiagnostico, :idUsuarioAuditoria";

		$params = [
			'idReceta' => ($oTabla->idReceta == 0)? Null: $oTabla->idReceta, 
			'idItem' => ($oTabla->idItem == 0)? Null: $oTabla->idItem, 
			'cantidadPedida' => ($oTabla->cantidadPedida == 0)? Null: $oTabla->cantidadPedida, 
			'precio' => $oTabla->precio, 
			'total' => $oTabla->total, 
			'saldoEnRegistroReceta' => $oTabla->saldoEnRegistroReceta, 
			'saldoEnDespachoReceta' => ($oTabla->saldoEnDespachoReceta == 0)? Null: $oTabla->saldoEnDespachoReceta, 
			'cantidadDespachada' => ($oTabla->cantidadDespachada == 0)? Null: $oTabla->cantidadDespachada, 
			'idDosisRecetada' => $oTabla->idDosisRecetada, 
			'idEstadoDetalle' => ($oTabla->idEstadoDetalle == 0)? Null: $oTabla->idEstadoDetalle, 
			'motivoAnulacionMedico' => ($oTabla->motivoAnulacionMedico == "")? Null: $oTabla->motivoAnulacionMedico, 
			'observaciones' => $oTabla->observaciones, 
			'idViaAdministracion' => ($oTabla->idViaAdministracion == 0)? Null: $oTabla->idViaAdministracion, 
			'idDiagnostico' => ($oTabla->iddiagnostico == 0)? Null: $oTabla->iddiagnostico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla, $lbLaModificacionEsAnivelDeRecetaEitem)
	{
		$query = "
			EXEC RecetaDetalleModificar :idReceta, :idItem, :cantidadPedida, :precio, :total, :saldoEnRegistroReceta, :saldoEnDespachoReceta, :cantidadDespachada, :idDosisRecetada, :idEstadoDetalle, :motivoAnulacionMedico, :observaciones, :idViaAdministracion, :idUsuarioAuditoria, :whereIdRecetaItem, :idDiagnostico";

		$params = [
			'idReceta' => ($oTabla->idReceta == 0)? Null: $oTabla->idReceta, 
			'idItem' => ($oTabla->idItem == 0)? Null: $oTabla->idItem, 
			'cantidadPedida' => ($oTabla->cantidadPedida == 0)? Null: $oTabla->cantidadPedida, 
			'precio' => $oTabla->precio, 
			'total' => $oTabla->total, 
			'saldoEnRegistroReceta' => $oTabla->saldoEnRegistroReceta, 
			'saldoEnDespachoReceta' => ($oTabla->saldoEnDespachoReceta == 0)? Null: $oTabla->saldoEnDespachoReceta, 
			'cantidadDespachada' => ($oTabla->cantidadDespachada == 0)? Null: $oTabla->cantidadDespachada, 
			'idDosisRecetada' => $oTabla->idDosisRecetada, 
			'idEstadoDetalle' => ($oTabla->idEstadoDetalle == 0)? Null: $oTabla->idEstadoDetalle, 
			'motivoAnulacionMedico' => ($oTabla->motivoAnulacionMedico == "")? Null: $oTabla->motivoAnulacionMedico, 
			'observaciones' => $oTabla->observaciones, 
			'idViaAdministracion' => ($oTabla->idViaAdministracion == 0)? Null: $oTabla->idViaAdministracion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'whereIdRecetaItem' => ($lbLaModificacionEsAnivelDeRecetaEitem == True)? 1: 0, 
			'idDiagnostico' => ($oTabla->iddiagnostico == 0)? Null: $oTabla->iddiagnostico, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC RecetaDetalleEliminar :idReceta, :idUsuarioAuditoria";

		$params = [
			'idReceta' => $oTabla->idReceta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC RecetaDetalleSeleccionarPorId :idReceta";

		$params = [
			'idReceta' => $oTabla->idReceta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdRecetaIditem($oTabla)
	{
		$query = "
			EXEC RecetaDetalleSeleccionarPorIdRecetaIditem :idReceta, :idItem";

		$params = [
			'idReceta' => $oTabla->idReceta, 
			'idItem' => $oTabla->idItem, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RecetaDetalleActualizaCantDespachada($oTabla)
	{
		$query = "
			EXEC RecetaDetalleActualizaCantDespachada :idReceta, :idItem, :cantidadDespachada, :idEstadoDetalle";

		$params = [
			'idReceta' => ($oTabla->idReceta == 0)? Null: $oTabla->idReceta, 
			'idItem' => ($oTabla->idItem == 0)? Null: $oTabla->idItem, 
			'cantidadDespachada' => ($oTabla->cantidadDespachada == 0)? Null: $oTabla->cantidadDespachada, 
			'idEstadoDetalle' => ($oTabla->idEstadoDetalle == 0)? Null: $oTabla->idEstadoDetalle, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorIdReceta($lnIdReceta)
	{
		$query = "
			EXEC RecetaDetalleSeleccionarPorId :idReceta";

		$params = [
			'idReceta' => $lnIdReceta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}