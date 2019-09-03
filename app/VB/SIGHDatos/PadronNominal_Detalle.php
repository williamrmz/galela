<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class PadronNominal_Detalle extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC PadronNominal_DetalleAgregar :idPaNomDetalle, :idTipoDoc, :numDocumento, :histClinica, :apellidoPaterno, :apellidoMaterno, :nombres, :idSexo, :fecNacimiento, :idTipoSeguro, :numAfiliacion, :fecEvaluacion, :peso, :talla, :idDiagNutricional, :codRenaes, :idDiagPE, :idDiagPT, :idDiagTE, :hemoglobina, :heces, :idUsuarioAuditoria";

		$params = [
			'idPaNomDetalle' => 0, 
			'idTipoDoc' => ($oTabla->idTipoDoc == 0)? Null: $oTabla->idTipoDoc, 
			'numDocumento' => ($oTabla->numDocumento == 0)? Null: $oTabla->numDocumento, 
			'histClinica' => ($oTabla->histClinica == "")? Null: $oTabla->histClinica, 
			'apellidoPaterno' => ($oTabla->apellidoPaterno == "")? Null: $oTabla->apellidoPaterno, 
			'apellidoMaterno' => ($oTabla->apellidoMaterno == "")? Null: $oTabla->apellidoMaterno, 
			'nombres' => ($oTabla->nombres == "")? Null: $oTabla->nombres, 
			'idSexo' => ($oTabla->idSexo == 0)? Null: $oTabla->idSexo, 
			'fecNacimiento' => ($oTabla->fecNacimiento == "")? Null: $oTabla->fecNacimiento, 
			'idTipoSeguro' => ($oTabla->idTipoSeguro == 0)? Null: $oTabla->idTipoSeguro, 
			'numAfiliacion' => ($oTabla->numAfiliacion == "")? Null: $oTabla->numAfiliacion, 
			'fecEvaluacion' => ($oTabla->fecEvaluacion == "")? Null: $oTabla->fecEvaluacion, 
			'peso' => ($oTabla->peso == "")? Null: $oTabla->peso, 
			'talla' => ($oTabla->talla == "")? Null: $oTabla->talla, 
			'idDiagNutricional' => ($oTabla->idDiagNutricional == 0)? 0: $oTabla->idDiagNutricional, 
			'codRenaes' => ($oTabla->codRenaes == 0)? Null: $oTabla->codRenaes, 
			'idDiagPE' => ($oTabla->idDiagPE == 0)? Null: $oTabla->idDiagPE, 
			'idDiagPT' => ($oTabla->idDiagPT == 0)? Null: $oTabla->idDiagPT, 
			'idDiagTE' => ($oTabla->idDiagTE == 0)? Null: $oTabla->idDiagTE, 
			'hemoglobina' => $oTabla->hemoglobina, 
			'heces' => $oTabla->heces, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PadronNominal_DetalleModificar :idPaNomDetalle, :idTipoDoc, :numDocumento, :histClinica, :apellidoPaterno, :apellidoMaterno, :nombres, :idSexo, :fecNacimiento, :idTipoSeguro, :numAfiliacion, :fecEvaluacion, :peso, :talla, :idDiagNutricional, :codRenaes, :idDiagPE, :idDiagPT, :idDiagTE, :hemoglobina, :heces, :idUsuarioAuditoria";

		$params = [
			'idPaNomDetalle' => ($oTabla->idPaNomDetalle == 0)? Null: $oTabla->idPaNomDetalle, 
			'idTipoDoc' => ($oTabla->idTipoDoc == 0)? Null: $oTabla->idTipoDoc, 
			'numDocumento' => ($oTabla->numDocumento == 0)? Null: $oTabla->numDocumento, 
			'histClinica' => ($oTabla->histClinica == "")? Null: $oTabla->histClinica, 
			'apellidoPaterno' => ($oTabla->apellidoPaterno == "")? Null: $oTabla->apellidoPaterno, 
			'apellidoMaterno' => ($oTabla->apellidoMaterno == "")? Null: $oTabla->apellidoMaterno, 
			'nombres' => ($oTabla->nombres == "")? Null: $oTabla->nombres, 
			'idSexo' => ($oTabla->idSexo == 0)? Null: $oTabla->idSexo, 
			'fecNacimiento' => ($oTabla->fecNacimiento == "")? Null: $oTabla->fecNacimiento, 
			'idTipoSeguro' => ($oTabla->idTipoSeguro == 0)? Null: $oTabla->idTipoSeguro, 
			'numAfiliacion' => ($oTabla->numAfiliacion == "")? Null: $oTabla->numAfiliacion, 
			'fecEvaluacion' => ($oTabla->fecEvaluacion == "")? Null: $oTabla->fecEvaluacion, 
			'peso' => ($oTabla->peso == "")? Null: $oTabla->peso, 
			'talla' => ($oTabla->talla == "")? Null: $oTabla->talla, 
			'idDiagNutricional' => ($oTabla->idDiagNutricional == 0)? Null: $oTabla->idDiagNutricional, 
			'codRenaes' => ($oTabla->codRenaes == 0)? Null: $oTabla->codRenaes, 
			'idDiagPE' => ($oTabla->idDiagPE == 0)? Null: $oTabla->idDiagPE, 
			'idDiagPT' => ($oTabla->idDiagPT == 0)? Null: $oTabla->idDiagPT, 
			'idDiagTE' => ($oTabla->idDiagTE == 0)? Null: $oTabla->idDiagTE, 
			'hemoglobina' => $oTabla->hemoglobina, 
			'heces' => $oTabla->heces, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PadronNominal_DetalleEliminar :idPaNomDetalle, :idUsuarioAuditoria";

		$params = [
			'idPaNomDetalle' => $oTabla->idPaNomDetalle, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC PadronNominal_DetalleSeleccionarPorId :idPaNomDetalle";

		$params = [
			'idPaNomDetalle' => $oTabla->idPaNomDetalle, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}