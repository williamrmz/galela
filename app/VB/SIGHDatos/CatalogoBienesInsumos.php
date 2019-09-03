<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CatalogoBienesInsumos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idProducto AS Int = :idProducto
			SET NOCOUNT ON 
			EXEC FactCatalogoBienesInsumosAgregar :idCentroCosto, :idPartida, :idSubGrupoFarmacologico, :idGrupoFarmacologico, :nombreComercial, :nombre, :codigo, @idProducto OUTPUT, :idUsuarioAuditoria, :precioCompra, :precioDistribucion, :precioDonacion, :precioUltCompra, :idTipoSalidaBienInsumo, :stockMinimo, :tipoProducto, :denominacion, :concentracion, :presentacion, :formaFarmaceutica, :materialEnvase, :presentacionEnvase, :fabricante, :idPaisOrigen, :petitorio, :tipoProductoSismed
			SELECT @idProducto AS idProducto";

		$params = [
			'idCentroCosto' => ($oTabla->idCentroCosto == 0)? Null: $oTabla->idCentroCosto, 
			'idPartida' => ($oTabla->idPartida == 0)? Null: $oTabla->idPartida, 
			'idSubGrupoFarmacologico' => ($oTabla->idSubGrupoFarmacologico == 0)? Null: $oTabla->idSubGrupoFarmacologico, 
			'idGrupoFarmacologico' => ($oTabla->idGrupoFarmacologico == 0)? Null: $oTabla->idGrupoFarmacologico, 
			'nombreComercial' => ($oTabla->nombreComercial == "")? Null: $oTabla->nombreComercial, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idProducto' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'precioCompra' => $oTabla->precioCompra, 
			'precioDistribucion' => $oTabla->precioDistribucion, 
			'precioDonacion' => $oTabla->precioDonacion, 
			'precioUltCompra' => $oTabla->precioUltCompra, 
			'idTipoSalidaBienInsumo' => $oTabla->idTipoSalidaBienInsumo, 
			'stockMinimo' => ($oTabla->stockMinimo == 0)? Null: $oTabla->stockMinimo, 
			'tipoProducto' => $oTabla->tipoProducto, 
			'denominacion' => ($oTabla->denominacion == "")? Null: $oTabla->denominacion, 
			'concentracion' => ($oTabla->concentracion == "")? Null: $oTabla->concentracion, 
			'presentacion' => ($oTabla->presentacion == "")? Null: $oTabla->presentacion, 
			'formaFarmaceutica' => ($oTabla->formaFarmaceutica == "")? Null: $oTabla->formaFarmaceutica, 
			'materialEnvase' => ($oTabla->materialEnvase == "")? Null: $oTabla->materialEnvase, 
			'presentacionEnvase' => ($oTabla->presentacionEnvase == "")? Null: $oTabla->presentacionEnvase, 
			'fabricante' => ($oTabla->fabricante == "")? Null: $oTabla->fabricante, 
			'idPaisOrigen' => ($oTabla->idPaisOrigen == 0)? Null: $oTabla->idPaisOrigen, 
			'petitorio' => $oTabla->petitorio, 
			'tipoProductoSismed' => $oTabla->tipoProductoSismed, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactCatalogoBienesInsumosModificar :idCentroCosto, :idPartida, :idSubGrupoFarmacologico, :idGrupoFarmacologico, :nombreComercial, :nombre, :codigo, :idProducto, :idUsuarioAuditoria, :precioCompra, :precioDistribucion, :precioDonacion, :precioUltCompra, :idTipoSalidaBienInsumo, :stockMinimo, :tipoProducto, :denominacion, :concentracion, :presentacion, :formaFarmaceutica, :materialEnvase, :presentacionEnvase, :fabricante, :idPaisOrigen, :petitorio, :tipoProductoSismed";

		$params = [
			'idCentroCosto' => ($oTabla->idCentroCosto == 0)? Null: $oTabla->idCentroCosto, 
			'idPartida' => ($oTabla->idPartida == 0)? Null: $oTabla->idPartida, 
			'idSubGrupoFarmacologico' => ($oTabla->idSubGrupoFarmacologico == 0)? Null: $oTabla->idSubGrupoFarmacologico, 
			'idGrupoFarmacologico' => ($oTabla->idGrupoFarmacologico == 0)? Null: $oTabla->idGrupoFarmacologico, 
			'nombreComercial' => ($oTabla->nombreComercial == "")? Null: $oTabla->nombreComercial, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'precioCompra' => $oTabla->precioCompra, 
			'precioDistribucion' => $oTabla->precioDistribucion, 
			'precioDonacion' => $oTabla->precioDonacion, 
			'precioUltCompra' => $oTabla->precioUltCompra, 
			'idTipoSalidaBienInsumo' => $oTabla->idTipoSalidaBienInsumo, 
			'stockMinimo' => ($oTabla->stockMinimo == 0)? Null: $oTabla->stockMinimo, 
			'tipoProducto' => $oTabla->tipoProducto, 
			'denominacion' => ($oTabla->denominacion == "")? Null: $oTabla->denominacion, 
			'concentracion' => ($oTabla->concentracion == "")? Null: $oTabla->concentracion, 
			'presentacion' => ($oTabla->presentacion == "")? Null: $oTabla->presentacion, 
			'formaFarmaceutica' => ($oTabla->formaFarmaceutica == "")? Null: $oTabla->formaFarmaceutica, 
			'materialEnvase' => ($oTabla->materialEnvase == "")? Null: $oTabla->materialEnvase, 
			'presentacionEnvase' => ($oTabla->presentacionEnvase == "")? Null: $oTabla->presentacionEnvase, 
			'fabricante' => ($oTabla->fabricante == "")? Null: $oTabla->fabricante, 
			'idPaisOrigen' => ($oTabla->idPaisOrigen == 0)? Null: $oTabla->idPaisOrigen, 
			'petitorio' => $oTabla->petitorio, 
			'tipoProductoSismed' => $oTabla->tipoProductoSismed, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactCatalogoBienesInsumosEliminar :idProducto, :idUsuarioAuditoria";

		$params = [
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactCatalogoBienesInsumosSeleccionarPorId :idProducto";

		$params = [
			'idProducto' => $oTabla->idProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oTabla)
	{
		$query = "
			EXEC CatalogoBienesInsumosFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarCatalogoBase($oTabla)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarCatalogo($oTabla, $lTipoCatalogo)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarCatalogoDEBB($oTabla, $lTipoCatalogo)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorTipoCatalogo($oDoCatalogoBienInsumo, $lTipoCatalogo)
	{
		$query = "
			EXEC FactCatalogoBienesInsumosHospSeleccionarPorTipoCatalogo :lcFiltro, :lTipoCatalogo";

		$params = [
			'lcFiltro' => sSql, 
			'lTipoCatalogo' => Trim(Str($lTipoCatalogo)), 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCuentaAtencionNoPagados($idCuentaAtencion, $lTipoCatalogo, $idPuntosDeCarga, $lEstadoFacturacion)
	{
		$query = "
			EXEC FactCatalogoBienesInsumosSeleccionarPorCuentaAtencionNoPagados :lcFiltro, :lTipoCatalogo, :idCuentaAtencion";

		$params = [
			'lcFiltro' => sSql, 
			'lTipoCatalogo' => $lTipoCatalogo, 
			'idCuentaAtencion' => IdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarBienesLike($sNombre, $lIdTipoFinanciamiento, $lIdPuntoCarga)
	{
		$query = "
			EXEC FactCatalogoBienesInsumosSeleccionarBienesLike :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdYtipoFinanciamiento($idProducto, $idTipoFinanciamiento)
	{
		$query = "
			EXEC FactCatalogoBienesInsumosSeleccionarPorIdYtipoFinanciamiento :idTipoFinanciamiento, :idProducto";

		$params = [
			'idTipoFinanciamiento' => $idTipoFinanciamiento, 
			'idProducto' => $idProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigo($lcCodigo, $oConexion1)
	{
		$query = "
			EXEC FactCatalogoBienesInsumosHospActualizaPrecioSegunIdProducto :lcCodigo, :idProducto, :precioNuevo";

		$params = [
			'lcCodigo' => "@$lcCodigo", adVarChar, adParamInput, 7, Left($lcCodigo, 7), 
			'idProducto' => lnIdProducto, 
			'precioNuevo' => lnPrecioNuevo, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}