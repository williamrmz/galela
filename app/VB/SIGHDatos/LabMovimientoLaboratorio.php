<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class LabMovimientoLaboratorio extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC LabMovimientoLaboratorioAgregar :idMovimiento, :idOrden, :correlativoAnual, :idCuentaAtencion, :idComprobantePago, :idPersonaTomaLab, :idPersonaRecoge, :idDiagnostico, :esDiagnosticoDefinitivo, :ordenaPrueba, :paciente, :idTipoSexo, :fechaNacimiento, :idUsuarioAuditoria";

		$params = [
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'correlativoAnual' => ($oTabla->correlativoAnual == 0)? Null: $oTabla->correlativoAnual, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idPersonaTomaLab' => ($oTabla->idPersonaTomaLab == 0)? Null: $oTabla->idPersonaTomaLab, 
			'idPersonaRecoge' => ($oTabla->idPersonaRecoge == 0)? Null: $oTabla->idPersonaRecoge, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'esDiagnosticoDefinitivo' => ($oTabla->esDiagnosticoDefinitivo == 0)? Null: $oTabla->esDiagnosticoDefinitivo, 
			'ordenaPrueba' => ($oTabla->ordenaPrueba == "")? Null: $oTabla->ordenaPrueba, 
			'paciente' => ($oTabla->paciente == "")? Null: Left($oTabla->paciente, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'fechaNacimiento' => ($oTabla->fechaNacimiento == 0)? Null: $oTabla->fechaNacimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC LabMovimientoLaboratorioModificar :idMovimiento, :idOrden, :correlativoAnual, :idCuentaAtencion, :idComprobantePago, :idPersonaTomaLab, :idPersonaRecoge, :idDiagnostico, :esDiagnosticoDefinitivo, :ordenaPrueba, :paciente, :idTipoSexo, :fechaNacimiento, :idUsuarioAuditoria";

		$params = [
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'correlativoAnual' => ($oTabla->correlativoAnual == 0)? Null: $oTabla->correlativoAnual, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idPersonaTomaLab' => ($oTabla->idPersonaTomaLab == 0)? Null: $oTabla->idPersonaTomaLab, 
			'idPersonaRecoge' => ($oTabla->idPersonaRecoge == 0)? Null: $oTabla->idPersonaRecoge, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'esDiagnosticoDefinitivo' => ($oTabla->esDiagnosticoDefinitivo == 0)? Null: $oTabla->esDiagnosticoDefinitivo, 
			'ordenaPrueba' => ($oTabla->ordenaPrueba == "")? Null: $oTabla->ordenaPrueba, 
			'paciente' => ($oTabla->paciente == "")? Null: Left($oTabla->paciente, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'fechaNacimiento' => ($oTabla->fechaNacimiento == 0)? Null: $oTabla->fechaNacimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC LabMovimientoLaboratorioEliminar :idMovimiento, :idUsuarioAuditoria";

		$params = [
			'idMovimiento' => $oTabla->idMovimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC LabMovimientoLaboratorioSeleccionarPorId :idMovimiento";

		$params = [
			'idMovimiento' => $oTabla->idMovimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}