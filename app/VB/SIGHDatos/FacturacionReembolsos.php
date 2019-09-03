<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FacturacionReembolsos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC FacturacionReembolsosAgregar :idFactReembolso, :idCuentaAtencion, :consumoPorReembolsar, :reembolsoPorPagar, :reembolsoPagadoFarmacia, :reembolsoPagadoServicio, :idReembolsosAnteriores, :idDiagnostico, :nroReferenciaDestino, :idUsuarioAuditoria";

		$params = [
			'idFactReembolso' => ($oTabla->idFactReembolso == 0)? Null: $oTabla->idFactReembolso, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'consumoPorReembolsar' => $oTabla->consumoPorReembolsar, 
			'reembolsoPorPagar' => $oTabla->reembolsoPorPagar, 
			'reembolsoPagadoFarmacia' => $oTabla->reembolsoPagadoFarmacia, 
			'reembolsoPagadoServicio' => $oTabla->reembolsoPagadoServicio, 
			'idReembolsosAnteriores' => ($oTabla->idReembolsosAnteriores == "")? Null: $oTabla->idReembolsosAnteriores, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'nroReferenciaDestino' => ($oTabla->nroReferenciaDestino == "")? Null: $oTabla->nroReferenciaDestino, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FacturacionReembolsosModificar :idFactReembolso, :idCuentaAtencion, :consumoPorReembolsar, :reembolsoPorPagar, :reembolsoPagadoFarmacia, :reembolsoPagadoServicio, :idReembolsosAnteriores, :idDiagnostico, :nroReferenciaDestino, :idUsuarioAuditoria";

		$params = [
			'idFactReembolso' => ($oTabla->idFactReembolso == 0)? Null: $oTabla->idFactReembolso, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'consumoPorReembolsar' => $oTabla->consumoPorReembolsar, 
			'reembolsoPorPagar' => $oTabla->reembolsoPorPagar, 
			'reembolsoPagadoFarmacia' => $oTabla->reembolsoPagadoFarmacia, 
			'reembolsoPagadoServicio' => $oTabla->reembolsoPagadoServicio, 
			'idReembolsosAnteriores' => ($oTabla->idReembolsosAnteriores == "")? Null: $oTabla->idReembolsosAnteriores, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'nroReferenciaDestino' => ($oTabla->nroReferenciaDestino == "")? Null: $oTabla->nroReferenciaDestino, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FacturacionReembolsosEliminar :idFactReembolso, :idUsuarioAuditoria";

		$params = [
			'idFactReembolso' => $oTabla->idFactReembolso, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FacturacionReembolsosSeleccionarPorId :idFactReembolso";

		$params = [
			'idFactReembolso' => $oTabla->idFactReembolso, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}