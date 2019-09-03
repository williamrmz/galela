<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ImagMovimientoImagenes extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC ImagMovimientoImagenesAgregar :idMovimiento, :idOrden, :correlativoAnual, :idCuentaAtencion, :idComprobantePago, :idPersonaTomaImagen, :idPersonaRecoge, :zonaRayosX, :porcInformeRadiolog, :resultadoFinal, :esContraste, :esContrasteIonico, :idDiagnostico, :esDiagnosticoDefinitivo, :eo_FUM, :eo_Gestantes, :eo_Partos, :eo_EG, :paciente, :idTipoSexo, :fechaNacimiento, :idUsuarioAuditoria";

		$params = [
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'correlativoAnual' => ($oTabla->correlativoAnual == 0)? Null: $oTabla->correlativoAnual, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idPersonaTomaImagen' => ($oTabla->idPersonaTomaImagen == 0)? Null: $oTabla->idPersonaTomaImagen, 
			'idPersonaRecoge' => ($oTabla->idPersonaRecoge == 0)? Null: $oTabla->idPersonaRecoge, 
			'zonaRayosX' => ($oTabla->zonaRayosX == "")? Null: $oTabla->zonaRayosX, 
			'porcInformeRadiolog' => $oTabla->porcInformeRadiolog, 
			'resultadoFinal' => ($oTabla->resultadoFinal == "")? Null: $oTabla->resultadoFinal, 
			'esContraste' => ($oTabla->esContraste == 0)? Null: $oTabla->esContraste, 
			'esContrasteIonico' => ($oTabla->esContrasteIonico == 0)? Null: $oTabla->esContrasteIonico, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'esDiagnosticoDefinitivo' => ($oTabla->esDiagnosticoDefinitivo == 0)? Null: $oTabla->esDiagnosticoDefinitivo, 
			'eo_FUM' => ($oTabla->eo_FUM == 0)? Null: $oTabla->eo_FUM, 
			'eo_Gestantes' => ($oTabla->eo_Gestantes == "")? Null: $oTabla->eo_Gestantes, 
			'eo_Partos' => ($oTabla->eo_Partos == "")? Null: $oTabla->eo_Partos, 
			'eo_EG' => ($oTabla->eo_EG == 0)? Null: $oTabla->eo_EG, 
			'paciente' => ($oTabla->paciente == "")? Null: Left($oTabla->paciente, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'fechaNacimiento' => ($oTabla->fechanacimiento == 0)? Null: $oTabla->fechanacimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ImagMovimientoImagenesModificar :idMovimiento, :idOrden, :correlativoAnual, :idCuentaAtencion, :idComprobantePago, :idPersonaTomaImagen, :idPersonaRecoge, :zonaRayosX, :porcInformeRadiolog, :resultadoFinal, :esContraste, :esContrasteIonico, :idDiagnostico, :esDiagnosticoDefinitivo, :eo_FUM, :eo_Gestantes, :eo_Partos, :eo_EG, :paciente, :idTipoSexo, :fechaNacimiento, :idUsuarioAuditoria";

		$params = [
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'correlativoAnual' => ($oTabla->correlativoAnual == 0)? Null: $oTabla->correlativoAnual, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idPersonaTomaImagen' => ($oTabla->idPersonaTomaImagen == 0)? Null: $oTabla->idPersonaTomaImagen, 
			'idPersonaRecoge' => ($oTabla->idPersonaRecoge == 0)? Null: $oTabla->idPersonaRecoge, 
			'zonaRayosX' => ($oTabla->zonaRayosX == "")? Null: $oTabla->zonaRayosX, 
			'porcInformeRadiolog' => $oTabla->porcInformeRadiolog, 
			'resultadoFinal' => ($oTabla->resultadoFinal == "")? Null: $oTabla->resultadoFinal, 
			'esContraste' => ($oTabla->esContraste == 0)? Null: $oTabla->esContraste, 
			'esContrasteIonico' => ($oTabla->esContrasteIonico == 0)? Null: $oTabla->esContrasteIonico, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'esDiagnosticoDefinitivo' => ($oTabla->esDiagnosticoDefinitivo == 0)? Null: $oTabla->esDiagnosticoDefinitivo, 
			'eo_FUM' => ($oTabla->eo_FUM == 0)? Null: $oTabla->eo_FUM, 
			'eo_Gestantes' => ($oTabla->eo_Gestantes == "")? Null: $oTabla->eo_Gestantes, 
			'eo_Partos' => ($oTabla->eo_Partos == "")? Null: $oTabla->eo_Partos, 
			'eo_EG' => ($oTabla->eo_EG == 0)? Null: $oTabla->eo_EG, 
			'paciente' => ($oTabla->paciente == "")? Null: Left($oTabla->paciente, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'fechaNacimiento' => ($oTabla->fechanacimiento == 0)? Null: $oTabla->fechanacimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ImagMovimientoImagenesEliminar :idMovimiento, :idUsuarioAuditoria";

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
			EXEC ImagMovimientoImagenesSeleccionarPorId :idMovimiento";

		$params = [
			'idMovimiento' => $oTabla->idMovimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function InsertarMovResultado($oTabla)
	{
		$query = "
			EXEC ImagMovimientoResultadoAgregar :idMovimiento, :idOrden, :idCuentaAtencion, :resultadoFinal, :idProducto, :idUsuario";

		$params = [
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idCuentaAtencion' => $oTabla->idCuentaAtencion, 
			'resultadoFinal' => ($oTabla->resultadoFinal == "")? Null: $oTabla->resultadoFinal, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function CargarResultadosImagenes($oTabla)
	{
		$query = "
			EXEC CargarResultadosPorMovimiento :idMovimiento, :idProducto";

		$params = [
			'idMovimiento' => $oTabla->idMovimiento, 
			'idProducto' => $oTabla->idProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ModificarMovResultado($oTabla)
	{
		$query = "
			EXEC ImagMovimientoResultadoModificar :idMovimiento, :resultadoFinal, :idProducto, :idUsuario";

		$params = [
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'resultadoFinal' => ($oTabla->resultadoFinal == "")? Null: $oTabla->resultadoFinal, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}