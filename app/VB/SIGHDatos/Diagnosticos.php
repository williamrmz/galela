<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Diagnosticos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idDiagnostico AS Int = :idDiagnostico
			SET NOCOUNT ON 
			EXEC DiagnosticosAgregar :intrahospitalario, @idDiagnostico OUTPUT, :descripcion, :codigoCIE9, :codigoCIE10, :codigoExportacion, :idTipoSexo, :morbilidad, :idCategoria, :restriccion, :edadMaxDias, :edadMinDias, :codigoCIE2004, :idCapitulo, :idGrupo, :gestacion, :descripcionMINSA, :codigoCIEsinPto, :fechaInicioVigencia, :esActivo, :idUsuarioAuditoria
			SELECT @idDiagnostico AS idDiagnostico";

		$params = [
			'intrahospitalario' => ($oTabla->intrahospitalario == 0)? Null: $oTabla->intrahospitalario, 
			'idDiagnostico' => 0, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigoCIE9' => ($oTabla->codigoCIE9 == "")? Null: $oTabla->codigoCIE9, 
			'codigoCIE10' => ($oTabla->codigoCIE10 == "")? Null: $oTabla->codigoCIE10, 
			'codigoExportacion' => ($oTabla->codigoExportacion == "")? Null: $oTabla->codigoExportacion, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'morbilidad' => ($oTabla->morbilidad == 0)? Null: $oTabla->morbilidad, 
			'idCategoria' => ($oTabla->idCategoria == 0)? Null: $oTabla->idCategoria, 
			'restriccion' => ($oTabla->restriccion == 0)? Null: $oTabla->restriccion, 
			'edadMaxDias' => ($oTabla->edadMaxDias == 0)? Null: $oTabla->edadMaxDias, 
			'edadMinDias' => ($oTabla->edadMinDias == 0)? Null: $oTabla->edadMinDias, 
			'codigoCIE2004' => ($oTabla->codigoCIE2004 == "")? Null: $oTabla->codigoCIE2004, 
			'idCapitulo' => ($oTabla->idCapitulo == 0)? Null: $oTabla->idCapitulo, 
			'idGrupo' => ($oTabla->idGrupo == 0)? Null: $oTabla->idGrupo, 
			'gestacion' => ($oTabla->gestacion == 0)? Null: $oTabla->gestacion, 
			'descripcionMINSA' => ($oTabla->descripcionMINSA == "")? Null: $oTabla->descripcionMINSA, 
			'codigoCIEsinPto' => ($oTabla->codigoCIEsinPto == "")? Null: $oTabla->codigoCIEsinPto, 
			'fechaInicioVigencia' => ($oTabla->fechaInicioVigencia == 0)? Null: $oTabla->fechaInicioVigencia, 
			'esActivo' => ($oTabla->esActivo == 0)? False: $oTabla->esActivo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC DiagnosticosModificar :intrahospitalario, :idDiagnostico, :descripcion, :codigoCIE9, :codigoCIE10, :codigoExportacion, :idTipoSexo, :morbilidad, :idCategoria, :restriccion, :edadMaxDias, :edadMinDias, :codigoCIE2004, :idCapitulo, :idGrupo, :gestacion, :descripcionMINSA, :codigoCIEsinPto, :fechaInicioVigencia, :esActivo, :idUsuarioAuditoria";

		$params = [
			'intrahospitalario' => ($oTabla->intrahospitalario == 0)? Null: $oTabla->intrahospitalario, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigoCIE9' => ($oTabla->codigoCIE9 == "")? Null: $oTabla->codigoCIE9, 
			'codigoCIE10' => ($oTabla->codigoCIE10 == "")? Null: $oTabla->codigoCIE10, 
			'codigoExportacion' => ($oTabla->codigoExportacion == "")? Null: $oTabla->codigoExportacion, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'morbilidad' => ($oTabla->morbilidad == 0)? Null: $oTabla->morbilidad, 
			'idCategoria' => ($oTabla->idCategoria == 0)? Null: $oTabla->idCategoria, 
			'restriccion' => ($oTabla->restriccion == 0)? Null: $oTabla->restriccion, 
			'edadMaxDias' => ($oTabla->edadMaxDias == 0)? Null: $oTabla->edadMaxDias, 
			'edadMinDias' => ($oTabla->edadMinDias == 0)? Null: $oTabla->edadMinDias, 
			'codigoCIE2004' => ($oTabla->codigoCIE2004 == "")? Null: $oTabla->codigoCIE2004, 
			'idCapitulo' => ($oTabla->idCapitulo == 0)? Null: $oTabla->idCapitulo, 
			'idGrupo' => ($oTabla->idGrupo == 0)? Null: $oTabla->idGrupo, 
			'gestacion' => ($oTabla->gestacion == 0)? Null: $oTabla->gestacion, 
			'descripcionMINSA' => ($oTabla->descripcionMINSA == "")? Null: $oTabla->descripcionMINSA, 
			'codigoCIEsinPto' => ($oTabla->codigoCIEsinPto == "")? Null: $oTabla->codigoCIEsinPto, 
			'fechaInicioVigencia' => ($oTabla->fechaInicioVigencia == 0)? Null: $oTabla->fechaInicioVigencia, 
			'esActivo' => ($oTabla->esActivo == 0)? False: $oTabla->esActivo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC DiagnosticosEliminar :idDiagnostico, :idUsuarioAuditoria";

		$params = [
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC DiagnosticosSeleccionarPorId :idDiagnostico";

		$params = [
			'idDiagnostico' => $oTabla->idDiagnostico, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC DiagnosticosSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oDoDiagnostico, $lbSoloMuestraDxGalenHos, $lbUSAcodigoCIEsinPto)
	{
		$query = "
			EXEC DiagnosticosFiltrar :lcFiltro, :lbUSAcodigoCIEsinPto";

		$params = [
			'lcFiltro' => sWhere, 
			'lbUSAcodigoCIEsinPto' => $lbUSAcodigoCIEsinPto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarSoloActivos($oDoDiagnostico, $lbSoloMuestraDxGalenHos, $lbUSAcodigoCIEsinPto)
	{
		$query = "
			EXEC DiagnosticosFiltrar :lcFiltro, :lbUSAcodigoCIEsinPto";

		$params = [
			'lcFiltro' => sWhere, 
			'lbUSAcodigoCIEsinPto' => $lbUSAcodigoCIEsinPto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigoCIE2004($oTabla, $lbSoloMuestraDxGalenHos)
	{
		$query = "
			EXEC DiagnosticosSeleccionarPorCodigoCIE2004 :codigoCIE2004, :lbSoloMuestraDxGalenHos";

		$params = [
			'codigoCIE2004' => $oTabla->codigoCIE2004, 
			'lbSoloMuestraDxGalenHos' => $lbSoloMuestraDxGalenHos, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function validarEliminar($oTabla)
	{
		$query = "
			EXEC DiagnosticosEliminarValidar :idDiagnostico";

		$params = [
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function FiltrarXIdOrdenOperatoria($lIdOrdenOperatoria)
	{
		$query = "
			EXEC SP_CQx_FiltrarPacienteXIdOrdenOperatoria :idOrdenOperatoria";

		$params = [
			'idOrdenOperatoria' => $lIdOrdenOperatoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarXIdOrdenOperatoriaMQ($lIdOrdenOperatoria)
	{
		$query = "
			EXEC SP_CQx_FiltrarPacienteXIdOrdenOperatoriaMQDiagnosticos :idOrdenOperatoriaMQ";

		$params = [
			'idOrdenOperatoriaMQ' => $lIdOrdenOperatoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarCPTXIdOrdenOperatoriaMQ($lIdOrdenOperatoria)
	{
		$query = "
			EXEC SP_CQx_FiltrarPacienteXIdOrdenOperatoriaMQCPT :idOrdenOperatoriaMQ";

		$params = [
			'idOrdenOperatoriaMQ' => $lIdOrdenOperatoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarXIdOrdenOperatoriaCPT($lIdOrdenOperatoria)
	{
		$query = "
			EXEC SP_CQx_FiltrarPacienteXIdOrdenOperatoriaCPT :idOrdenOperatoria";

		$params = [
			'idOrdenOperatoria' => $lIdOrdenOperatoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarCPTPostOperXIdOrdenOperatoriaMQ($lIdOrdenOperatoria)
	{
		$query = "
			EXEC pa_CQx_OrdenOperatoriaCPTMQPOListar :idOrdenOperatoriaMQ";

		$params = [
			'idOrdenOperatoriaMQ' => $lIdOrdenOperatoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarDiagnosticosQx()
	{
		$query = "
			EXEC FiltrarDiagnosticosQx ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarProcPreQx()
	{
		$query = "
			EXEC ListarProcedimientosCQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarPrioridad()
	{
		$query = "
			EXEC ListarTPrioridadCQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarTipoCirugia()
	{
		$query = "
			EXEC ListarTiposCirugiasCQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function InsertardiagnosticosQx($oTabla)
	{
		$query = "
			EXEC InsertarDetalleDiagnosticoCQ :idCuentaAtencion, :idDiagnostico, :idSubClasificacionDx";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idSubClasificacionDx' => ($oTabla->idSubClasificacionDX == 0)? Null: $oTabla->idSubClasificacionDX, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function InsertarProcedimientosQx($oTabla)
	{
		$query = "
			EXEC InsertarProcedimientosQx :idCuentaAtencion, :idProducto";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function InsertarTiposPrioridad($oTabla)
	{
		$query = "
			EXEC InsertarTiposPrioridad :idCuentaAtencion, :idPrioridad, :idTipoCirugia";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idPrioridad' => ($oTabla->idPrioridad == 0)? Null: $oTabla->idPrioridad, 
			'idTipoCirugia' => ($oTabla->idTipoCirugia == 0)? Null: $oTabla->idTipoCirugia, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarDiagnosticosQx($oTabla)
	{
		$query = "
			EXEC ListarDiagnosticosQx :idcuentaAtencion";

		$params = [
			'idcuentaAtencion' => $oTabla->idCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarProcedimientoQx($oTabla)
	{
		$query = "
			EXEC ListarProcedimientoQx :idcuentaAtencion";

		$params = [
			'idcuentaAtencion' => $oTabla->idCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarDiagnosticosQx($oTabla)
	{
		$query = "
			EXEC EliminarDiagnosticosQx :idCuentaAtencion, :idDiagnostico";

		$params = [
			'idCuentaAtencion' => $oTabla->idCuentaAtencion, 
			'idDiagnostico' => $oTabla->idDiagnostico, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function EliminarProcedimientoQx($oTabla)
	{
		$query = "
			EXEC EliminarProcedimientoQx :idCuentaAtencion, :idProducto";

		$params = [
			'idCuentaAtencion' => $oTabla->idCuentaAtencion, 
			'idProducto' => $oTabla->idProducto, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function RetornaIdEspecilidadXIdCuentaAtencion($ml_IdCuentaAtencion)
	{
		$query = "
			EXEC ListarEspecialidadXCuenta :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $ml_IdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarDiagnosticoProcedimientoCirugia($oTabla)
	{
		$query = "
			EXEC EliminarDiagnosticoProcedimientoCirugia :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $oTabla->idCuentaAtencion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function ListarDetallePrioridadTipoCirugiaXIdCuentaAtencion($ml_idAtencion)
	{
		$query = "
			EXEC ListarDetallePrioridadTipoCirugiaXIdCuentaAtencion :idAtencion";

		$params = [
			'idAtencion' => $ml_idAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}