<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class SisFuaAtencion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC SisFuaAtencionAgregar :idCuentaAtencion, :fuaDisa, :fuaLote, :fuaNumero, :establecimientoCodigoRenaes, :reconsideracion, :reconsideracionCodigoDisa, :reconsideracionLote, :reconsideracionNroFormato, :fuaComponente, :situacion, :afiliacionDisa, :afiliacionTipoFormato, :afiliacionNroFormato, :codigoTipoFormato, :origenAseguradoInstitucion, :origenAseguradoCodigo, :edad, :grupoEtareo, :genero, :fuaAtencion, :fuaCondicionMaterna, :fuaNrohistoria, :fuaConceptoPr, :fuaConceptoPrAutoriz, :fuaConceptoPrMonto, :fuaAtencionFecha, :fuaAtencionHora, :fuaReferidoOrigenCodigoRENAES, :fuaReferidoOrigenNreferencia, :fuaCodigoPrestacion, :fuaPersonalQatiende, :fuaAtencionLugar, :fuaDestino, :fuaHospitalizadoFingreso, :fuaHospitalizadoFalta, :fuaReferidoDestinoCodigoRENAES, :fuaReferidoDestinoNreferencia, :fuaMedicoDNI, :fuaMedico, :fuaMedicoTipo, :afiliacionNroIntegrante, :codigo, :idSiasis, :fuaObservaciones, :cabDniUsuarioRegistra, :ultimaFechaAddMod, :cabEstado, :fuaFechaParto, :establecimientoDistrito, :anio, :mes, :costoTotal, :apaterno, :amaterno, :pnombre, :onombre, :fnacimiento, :autogenerado, :documentoTipo, :documentoNumero, :establecimientoCategoria, :costoServicio, :costoMedicamento, :costoProcedimiento, :costoInsumo, :medicoDocumentoTipo, :ate_grupoRiesgo, :cabCodigoPuntoDigitacion, :cabCodigoUDR, :cabNroEnvioAlSIS, :cabOrigenDelRegistro, :cabVersionAplicativo, :cabIdentificacionPaquete, :identificacionArfsis, :cabFechaFuaPrimeraVez, :periodoOrigen, :idUsuarioAuditoria";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'fuaDisa' => ($oTabla->fuaDisa == "")? Null: $oTabla->fuaDisa, 
			'fuaLote' => ($oTabla->fuaLote == "")? Null: $oTabla->fuaLote, 
			'fuaNumero' => ($oTabla->fuaNumero == "")? Null: $oTabla->fuaNumero, 
			'establecimientoCodigoRenaes' => ($oTabla->establecimientoCodigoRenaes == "")? Null: $oTabla->establecimientoCodigoRenaes, 
			'reconsideracion' => ($oTabla->reconsideracion == "")? Null: $oTabla->reconsideracion, 
			'reconsideracionCodigoDisa' => ($oTabla->reconsideracionCodigoDisa == "")? Null: $oTabla->reconsideracionCodigoDisa, 
			'reconsideracionLote' => ($oTabla->reconsideracionLote == "")? Null: $oTabla->reconsideracionLote, 
			'reconsideracionNroFormato' => ($oTabla->reconsideracionNroFormato == "")? Null: $oTabla->reconsideracionNroFormato, 
			'fuaComponente' => ($oTabla->fuaComponente == "")? Null: $oTabla->fuaComponente, 
			'situacion' => ($oTabla->situacion == "")? Null: $oTabla->situacion, 
			'afiliacionDisa' => ($oTabla->afiliacionDisa == "")? Null: $oTabla->afiliacionDisa, 
			'afiliacionTipoFormato' => ($oTabla->afiliacionTipoFormato == "")? Null: $oTabla->afiliacionTipoFormato, 
			'afiliacionNroFormato' => ($oTabla->afiliacionNroFormato == "")? Null: $oTabla->afiliacionNroFormato, 
			'codigoTipoFormato' => ($oTabla->codigoTipoFormato == "")? Null: $oTabla->codigoTipoFormato, 
			'origenAseguradoInstitucion' => ($oTabla->origenAseguradoInstitucion == "")? Null: $oTabla->origenAseguradoInstitucion, 
			'origenAseguradoCodigo' => ($oTabla->origenAseguradoCodigo == "")? Null: $oTabla->origenAseguradoCodigo, 
			'edad' => ($oTabla->edad == 0)? Null: $oTabla->edad, 
			'grupoEtareo' => ($oTabla->grupoEtareo == "")? Null: $oTabla->grupoEtareo, 
			'genero' => ($oTabla->genero == "")? Null: $oTabla->genero, 
			'fuaAtencion' => ($oTabla->fuaAtencion == 0)? Null: $oTabla->fuaAtencion, 
			'fuaCondicionMaterna' => ($oTabla->fuaCondicionMaterna == "")? Null: $oTabla->fuaCondicionMaterna, 
			'fuaNrohistoria' => ($oTabla->fuaNrohistoria == "")? Null: $oTabla->fuaNrohistoria, 
			'fuaConceptoPr' => ($oTabla->fuaConceptoPr == 0)? Null: $oTabla->fuaConceptoPr, 
			'fuaConceptoPrAutoriz' => ($oTabla->fuaConceptoPrAutoriz == "")? Null: $oTabla->fuaConceptoPrAutoriz, 
			'fuaConceptoPrMonto' => $oTabla->fuaConceptoPrMonto, 
			'fuaAtencionFecha' => ($oTabla->fuaAtencionFecha == "")? Null: $oTabla->fuaAtencionFecha, 
			'fuaAtencionHora' => ($oTabla->fuaAtencionHora == "")? Null: $oTabla->fuaAtencionHora, 
			'fuaReferidoOrigenCodigoRENAES' => ($oTabla->fuaReferidoOrigenCodigoRENAES == "")? Null: $oTabla->fuaReferidoOrigenCodigoRENAES, 
			'fuaReferidoOrigenNreferencia' => ($oTabla->fuaReferidoOrigenNreferencia == "")? Null: $oTabla->fuaReferidoOrigenNreferencia, 
			'fuaCodigoPrestacion' => ($oTabla->fuaCodigoPrestacion == "")? Null: $oTabla->fuaCodigoPrestacion, 
			'fuaPersonalQatiende' => ($oTabla->fuaPersonalQatiende == 0)? Null: $oTabla->fuaPersonalQatiende, 
			'fuaAtencionLugar' => ($oTabla->fuaAtencionLugar == "")? Null: $oTabla->fuaAtencionLugar, 
			'fuaDestino' => ($oTabla->fuaDestino == "")? Null: $oTabla->fuaDestino, 
			'fuaHospitalizadoFingreso' => ($oTabla->fuaHospitalizadoFingreso == "")? Null: $oTabla->fuaHospitalizadoFingreso, 
			'fuaHospitalizadoFalta' => ($oTabla->fuaHospitalizadoFalta == "")? Null: $oTabla->fuaHospitalizadoFalta, 
			'fuaReferidoDestinoCodigoRENAES' => ($oTabla->fuaReferidoDestinoCodigoRENAES == "")? Null: $oTabla->fuaReferidoDestinoCodigoRENAES, 
			'fuaReferidoDestinoNreferencia' => ($oTabla->fuaReferidoDestinoNreferencia == "")? Null: $oTabla->fuaReferidoDestinoNreferencia, 
			'fuaMedicoDNI' => ($oTabla->fuaMedicoDNI == "")? Null: Left($oTabla->fuaMedicoDNI, 
			'fuaMedico' => ($oTabla->fuaMedico == "")? Null: $oTabla->fuaMedico, 
			'fuaMedicoTipo' => ($oTabla->fuaMedicoTipo == "")? Null: $oTabla->fuaMedicoTipo, 
			'afiliacionNroIntegrante' => ($oTabla->afiliacionNroIntegrante == "")? Null: $oTabla->afiliacionNroIntegrante, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idSiasis' => ($oTabla->idSiasis == "")? Null: $oTabla->idSiasis, 
			'fuaObservaciones' => ($oTabla->fuaObservaciones == "")? Null: $oTabla->fuaObservaciones, 
			'cabDniUsuarioRegistra' => ($oTabla->cabDniUsuarioRegistra == "")? Null: Left($oTabla->cabDniUsuarioRegistra, 
			'ultimaFechaAddMod' => ($oTabla->ultimaFechaAddMod == "")? Null: $oTabla->ultimaFechaAddMod, 
			'cabEstado' => ($oTabla->cabEstado == "")? Null: $oTabla->cabEstado, 
			'fuaFechaParto' => ($oTabla->fuaFechaParto == "")? Null: $oTabla->fuaFechaParto, 
			'establecimientoDistrito' => ($oTabla->establecimientoDistrito == "")? Null: $oTabla->establecimientoDistrito, 
			'anio' => ($oTabla->anio == "")? Null: $oTabla->anio, 
			'mes' => ($oTabla->mes == "")? Null: $oTabla->mes, 
			'costoTotal' => $oTabla->costoTotal, 
			'apaterno' => ($oTabla->apaterno == "")? Null: $oTabla->apaterno, 
			'amaterno' => ($oTabla->amaterno == "")? Null: $oTabla->amaterno, 
			'pnombre' => ($oTabla->pnombre == "")? Null: $oTabla->pnombre, 
			'onombre' => ($oTabla->onombre == "")? Null: $oTabla->onombre, 
			'fnacimiento' => ($oTabla->fnacimiento == "")? Null: $oTabla->fnacimiento, 
			'autogenerado' => ($oTabla->autogenerado == "")? Null: $oTabla->autogenerado, 
			'documentoTipo' => ($oTabla->documentoTipo == "")? Null: $oTabla->documentoTipo, 
			'documentoNumero' => ($oTabla->documentoNumero == "")? Null: $oTabla->documentoNumero, 
			'establecimientoCategoria' => ($oTabla->establecimientoCategoria == "")? Null: $oTabla->establecimientoCategoria, 
			'costoServicio' => $oTabla->costoServicio, 
			'costoMedicamento' => $oTabla->costoMedicamento, 
			'costoProcedimiento' => $oTabla->costoProcedimiento, 
			'costoInsumo' => $oTabla->costoInsumo, 
			'medicoDocumentoTipo' => ($oTabla->medicoDocumentoTipo == "")? Null: $oTabla->medicoDocumentoTipo, 
			'ate_grupoRiesgo' => ($oTabla->ate_grupoRiesgo == "")? Null: $oTabla->ate_grupoRiesgo, 
			'cabCodigoPuntoDigitacion' => ($oTabla->cabCodigoPuntoDigitacion == 0)? Null: $oTabla->cabCodigoPuntoDigitacion, 
			'cabCodigoUDR' => ($oTabla->cabCodigoUDR == "")? Null: $oTabla->cabCodigoUDR, 
			'cabNroEnvioAlSIS' => ($oTabla->cabNroEnvioAlSIS == "")? Null: $oTabla->cabNroEnvioAlSIS, 
			'cabOrigenDelRegistro' => ($oTabla->cabOrigenDelRegistro == "")? Null: $oTabla->cabOrigenDelRegistro, 
			'cabVersionAplicativo' => ($oTabla->cabVersionAplicativo == "")? Null: $oTabla->cabVersionAplicativo, 
			'cabIdentificacionPaquete' => $oTabla->cabIdentificacionPaquete, 
			'identificacionArfsis' => ($oTabla->identificacionArfsis == 0)? Null: $oTabla->identificacionArfsis, 
			'cabFechaFuaPrimeraVez' => ($oTabla->cabFechaFuaPrimeraVez == "")? Null: $oTabla->cabFechaFuaPrimeraVez, 
			'periodoOrigen' => ($oTabla->periodoOrigen == "")? Null: $oTabla->periodoOrigen, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC SisFuaAtencionModificar :idCuentaAtencion, :fuaDisa, :fuaLote, :fuaNumero, :establecimientoCodigoRenaes, :reconsideracion, :reconsideracionCodigoDisa, :reconsideracionLote, :reconsideracionNroFormato, :fuaComponente, :situacion, :afiliacionDisa, :afiliacionTipoFormato, :afiliacionNroFormato, :codigoTipoFormato, :origenAseguradoInstitucion, :origenAseguradoCodigo, :edad, :grupoEtareo, :genero, :fuaAtencion, :fuaCondicionMaterna, :fuaNrohistoria, :fuaConceptoPr, :fuaConceptoPrAutoriz, :fuaConceptoPrMonto, :fuaAtencionFecha, :fuaAtencionHora, :fuaReferidoOrigenCodigoRENAES, :fuaReferidoOrigenNreferencia, :fuaCodigoPrestacion, :fuaPersonalQatiende, :fuaAtencionLugar, :fuaDestino, :fuaHospitalizadoFingreso, :fuaHospitalizadoFalta, :fuaReferidoDestinoCodigoRENAES, :fuaReferidoDestinoNreferencia, :fuaMedicoDNI, :fuaMedico, :fuaMedicoTipo, :afiliacionNroIntegrante, :codigo, :idSiasis, :fuaObservaciones, :cabDniUsuarioRegistra, :ultimaFechaAddMod, :cabEstado, :fuaFechaParto, :establecimientoDistrito, :anio, :mes, :costoTotal, :apaterno, :amaterno, :pnombre, :onombre, :fnacimiento, :autogenerado, :documentoTipo, :documentoNumero, :establecimientoCategoria, :costoServicio, :costoMedicamento, :costoProcedimiento, :costoInsumo, :medicoDocumentoTipo, :ate_grupoRiesgo, :cabCodigoPuntoDigitacion, :cabCodigoUDR, :cabNroEnvioAlSIS, :cabOrigenDelRegistro, :cabVersionAplicativo, :cabIdentificacionPaquete, :identificacionArfsis, :cabFechaFuaPrimeraVez, :periodoOrigen, :idUsuarioAuditoria";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'fuaDisa' => ($oTabla->fuaDisa == "")? Null: $oTabla->fuaDisa, 
			'fuaLote' => ($oTabla->fuaLote == "")? Null: $oTabla->fuaLote, 
			'fuaNumero' => ($oTabla->fuaNumero == "")? Null: $oTabla->fuaNumero, 
			'establecimientoCodigoRenaes' => ($oTabla->establecimientoCodigoRenaes == "")? Null: $oTabla->establecimientoCodigoRenaes, 
			'reconsideracion' => ($oTabla->reconsideracion == "")? Null: $oTabla->reconsideracion, 
			'reconsideracionCodigoDisa' => ($oTabla->reconsideracionCodigoDisa == "")? Null: $oTabla->reconsideracionCodigoDisa, 
			'reconsideracionLote' => ($oTabla->reconsideracionLote == "")? Null: $oTabla->reconsideracionLote, 
			'reconsideracionNroFormato' => ($oTabla->reconsideracionNroFormato == "")? Null: $oTabla->reconsideracionNroFormato, 
			'fuaComponente' => ($oTabla->fuaComponente == "")? Null: $oTabla->fuaComponente, 
			'situacion' => ($oTabla->situacion == "")? Null: $oTabla->situacion, 
			'afiliacionDisa' => ($oTabla->afiliacionDisa == "")? Null: $oTabla->afiliacionDisa, 
			'afiliacionTipoFormato' => ($oTabla->afiliacionTipoFormato == "")? Null: $oTabla->afiliacionTipoFormato, 
			'afiliacionNroFormato' => ($oTabla->afiliacionNroFormato == "")? Null: $oTabla->afiliacionNroFormato, 
			'codigoTipoFormato' => ($oTabla->codigoTipoFormato == "")? Null: $oTabla->codigoTipoFormato, 
			'origenAseguradoInstitucion' => ($oTabla->origenAseguradoInstitucion == "")? Null: $oTabla->origenAseguradoInstitucion, 
			'origenAseguradoCodigo' => ($oTabla->origenAseguradoCodigo == "")? Null: $oTabla->origenAseguradoCodigo, 
			'edad' => ($oTabla->edad == 0)? Null: $oTabla->edad, 
			'grupoEtareo' => ($oTabla->grupoEtareo == "")? Null: $oTabla->grupoEtareo, 
			'genero' => ($oTabla->genero == "")? Null: $oTabla->genero, 
			'fuaAtencion' => ($oTabla->fuaAtencion == 0)? Null: $oTabla->fuaAtencion, 
			'fuaCondicionMaterna' => ($oTabla->fuaCondicionMaterna == "")? Null: $oTabla->fuaCondicionMaterna, 
			'fuaNrohistoria' => ($oTabla->fuaNrohistoria == "")? Null: $oTabla->fuaNrohistoria, 
			'fuaConceptoPr' => ($oTabla->fuaConceptoPr == 0)? Null: $oTabla->fuaConceptoPr, 
			'fuaConceptoPrAutoriz' => ($oTabla->fuaConceptoPrAutoriz == "")? Null: $oTabla->fuaConceptoPrAutoriz, 
			'fuaConceptoPrMonto' => $oTabla->fuaConceptoPrMonto, 
			'fuaAtencionFecha' => ($oTabla->fuaAtencionFecha == "")? Null: $oTabla->fuaAtencionFecha, 
			'fuaAtencionHora' => ($oTabla->fuaAtencionHora == "")? Null: $oTabla->fuaAtencionHora, 
			'fuaReferidoOrigenCodigoRENAES' => ($oTabla->fuaReferidoOrigenCodigoRENAES == "")? Null: $oTabla->fuaReferidoOrigenCodigoRENAES, 
			'fuaReferidoOrigenNreferencia' => ($oTabla->fuaReferidoOrigenNreferencia == "")? Null: $oTabla->fuaReferidoOrigenNreferencia, 
			'fuaCodigoPrestacion' => ($oTabla->fuaCodigoPrestacion == "")? Null: $oTabla->fuaCodigoPrestacion, 
			'fuaPersonalQatiende' => ($oTabla->fuaPersonalQatiende == 0)? Null: $oTabla->fuaPersonalQatiende, 
			'fuaAtencionLugar' => ($oTabla->fuaAtencionLugar == "")? Null: $oTabla->fuaAtencionLugar, 
			'fuaDestino' => ($oTabla->fuaDestino == "")? Null: $oTabla->fuaDestino, 
			'fuaHospitalizadoFingreso' => ($oTabla->fuaHospitalizadoFingreso == "")? Null: $oTabla->fuaHospitalizadoFingreso, 
			'fuaHospitalizadoFalta' => ($oTabla->fuaHospitalizadoFalta == "")? Null: $oTabla->fuaHospitalizadoFalta, 
			'fuaReferidoDestinoCodigoRENAES' => ($oTabla->fuaReferidoDestinoCodigoRENAES == "")? Null: $oTabla->fuaReferidoDestinoCodigoRENAES, 
			'fuaReferidoDestinoNreferencia' => ($oTabla->fuaReferidoDestinoNreferencia == "")? Null: $oTabla->fuaReferidoDestinoNreferencia, 
			'fuaMedicoDNI' => ($oTabla->fuaMedicoDNI == "")? Null: Left($oTabla->fuaMedicoDNI, 
			'fuaMedico' => ($oTabla->fuaMedico == "")? Null: $oTabla->fuaMedico, 
			'fuaMedicoTipo' => ($oTabla->fuaMedicoTipo == "")? Null: $oTabla->fuaMedicoTipo, 
			'afiliacionNroIntegrante' => ($oTabla->afiliacionNroIntegrante == "")? Null: $oTabla->afiliacionNroIntegrante, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idSiasis' => ($oTabla->idSiasis == "")? Null: $oTabla->idSiasis, 
			'fuaObservaciones' => ($oTabla->fuaObservaciones == "")? Null: $oTabla->fuaObservaciones, 
			'cabDniUsuarioRegistra' => ($oTabla->cabDniUsuarioRegistra == "")? Null: Left($oTabla->cabDniUsuarioRegistra, 
			'ultimaFechaAddMod' => ($oTabla->ultimaFechaAddMod == "")? Null: $oTabla->ultimaFechaAddMod, 
			'cabEstado' => ($oTabla->cabEstado == "")? Null: $oTabla->cabEstado, 
			'fuaFechaParto' => ($oTabla->fuaFechaParto == "")? Null: $oTabla->fuaFechaParto, 
			'establecimientoDistrito' => ($oTabla->establecimientoDistrito == "")? Null: $oTabla->establecimientoDistrito, 
			'anio' => ($oTabla->anio == "")? Null: $oTabla->anio, 
			'mes' => ($oTabla->mes == "")? Null: $oTabla->mes, 
			'costoTotal' => $oTabla->costoTotal, 
			'apaterno' => ($oTabla->apaterno == "")? Null: $oTabla->apaterno, 
			'amaterno' => ($oTabla->amaterno == "")? Null: $oTabla->amaterno, 
			'pnombre' => ($oTabla->pnombre == "")? Null: $oTabla->pnombre, 
			'onombre' => ($oTabla->onombre == "")? Null: $oTabla->onombre, 
			'fnacimiento' => ($oTabla->fnacimiento == "")? Null: $oTabla->fnacimiento, 
			'autogenerado' => ($oTabla->autogenerado == "")? Null: $oTabla->autogenerado, 
			'documentoTipo' => ($oTabla->documentoTipo == "")? Null: $oTabla->documentoTipo, 
			'documentoNumero' => ($oTabla->documentoNumero == "")? Null: $oTabla->documentoNumero, 
			'establecimientoCategoria' => ($oTabla->establecimientoCategoria == "")? Null: $oTabla->establecimientoCategoria, 
			'costoServicio' => $oTabla->costoServicio, 
			'costoMedicamento' => $oTabla->costoMedicamento, 
			'costoProcedimiento' => $oTabla->costoProcedimiento, 
			'costoInsumo' => $oTabla->costoInsumo, 
			'medicoDocumentoTipo' => ($oTabla->medicoDocumentoTipo == "")? Null: $oTabla->medicoDocumentoTipo, 
			'ate_grupoRiesgo' => ($oTabla->ate_grupoRiesgo == "")? Null: $oTabla->ate_grupoRiesgo, 
			'cabCodigoPuntoDigitacion' => ($oTabla->cabCodigoPuntoDigitacion == 0)? Null: $oTabla->cabCodigoPuntoDigitacion, 
			'cabCodigoUDR' => ($oTabla->cabCodigoUDR == "")? Null: $oTabla->cabCodigoUDR, 
			'cabNroEnvioAlSIS' => ($oTabla->cabNroEnvioAlSIS == "")? Null: $oTabla->cabNroEnvioAlSIS, 
			'cabOrigenDelRegistro' => ($oTabla->cabOrigenDelRegistro == "")? Null: $oTabla->cabOrigenDelRegistro, 
			'cabVersionAplicativo' => ($oTabla->cabVersionAplicativo == "")? Null: $oTabla->cabVersionAplicativo, 
			'cabIdentificacionPaquete' => $oTabla->cabIdentificacionPaquete, 
			'identificacionArfsis' => ($oTabla->identificacionArfsis == 0)? Null: $oTabla->identificacionArfsis, 
			'cabFechaFuaPrimeraVez' => ($oTabla->cabFechaFuaPrimeraVez == "")? Null: $oTabla->cabFechaFuaPrimeraVez, 
			'periodoOrigen' => ($oTabla->periodoOrigen == "")? Null: $oTabla->periodoOrigen, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC SisFuaAtencionEliminar :idCuentaAtencion, :idUsuarioAuditoria";

		$params = [
			'idCuentaAtencion' => $oTabla->idCuentaAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC SisFuaAtencionSeleccionarPorId :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $oTabla->idCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}