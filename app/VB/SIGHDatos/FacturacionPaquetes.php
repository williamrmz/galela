<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FacturacionPaquetes extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC FacturacionPaquetesAgregar :idComprobantePago, :idOrdenPago, :idProducto, :idFactPaquete, :idPuntoCarga, :idEspecialidadServicio, :atencionId, :idUsuarioAuditoria";

		$params = [
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idOrdenPago' => ($oTabla->idOrdenPago == 0)? Null: $oTabla->idOrdenPago, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idFactPaquete' => ($oTabla->idFactPaquete == 0)? Null: $oTabla->idFactPaquete, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idEspecialidadServicio' => ($oTabla->idEspecialidadServicio == 0)? Null: $oTabla->idEspecialidadServicio, 
			'atencionId' => ($oTabla->atencionId == 0)? Null: $oTabla->atencionId, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FacturacionPaquetesModificar :idComprobantePago, :idOrdenPago, :idProducto, :idFactPaquete, :idPuntoCarga, :idEspecialidadServicio, :atencionId, :idUsuarioAuditoria";

		$params = [
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idOrdenPago' => ($oTabla->idOrdenPago == 0)? Null: $oTabla->idOrdenPago, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idFactPaquete' => ($oTabla->idFactPaquete == 0)? Null: $oTabla->idFactPaquete, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idEspecialidadServicio' => ($oTabla->idEspecialidadServicio == 0)? Null: $oTabla->idEspecialidadServicio, 
			'atencionId' => ($oTabla->atencionId == 0)? Null: $oTabla->atencionId, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FacturacionPaquetesEliminar :idComprobantePago, :idUsuarioAuditoria";

		$params = [
			'idComprobantePago' => $oTabla->idComprobantePago, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FacturacionPaquetesSeleccionarPorId :idComprobantePago";

		$params = [
			'idComprobantePago' => $oTabla->idComprobantePago, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}