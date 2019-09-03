<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FacturacionCatalogoPqte extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC FacturacionCatalogoPaquetesAgregar :idFactPaquete, :idPuntoCarga, :idProducto, :cantidad, :precio, :importe";

		$params = [
			'idFactPaquete' => ($oTabla->idFactPaquete == 0)? Null: $oTabla->idFactPaquete, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidad' => ($oTabla->cantidad == 0)? Null: $oTabla->cantidad, 
			'precio' => $oTabla->precio, 
			'importe' => $oTabla->importe, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FacturacionCatalogoPaquetesModificar :idFactPaquete, :idPuntoCarga, :idEspecialidadServicio, :idProducto, :cantidad, :precio, :importe, :idUsuarioAuditoria";

		$params = [
			'idFactPaquete' => ($oTabla->idFactPaquete == 0)? Null: $oTabla->idFactPaquete, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idEspecialidadServicio' => ($oTabla->idEspecialidadServicio == 0)? Null: $oTabla->idEspecialidadServicio, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidad' => ($oTabla->cantidad == 0)? Null: $oTabla->cantidad, 
			'precio' => $oTabla->precio, 
			'importe' => $oTabla->importe, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FacturacionCatalogoPaquetesEliminar :idFactPaquete, :idUsuarioAuditoria";

		$params = [
			'idFactPaquete' => $oTabla->idFactPaquete, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FacturacionCatalogoPaquetesSeleccionarPorId :idFactPaquete";

		$params = [
			'idFactPaquete' => $oTabla->idFactPaquete, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}