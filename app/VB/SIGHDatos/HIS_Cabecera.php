<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_Cabecera extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idHisCabecera AS Int = :idHisCabecera
			SET NOCOUNT ON 
			EXEC HIS_CabeceraAgregar @idHisCabecera OUTPUT, :idHisLote, :nroHojaHis, :nroFormato, :idTurno, :idUsuario, :idEstadoHis, :idMedico, :idEstablecimiento, :idServicio, :fechaCreacion, :idUsuarioAuditoria
			SELECT @idHisCabecera AS idHisCabecera";

		$params = [
			'idHisCabecera' => 0, 
			'idHisLote' => ($oTabla->idHisLote == 0)? Null: $oTabla->idHisLote, 
			'nroHojaHis' => ($oTabla->nroHojaHis == 0)? Null: $oTabla->nroHojaHis, 
			'nroFormato' => $oTabla->nroFormato, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idEstadoHis' => ($oTabla->idEstadoHis == 0)? Null: $oTabla->idEstadoHis, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC HIS_CabeceraModificar :idHisCabecera, :idHisLote, :nroHojaHis, :nroFormato, :idTurno, :idUsuario, :idEstadoHis, :idMedico, :idEstablecimiento, :idServicio, :fechaCreacion, :idUsuarioAuditoria";

		$params = [
			'idHisCabecera' => ($oTabla->idHisCabecera == 0)? Null: $oTabla->idHisCabecera, 
			'idHisLote' => ($oTabla->idHisLote == 0)? Null: $oTabla->idHisLote, 
			'nroHojaHis' => ($oTabla->nroHojaHis == 0)? Null: $oTabla->nroHojaHis, 
			'nroFormato' => $oTabla->nroFormato, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idEstadoHis' => ($oTabla->idEstadoHis == 0)? Null: $oTabla->idEstadoHis, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC HIS_CabeceraEliminar :idHisCabecera, :idUsuarioAuditoria";

		$params = [
			'idHisCabecera' => $oTabla->idHisCabecera, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_CabeceraSeleccionarPorId :idHisCabecera";

		$params = [
			'idHisCabecera' => $oTabla->idHisCabecera, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosEstablecimientoPorUsuario($ml_idUsuario)
	{
		$query = "
			EXEC EmpleadosObtenerDatosEstablecimientoPorUsuario :ml_idUsuario";

		$params = [
			'ml_idUsuario' => $ml_idUsuario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosDigitador($ml_idUsuario)
	{
		$query = "
			EXEC EmpleadosObtenerDatosDigitador :ml_idUsuario";

		$params = [
			'ml_idUsuario' => $ml_idUsuario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosNroFormatoLibre($mi_anio, $ml_IdEstablecimientoActual)
	{
		$query = "
			EXEC his_cabeceraObtenerDatosNroFormatoLibre :mi_anio, :ml_IdEstablecimientoActual";

		$params = [
			'mi_anio' => $mi_anio, 
			'ml_IdEstablecimientoActual' => $ml_IdEstablecimientoActual, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ConsultarRegistroFiltroAtenciones($idEstablecimiento, $nombreLote, $anio, $idMes)
	{
		$query = "
			EXEC HIS_LotesConsultarRegistroFiltroAtenciones :anio, :idMes, :idEstablecimiento, :nombreLote";

		$params = [
			'anio' => Val(Anio), 
			'idMes' => IdMes, 
			'idEstablecimiento' => IdEstablecimiento, 
			'nombreLote' => NombreLote, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerListaMedicosMR($idEpecialidad)
	{
		$query = "
			EXEC EmpleadosObtenerListaMedicosMR :idEpecialidad";

		$params = [
			'idEpecialidad' => IdEpecialidad, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListaTiposDocumentos()
	{
		$query = "
			EXEC TiposDocIdentidadFiltrarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListaFuentesFinanciamiento()
	{
		$query = "
			EXEC His_FuentesFinanciamiento ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListaEtnias()
	{
		$query = "
			EXEC his_tabetniaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListaGeneros()
	{
		$query = "
			EXEC HIS_TiposSexo ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListaEstadosPaciente()
	{
		$query = "
			EXEC HIS_TiposCondicionPaciente ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListaPaises()
	{
		$query = "
			EXEC PaisesFiltrarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListaPaisesPorCodigoNombre($codigo, $nombre)
	{
		$query = "
			EXEC ListaPaisesPorCodigoNombre :codigo, :nombre";

		$params = [
			'codigo' => UCase($codigo), 
			'nombre' => UCase($nombre), 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerListaCodigosProductosHisPorCodigoyNombre($codigodiagcpt, $descripciondiagcpt)
	{
		$query = "
			EXEC HIS_ObtenerProductosHisPorCodigoyNombre :codigodiagcpt, :descripciondiagcpt";

		$params = [
			'codigodiagcpt' => CStr($codigodiagcpt), 
			'descripciondiagcpt' => $descripciondiagcpt, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosPais($idPais)
	{
		$query = "
			EXEC PaisesSeleccionarPorId :idPais";

		$params = [
			'idPais' => IdPais, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function His_ObtenerIdPaisPorCodNac($codigo)
	{
		$query = "
			EXEC His_ObtenerIdPaisPorCodNac :codigo";

		$params = [
			'codigo' => $codigo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ExisteHoja($oTabla)
	{
		$query = "
			EXEC his_cabeceraSeleccionarXnroHojaHIS :idHisLote, :nroHojaHis";

		$params = [
			'idHisLote' => $oTabla->idHisLote, 
			'nroHojaHis' => $oTabla->nroHojaHis, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}