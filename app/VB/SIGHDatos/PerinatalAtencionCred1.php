<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class PerinatalAtencionCred1 extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionCred1Agregar :idPerinatalAtencion, :idModulo, :estimulacionTemprana, :alimentacionComplementaria, :lactanciaMaterna, :personalSalud, :demandaIndividual, :mujerEdadReproductiva, :mujerGestante, :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idPerinatalAtencion' => ($oTabla->idPerinatalAtencion == 0)? Null: $oTabla->idPerinatalAtencion, 
			'idModulo' => ($oTabla->idModulo == 0)? Null: $oTabla->idModulo, 
			'estimulacionTemprana' => ($oTabla->estimulacionTemprana == 0)? Null: $oTabla->estimulacionTemprana, 
			'alimentacionComplementaria' => ($oTabla->alimentacionComplementaria == 0)? Null: $oTabla->alimentacionComplementaria, 
			'lactanciaMaterna' => ($oTabla->lactanciaMaterna == 0)? Null: $oTabla->lactanciaMaterna, 
			'personalSalud' => ($oTabla->personalSalud == 0)? Null: $oTabla->personalSalud, 
			'demandaIndividual' => ($oTabla->demandaIndividual == 0)? Null: $oTabla->demandaIndividual, 
			'mujerEdadReproductiva' => ($oTabla->mujerEdadReproductiva == 0)? Null: $oTabla->mujerEdadReproductiva, 
			'mujerGestante' => ($oTabla->mujerGestante == 0)? Null: $oTabla->mujerGestante, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionCred1Modificar :idPerinatalAtencion, :idModulo, :estimulacionTemprana, :alimentacionComplementaria, :lactanciaMaterna, :personalSalud, :demandaIndividual, :mujerEdadReproductiva, :mujerGestante, :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idPerinatalAtencion' => ($oTabla->idPerinatalAtencion == 0)? Null: $oTabla->idPerinatalAtencion, 
			'idModulo' => ($oTabla->idModulo == 0)? Null: $oTabla->idModulo, 
			'estimulacionTemprana' => ($oTabla->estimulacionTemprana == 0)? Null: $oTabla->estimulacionTemprana, 
			'alimentacionComplementaria' => ($oTabla->alimentacionComplementaria == 0)? Null: $oTabla->alimentacionComplementaria, 
			'lactanciaMaterna' => ($oTabla->lactanciaMaterna == 0)? Null: $oTabla->lactanciaMaterna, 
			'personalSalud' => ($oTabla->personalSalud == 0)? Null: $oTabla->personalSalud, 
			'demandaIndividual' => ($oTabla->demandaIndividual == 0)? Null: $oTabla->demandaIndividual, 
			'mujerEdadReproductiva' => ($oTabla->mujerEdadReproductiva == 0)? Null: $oTabla->mujerEdadReproductiva, 
			'mujerGestante' => ($oTabla->mujerGestante == 0)? Null: $oTabla->mujerGestante, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionCred1Eliminar :idPerinatalAtencion, :idUsuarioAuditoria";

		$params = [
			'idPerinatalAtencion' => $oTabla->idPerinatalAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionCred1SeleccionarPorId :idPerinatalAtencion";

		$params = [
			'idPerinatalAtencion' => $oTabla->idPerinatalAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function PerinatalAtencionCred1SeleccionarTodoPorIdAtencion($lnIdAtencion)
	{
		$query = "
			EXEC PerinatalAtencionCred1SeleccionarTodoPorIdAtencion :idAtencion";

		$params = [
			'idAtencion' => $lnIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}