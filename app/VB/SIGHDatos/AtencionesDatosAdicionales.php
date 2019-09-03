<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionesDatosAdicionales extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC AtencionesDatosAdicionalesAgregar :idAtencion, :direccionDomicilio, :nombreAcompaniante, :observacion, :proximaCita, :numeroDeHijos, :idSiaSis, :fuaCodigoPrestacion, :sisCodigo, :idTipoReferenciaDestino, :idTipoReferenciaOrigen, :idEstablecimientoDestino, :idEstablecimientoOrigen, :idEstablecimientoNoMinsaDestino, :idEstablecimientoNoMinsaOrigen, :huboInfeccionIntraHospitalaria, :tieneNecropsia, :idMedicoRespNacimiento, :recienNacido, :nroReferenciaOrigen, :nroReferenciaDestino, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
			'direccionDomicilio' => ($oTabla->direccionDomicilio == "")? Null: $oTabla->direccionDomicilio, 
			'nombreAcompaniante' => ($oTabla->nombreAcompaniante == "")? Null: $oTabla->nombreAcompaniante, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'proximaCita' => ($oTabla->proximaCita == 0)? Null: $oTabla->proximaCita, 
			'numeroDeHijos' => $oTabla->numeroDeHijos, 
			'idSiaSis' => $oTabla->idSiasis, 
			'fuaCodigoPrestacion' => ($oTabla->fuaCodigoPrestacion == "")? Null: $oTabla->fuaCodigoPrestacion, 
			'sisCodigo' => ($oTabla->sisCodigo == "")? Null: $oTabla->sisCodigo, 
			'idTipoReferenciaDestino' => ($oTabla->idTipoReferenciaDestino == 0)? Null: $oTabla->idTipoReferenciaDestino, 
			'idTipoReferenciaOrigen' => ($oTabla->idTipoReferenciaOrigen == 0)? Null: $oTabla->idTipoReferenciaOrigen, 
			'idEstablecimientoDestino' => ($oTabla->idEstablecimientoDestino == 0)? Null: $oTabla->idEstablecimientoDestino, 
			'idEstablecimientoOrigen' => ($oTabla->idEstablecimientoOrigen == 0)? Null: $oTabla->idEstablecimientoOrigen, 
			'idEstablecimientoNoMinsaDestino' => ($oTabla->idEstablecimientoNoMinsaDestino == 0)? Null: $oTabla->idEstablecimientoNoMinsaDestino, 
			'idEstablecimientoNoMinsaOrigen' => ($oTabla->idEstablecimientoNoMinsaOrigen == 0)? Null: $oTabla->idEstablecimientoNoMinsaOrigen, 
			'huboInfeccionIntraHospitalaria' => ($oTabla->huboInfeccionIntraHospitalaria == 0)? Null: $oTabla->huboInfeccionIntraHospitalaria, 
			'tieneNecropsia' => ($oTabla->tieneNecropsia == 0)? Null: $oTabla->tieneNecropsia, 
			'idMedicoRespNacimiento' => ($oTabla->idMedicoRespNacimiento == 0)? Null: $oTabla->idMedicoRespNacimiento, 
			'recienNacido' => ($oTabla->recienNacido == 0)? Null: $oTabla->recienNacido, 
			'nroReferenciaOrigen' => ($oTabla->nroReferenciaOrigen == "")? Null: $oTabla->nroReferenciaOrigen, 
			'nroReferenciaDestino' => ($oTabla->nroReferenciaDestino == "")? Null: $oTabla->nroReferenciaDestino, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionesDatosAdicionalesModificar :idAtencion, :direccionDomicilio, :nombreAcompaniante, :observacion, :proximaCita, :numeroDeHijos, :idSiaSis, :fuaCodigoPrestacion, :sisCodigo, :idTipoReferenciaDestino, :idTipoReferenciaOrigen, :idEstablecimientoDestino, :idEstablecimientoOrigen, :idEstablecimientoNoMinsaDestino, :idEstablecimientoNoMinsaOrigen, :huboInfeccionIntraHospitalaria, :tieneNecropsia, :idMedicoRespNacimiento, :recienNacido, :nroReferenciaOrigen, :nroReferenciaDestino, :idServicioDestino, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
			'direccionDomicilio' => ($oTabla->direccionDomicilio == "")? Null: $oTabla->direccionDomicilio, 
			'nombreAcompaniante' => ($oTabla->nombreAcompaniante == "")? Null: $oTabla->nombreAcompaniante, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'proximaCita' => ($oTabla->proximaCita == 0)? Null: $oTabla->proximaCita, 
			'numeroDeHijos' => $oTabla->numeroDeHijos, 
			'idSiaSis' => $oTabla->idSiasis, 
			'fuaCodigoPrestacion' => ($oTabla->fuaCodigoPrestacion == "")? Null: $oTabla->fuaCodigoPrestacion, 
			'sisCodigo' => ($oTabla->sisCodigo == "")? Null: $oTabla->sisCodigo, 
			'idTipoReferenciaDestino' => ($oTabla->idTipoReferenciaDestino == 0)? Null: $oTabla->idTipoReferenciaDestino, 
			'idTipoReferenciaOrigen' => ($oTabla->idTipoReferenciaOrigen == 0)? Null: $oTabla->idTipoReferenciaOrigen, 
			'idEstablecimientoDestino' => ($oTabla->idEstablecimientoDestino == 0)? Null: $oTabla->idEstablecimientoDestino, 
			'idEstablecimientoOrigen' => ($oTabla->idEstablecimientoOrigen == 0)? Null: $oTabla->idEstablecimientoOrigen, 
			'idEstablecimientoNoMinsaDestino' => ($oTabla->idEstablecimientoNoMinsaDestino == 0)? Null: $oTabla->idEstablecimientoNoMinsaDestino, 
			'idEstablecimientoNoMinsaOrigen' => ($oTabla->idEstablecimientoNoMinsaOrigen == 0)? Null: $oTabla->idEstablecimientoNoMinsaOrigen, 
			'huboInfeccionIntraHospitalaria' => ($oTabla->huboInfeccionIntraHospitalaria == 0)? Null: $oTabla->huboInfeccionIntraHospitalaria, 
			'tieneNecropsia' => ($oTabla->tieneNecropsia == 0)? Null: $oTabla->tieneNecropsia, 
			'idMedicoRespNacimiento' => ($oTabla->idMedicoRespNacimiento == 0)? Null: $oTabla->idMedicoRespNacimiento, 
			'recienNacido' => ($oTabla->recienNacido == 0)? Null: $oTabla->recienNacido, 
			'nroReferenciaOrigen' => ($oTabla->nroReferenciaOrigen == "")? Null: $oTabla->nroReferenciaOrigen, 
			'nroReferenciaDestino' => ($oTabla->nroReferenciaDestino == "")? Null: $oTabla->nroReferenciaDestino, 
			'idServicioDestino' => (Mid($oTabla->idServicioDestino)? 1: 6) == "", 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function ModificarAcompañante($oTabla)
	{
		$query = "
			EXEC AgregarDatosAcompañante :idAtencion, :nroDocumento, :domicilio";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
			'nroDocumento' => ($oTabla->nroDocumentoAcompañante == "")? Null: $oTabla->nroDocumentoAcompañante, 
			'domicilio' => ($oTabla->domicilioAcompañante == "")? Null: $oTabla->domicilioAcompañante, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionesDatosAdicionalesEliminar :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function AgregarDatosAdicionalesNroexp($oTabla)
	{
		$query = "
			EXEC ActualizarNroExpedienteDatosAdicionales :idAtencion, :nroExpediente";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
			'nroExpediente' => $oTabla->nroExpediente, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionesDatosAdicionalesSeleccionarPorId :idAtencion";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdNroExp($oTabla)
	{
		$query = "
			EXEC SelecionarNroExpediente :idAtencion";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ModificarImprimioFicha($oTabla)
	{
		$query = "
			EXEC AtencionesDatosAdicionalesModificarImprimioFicha :idAtencion, :seImprimioFicha";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
			'seImprimioFicha' => $oTabla->seImprimioFicha, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarTodosPorIdAtencionNroExp($lnIdAtencion)
	{
		$query = "
			EXEC SelecionarNroExpediente :lnIdAtencion";

		$params = [
			'lnIdAtencion' => $lnIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}