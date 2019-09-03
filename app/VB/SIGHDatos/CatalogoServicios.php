<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CatalogoServicios extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idProducto AS Int = :idProducto
			SET NOCOUNT ON 
			EXEC FactCatalogoServiciosAgregar :idServicioSubGrupo, :idPartida, :idCentroCosto, :idServicioSubSeccion, :idServicioSeccion, :idServicioGrupo, :nombre, :codigo, @idProducto OUTPUT, :esCpt, :nombreMINSA, :idEstado, :codigoSIS, :idUsuarioAuditoria
			SELECT @idProducto AS idProducto";

		$params = [
			'idServicioSubGrupo' => ($oTabla->idServicioSubGrupo == 0)? Null: $oTabla->idServicioSubGrupo, 
			'idPartida' => ($oTabla->idPartida == 0)? Null: $oTabla->idPartida, 
			'idCentroCosto' => ($oTabla->idCentroCosto == 0)? Null: $oTabla->idCentroCosto, 
			'idServicioSubSeccion' => ($oTabla->idServicioSubSeccion == 0)? Null: $oTabla->idServicioSubSeccion, 
			'idServicioSeccion' => ($oTabla->idServicioSeccion == 0)? Null: $oTabla->idServicioSeccion, 
			'idServicioGrupo' => ($oTabla->idServicioGrupo == 0)? Null: $oTabla->idServicioGrupo, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idProducto' => 0, 
			'esCpt' => $oTabla->esCpt, 
			'nombreMINSA' => ($oTabla->nombreMINSA == "")? Null: $oTabla->nombreMINSA, 
			'idEstado' => $oTabla->idEstado, 
			'codigoSIS' => ($oTabla->codigoSIS == "")? Null: $oTabla->codigoSIS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosModificar :idServicioSubGrupo, :idPartida, :idCentroCosto, :idServicioSubSeccion, :idServicioSeccion, :idServicioGrupo, :nombre, :codigo, :idProducto, :esCpt, :nombreMINSA, :idEstado, :codigoSIS, :idUsuarioAuditoria";

		$params = [
			'idServicioSubGrupo' => ($oTabla->idServicioSubGrupo == 0)? Null: $oTabla->idServicioSubGrupo, 
			'idPartida' => ($oTabla->idPartida == 0)? Null: $oTabla->idPartida, 
			'idCentroCosto' => ($oTabla->idCentroCosto == 0)? Null: $oTabla->idCentroCosto, 
			'idServicioSubSeccion' => ($oTabla->idServicioSubSeccion == 0)? Null: $oTabla->idServicioSubSeccion, 
			'idServicioSeccion' => ($oTabla->idServicioSeccion == 0)? Null: $oTabla->idServicioSeccion, 
			'idServicioGrupo' => ($oTabla->idServicioGrupo == 0)? Null: $oTabla->idServicioGrupo, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'esCpt' => $oTabla->esCpt, 
			'nombreMINSA' => ($oTabla->nombreMINSA == "")? Null: $oTabla->nombreMINSA, 
			'idEstado' => $oTabla->idEstado, 
			'codigoSIS' => ($oTabla->codigoSIS == "")? Null: $oTabla->codigoSIS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosEliminar :idProducto, :idUsuarioAuditoria";

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
			EXEC FactCatalogoServiciosSeleccionarPorId :idProducto";

		$params = [
			'idProducto' => $oTabla->idProducto, 
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

	public function SeleccionarCatalogoBase()
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarCatalogo($lTipoCatalogo)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorTipoCatalogo($oDoCatalogoServicio, $lTipoCatalogo)
	{
		$query = "
			EXEC FactCatalogoServiciosSeleccionarPorTipoCatalogo :lcFiltro, :lTipoCatalogo";

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
			EXEC FactCatalogoServiciosSeleccionarPorTipoCatalogo :lcFiltro, :lTipoCatalogo, :idCuentaAtencion";

		$params = [
			'lcFiltro' => sSql, 
			'lTipoCatalogo' => $lTipoCatalogo, 
			'idCuentaAtencion' => IdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarServiciosLike($sNombre, $lIdTipoFinanciamiento, $lIdPuntoCarga)
	{
		$query = "
			EXEC CommandText = spQuery 'JHIMI 2507201 :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarServiciosPorNombreOCodigoSegunTipofinanciamientoYpuntoCarga($lnTipoFiltro, $lcFiltro, $lnIdTipoFinanciamiento, $lnIdPuntoCarga, $lnTipoServicioAfiltrar)
	{
		$query = "
			EXEC FactCatalogoServiciosHospFiltraPorPuntoCargaTipoFinanciamiento :idPuntoCarga, :idTipoFinanciamiento, :idFiltroTipo, :filtro , :tipoServicioOfrecido";

		$params = [
			'idPuntoCarga' => LnIdPuntoCarga, 
			'idTipoFinanciamiento' => LnIdTipoFinanciamiento, 
			'idFiltroTipo' => LnTipoFiltro, 
			'filtro ' => $lcFiltro, 
			'tipoServicioOfrecido' => $lnTipoServicioAfiltrar, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FactCatalogoServiciosSeleccionarPorCodigoOnombre($lcCodigo, $lcNombre, $oConexion1)
	{
		$query = "
			EXEC FactCatalogoServiciosSeleccionarPorCodigoOnombre :codigo, :nombre";

		$params = [
			'codigo' => $lcCodigo, 
			'nombre' => $lcNombre, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarServiciosPorNombreOCodigoSegunPuntoCarga($lnTipoFiltro, $lcFiltro, $lnIdPuntoCarga, $lnTipoServicioAfiltrar)
	{
		$query = "
			EXEC FactCatalogoServiciosHospFiltraPorPuntoCarga :idPuntoCarga, :idFiltroTipo, :filtro , :tipoServicioOfrecido";

		$params = [
			'idPuntoCarga' => LnIdPuntoCarga, 
			'idFiltroTipo' => LnTipoFiltro, 
			'filtro ' => $lcFiltro, 
			'tipoServicioOfrecido' => $lnTipoServicioAfiltrar, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdYtipoFinanciamiento($idProducto, $idTipoFinanciamiento)
	{
		$query = "
			EXEC FactCatalogoServiciosSeleccionarPorIdYtipoFinanciamiento :idProducto, :idTipoFinanciamiento";

		$params = [
			'idProducto' => $idProducto, 
			'idTipoFinanciamiento' => $idTipoFinanciamiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigo($lcCodigo, $oConexion1)
	{
		$query = "
			EXEC FactCatalogoServiciosXcodigo :lcCodigo";

		$params = [
			'lcCodigo' => $lcCodigo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigoSIS($lcCodigo, $oConexion1)
	{
		dd('no existe proc FactCatalogoServiciosXcodigoSIS en V3');
		$query = "
			EXEC FactCatalogoServiciosXcodigoSIS :lcCodigo";

		$params = [
			'lcCodigo' => $lcCodigo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FactCatalogoServiciosSeleccionarPorCodigoOnombreTipo()
	{
		$query = "
			EXEC FactCatalogoServiciosSeleccionarPorCodigoOnombreTipoCatalogo :codigo, :nombre, :esCpt";

		$params = [
			'codigo' => lcCodigo, 
			'nombre' => lcNombre, 
			'esCpt' => EsCpt, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdEsParaReceta($oTabla)
	{
		$query = "
			EXEC ProductoEsParaOrdenesMedicas :idProducto";

		$params = [
			'idProducto' => $oTabla->idProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}