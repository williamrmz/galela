<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class SunasaPacientesHistoricos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idSunasaPacienteHistorico AS Int = :idSunasaPacienteHistorico
			SET NOCOUNT ON 
			EXEC SunasaPacientesHistoricosAgregar @idSunasaPacienteHistorico OUTPUT, :idPaciente, :codigoIAFA, :idPaisTitular, :idTipoDocumentoTitular, :nroDocumentoTitular, :apellidoCasada, :validacionRegIdentidad, :nroCarnetIdentidad, :estadoDelSeguro, :idAfiliacion, :productoYplan, :fechaInicioAfiliacion, :fechaFinalAfiliacion, :idRegimen, :codigoEstablecimientoIAFA, :codigoEstablecimientoRENAES, :idParentesco, :rUCempleador, :anteriorIdTipoDocumentoAsegurado, :anteriorNroDocumentoAsegurado, :dNIusarioOperacion, :idOperacion, :fechaEnvio, :sisSepelioParienteEncargado, :sisSepelioDni, :sisSepelioFnacimiento, :sisSepelioSexo, :sisNroAfiliacion, :yaNoTieneSeguro, :idUsuarioAuditoria
			SELECT @idSunasaPacienteHistorico AS idSunasaPacienteHistorico";

		$params = [
			'idSunasaPacienteHistorico' => 0, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'codigoIAFA' => ($oTabla->codigoIAFA == "")? Null: $oTabla->codigoIAFA, 
			'idPaisTitular' => ($oTabla->idPaisTitular == 0)? Null: $oTabla->idPaisTitular, 
			'idTipoDocumentoTitular' => ($oTabla->idTipoDocumentoTitular == 0)? Null: $oTabla->idTipoDocumentoTitular, 
			'nroDocumentoTitular' => ($oTabla->nroDocumentoTitular == "")? Null: $oTabla->nroDocumentoTitular, 
			'apellidoCasada' => ($oTabla->apellidoCasada == "")? Null: $oTabla->apellidoCasada, 
			'validacionRegIdentidad' => ($oTabla->validacionRegIdentidad == 0)? Null: $oTabla->validacionRegIdentidad, 
			'nroCarnetIdentidad' => ($oTabla->nroCarnetIdentidad == "")? Null: $oTabla->nroCarnetIdentidad, 
			'estadoDelSeguro' => ($oTabla->estadoDelSeguro == 0)? Null: $oTabla->estadoDelSeguro, 
			'idAfiliacion' => ($oTabla->idAfiliacion == 0)? Null: $oTabla->idAfiliacion, 
			'productoYplan' => ($oTabla->productoYplan == "")? Null: $oTabla->productoYplan, 
			'fechaInicioAfiliacion' => ($oTabla->fechaInicioAfiliacion == 0)? Null: $oTabla->fechaInicioAfiliacion, 
			'fechaFinalAfiliacion' => ($oTabla->fechaFinalAfiliacion == 0)? Null: $oTabla->fechaFinalAfiliacion, 
			'idRegimen' => ($oTabla->idRegimen == 0)? Null: $oTabla->idRegimen, 
			'codigoEstablecimientoIAFA' => ($oTabla->codigoEstablecimientoIAFA == "")? Null: $oTabla->codigoEstablecimientoIAFA, 
			'codigoEstablecimientoRENAES' => ($oTabla->codigoEstablecimientoRENAES == "")? Null: $oTabla->codigoEstablecimientoRENAES, 
			'idParentesco' => ($oTabla->idParentesco == 0)? Null: $oTabla->idParentesco, 
			'rUCempleador' => ($oTabla->rUCempleador == "")? Null: $oTabla->rUCempleador, 
			'anteriorIdTipoDocumentoAsegurado' => ($oTabla->anteriorIdTipoDocumentoAsegurado == 0)? Null: $oTabla->anteriorIdTipoDocumentoAsegurado, 
			'anteriorNroDocumentoAsegurado' => ($oTabla->anteriorNroDocumentoAsegurado == "")? Null: $oTabla->anteriorNroDocumentoAsegurado, 
			'dNIusarioOperacion' => ($oTabla->dNIusarioOperacion == "")? Null: $oTabla->dNIusarioOperacion, 
			'idOperacion' => ($oTabla->idOperacion == 0)? Null: $oTabla->idOperacion, 
			'fechaEnvio' => ($oTabla->fechaEnvio == 0)? Null: $oTabla->fechaEnvio, 
			'sisSepelioParienteEncargado' => ($oTabla->sisSepelioParienteEncargado == "")? Null: $oTabla->sisSepelioParienteEncargado, 
			'sisSepelioDni' => ($oTabla->sisSepelioDni == "")? Null: $oTabla->sisSepelioDni, 
			'sisSepelioFnacimiento' => ($oTabla->sisSepelioFnacimiento == 0)? Null: $oTabla->sisSepelioFnacimiento, 
			'sisSepelioSexo' => ($oTabla->sisSepelioSexo == 0)? Null: $oTabla->sisSepelioSexo, 
			'sisNroAfiliacion' => ($oTabla->sisNroAfiliacion == "")? Null: $oTabla->sisNroAfiliacion, 
			'yaNoTieneSeguro' => $oTabla->yaNoTieneSeguro, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		
		$query = "
			EXEC SunasaPacientesHistoricosModificar :idSunasaPacienteHistorico, :idPaciente, :codigoIAFA, :idPaisTitular, :idTipoDocumentoTitular, :nroDocumentoTitular, :apellidoCasada, :validacionRegIdentidad, :nroCarnetIdentidad, :estadoDelSeguro, :idAfiliacion, :productoYplan, :fechaInicioAfiliacion, :fechaFinalAfiliacion, :idRegimen, :codigoEstablecimientoIAFA, :codigoEstablecimientoRENAES, :idParentesco, :rUCempleador, :anteriorIdTipoDocumentoAsegurado, :anteriorNroDocumentoAsegurado, :dNIusarioOperacion, :idOperacion, :fechaEnvio, :sisSepelioParienteEncargado, :sisSepelioDni, :sisSepelioFnacimiento, :sisSepelioSexo, :sisNroAfiliacion, :yaNoTieneSeguro, :idUsuarioAuditoria";

		$params = [
			'idSunasaPacienteHistorico' => ($oTabla->idSunasaPacienteHistorico == 0)? Null: $oTabla->idSunasaPacienteHistorico, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'codigoIAFA' => ($oTabla->codigoIAFA == "")? Null: $oTabla->codigoIAFA, 
			'idPaisTitular' => ($oTabla->idPaisTitular == 0)? Null: $oTabla->idPaisTitular, 
			'idTipoDocumentoTitular' => ($oTabla->idTipoDocumentoTitular == 0)? Null: $oTabla->idTipoDocumentoTitular, 
			'nroDocumentoTitular' => ($oTabla->nroDocumentoTitular == "")? Null: $oTabla->nroDocumentoTitular, 
			'apellidoCasada' => ($oTabla->apellidoCasada == "")? Null: $oTabla->apellidoCasada, 
			'validacionRegIdentidad' => ($oTabla->validacionRegIdentidad == 0)? Null: $oTabla->validacionRegIdentidad, 
			'nroCarnetIdentidad' => ($oTabla->nroCarnetIdentidad == "")? Null: $oTabla->nroCarnetIdentidad, 
			'estadoDelSeguro' => ($oTabla->estadoDelSeguro == 0)? Null: $oTabla->estadoDelSeguro, 
			'idAfiliacion' => ($oTabla->idAfiliacion == 0)? Null: $oTabla->idAfiliacion, 
			'productoYplan' => ($oTabla->productoYplan == "")? Null: $oTabla->productoYplan, 
			'fechaInicioAfiliacion' => ($oTabla->fechaInicioAfiliacion == 0)? Null: $oTabla->fechaInicioAfiliacion, 
			'fechaFinalAfiliacion' => ($oTabla->fechaFinalAfiliacion == 0)? Null: $oTabla->fechaFinalAfiliacion, 
			'idRegimen' => ($oTabla->idRegimen == 0)? Null: $oTabla->idRegimen, 
			'codigoEstablecimientoIAFA' => ($oTabla->codigoEstablecimientoIAFA == "")? Null: $oTabla->codigoEstablecimientoIAFA, 
			'codigoEstablecimientoRENAES' => ($oTabla->codigoEstablecimientoRENAES == "")? Null: $oTabla->codigoEstablecimientoRENAES, 
			'idParentesco' => ($oTabla->idParentesco == 0)? Null: $oTabla->idParentesco, 
			'rUCempleador' => ($oTabla->rUCempleador == "")? Null: $oTabla->rUCempleador, 
			'anteriorIdTipoDocumentoAsegurado' => ($oTabla->anteriorIdTipoDocumentoAsegurado == 0)? Null: $oTabla->anteriorIdTipoDocumentoAsegurado, 
			'anteriorNroDocumentoAsegurado' => ($oTabla->anteriorNroDocumentoAsegurado == "")? Null: $oTabla->anteriorNroDocumentoAsegurado, 
			'dNIusarioOperacion' => ($oTabla->dNIusarioOperacion == "")? Null: $oTabla->dNIusarioOperacion, 
			'idOperacion' => ($oTabla->idOperacion == 0)? Null: $oTabla->idOperacion, 
			'fechaEnvio' => ($oTabla->fechaEnvio == 0)? Null: $oTabla->fechaEnvio, 
			'sisSepelioParienteEncargado' => ($oTabla->sisSepelioParienteEncargado == "")? Null: $oTabla->sisSepelioParienteEncargado, 
			'sisSepelioDni' => ($oTabla->sisSepelioDni == "")? Null: $oTabla->sisSepelioDni, 
			'sisSepelioFnacimiento' => ($oTabla->sisSepelioFnacimiento == 0)? Null: $oTabla->sisSepelioFnacimiento, 
			'sisSepelioSexo' => ($oTabla->sisSepelioSexo == 0)? Null: $oTabla->sisSepelioSexo, 
			'sisNroAfiliacion' => ($oTabla->sisNroAfiliacion == "")? Null: $oTabla->sisNroAfiliacion, 
			'yaNoTieneSeguro' => $oTabla->yaNoTieneSeguro, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC SunasaPacientesHistoricosEliminar :idSunasaPacienteHistorico, :idUsuarioAuditoria";

		$params = [
			'idSunasaPacienteHistorico' => $oTabla->idSunasaPacienteHistorico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC SunasaPacientesHistoricosSeleccionarPorId :idSunasaPacienteHistorico";

		$params = [
			'idSunasaPacienteHistorico' => $oTabla->idSunasaPacienteHistorico, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdPaciente($oTabla)
	{
		$query = "
			EXEC SunasaPacientesHistoricosSeleccionarPorIdPaciente :idPaciente ";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}