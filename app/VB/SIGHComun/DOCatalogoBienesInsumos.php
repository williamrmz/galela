<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCatalogoBienesInsumos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'tipoProductoSismed', 
		'petitorio', 
		'idPaisOrigen', 
		'fabricante', 
		'presentacionEnvase', 
		'materialEnvase', 
		'formaFarmaceutica', 
		'presentacion', 
		'concentracion', 
		'denominacion', 
		'tipoProducto', 
		'stockMinimo', 
		'precioUltCompra', 
		'precioDonacion', 
		'precioDistribucion', 
		'precioCompra', 
		'idTipoSalidaBienInsumo', 
		'idUsuarioAuditoria', 
		'idCentroCosto', 
		'idPartida', 
		'idSubGrupoFarmacologico', 
		'idGrupoFarmacologico', 
		'idClasificacionBienInsumo', 
		'nombreComercial', 
		'nombre', 
		'codigo', 
		'idProducto', 
	];
}