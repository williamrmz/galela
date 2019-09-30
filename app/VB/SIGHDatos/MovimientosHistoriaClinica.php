<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class MovimientosHistoriaClinica extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idMovimiento AS Int = :idMovimiento
			SET NOCOUNT ON 
			EXEC MovimientosHistoriaClinicaAgregar :nroFolios, :idServicioDestino, :idServicioOrigen, :observacion, :idMotivo, :fechaMovimiento, :idPaciente, @idMovimiento OUTPUT, :idEmpleadoRecepcion, :idEmpleadoTransporte, :idEmpleadoArchivo, :idGrupoMovimiento, :idUsuarioAuditoria, :idAtencion
			SELECT @idMovimiento AS idMovimiento";

		$params = [
			'nroFolios' => ($oTabla->nroFolios == 0)? Null: $oTabla->nroFolios, 
			'idServicioDestino' => ($oTabla->idServicioDestino == 0)? Null: $oTabla->idServicioDestino, 
			'idServicioOrigen' => ($oTabla->idServicioOrigen == 0)? Null: $oTabla->idServicioOrigen, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'idMotivo' => ($oTabla->idMotivo == 0)? Null: $oTabla->idMotivo, 
			'fechaMovimiento' => ($oTabla->fechaMovimiento == 0)? Null: $oTabla->fechaMovimiento, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idMovimiento' => 0, 
			'idEmpleadoRecepcion' => ($oTabla->idEmpleadoRecepcion == 0)? Null: $oTabla->idEmpleadoRecepcion, 
			'idEmpleadoTransporte' => ($oTabla->idEmpleadoTransporte == 0)? Null: $oTabla->idEmpleadoTransporte, 
			'idEmpleadoArchivo' => ($oTabla->idEmpleadoArchivo == 0)? Null: $oTabla->idEmpleadoArchivo, 
			'idGrupoMovimiento' => ($oTabla->idGrupoMovimiento == 0)? Null: $oTabla->idGrupoMovimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC MovimientosHistoriaClinicaModificar :nroFolios, :idServicioDestino, :idServicioOrigen, :observacion, :idMotivo, :fechaMovimiento, :idPaciente, :idMovimiento, :idEmpleadoRecepcion, :idEmpleadoTransporte, :idEmpleadoArchivo, :idGrupoMovimiento, :idUsuarioAuditoria, :idAtencion";

		$params = [
			'nroFolios' => ($oTabla->nroFolios == 0)? Null: $oTabla->nroFolios, 
			'idServicioDestino' => ($oTabla->idServicioDestino == 0)? Null: $oTabla->idServicioDestino, 
			'idServicioOrigen' => ($oTabla->idServicioOrigen == 0)? Null: $oTabla->idServicioOrigen, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'idMotivo' => ($oTabla->idMotivo == 0)? Null: $oTabla->idMotivo, 
			'fechaMovimiento' => ($oTabla->fechaMovimiento == 0)? Null: $oTabla->fechaMovimiento, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'idEmpleadoRecepcion' => ($oTabla->idEmpleadoRecepcion == 0)? Null: $oTabla->idEmpleadoRecepcion, 
			'idEmpleadoTransporte' => ($oTabla->idEmpleadoTransporte == 0)? Null: $oTabla->idEmpleadoTransporte, 
			'idEmpleadoArchivo' => ($oTabla->idEmpleadoArchivo == 0)? Null: $oTabla->idEmpleadoArchivo, 
			'idGrupoMovimiento' => ($oTabla->idGrupoMovimiento == 0)? Null: $oTabla->idGrupoMovimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC MovimientosHistoriaClinicaEliminar :idMovimiento, :idUsuarioAuditoria";

		$params = [
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC MovimientosHistoriaClinicaSeleccionarPorId :idMovimiento";

		$params = [
			'idMovimiento' => $oTabla->idMovimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AgregarVarios($oMovimiento, $rsMovimientos)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ModificarVarios($oMovimiento, $rsMovimientos)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarVarios($rsMovimientos)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oDOPaciente, $oDOHistoria)
	{
		$query = "
			EXEC MovimientosHistoriaClinicaFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function UltimaUbicacionDeHistoria($lIdPaciente)
	{
		$query = "
			DECLARE @idServicio AS Int = :idServicio
			SET NOCOUNT ON 
			EXEC MovimientosHistoriaClinicaUltimaUbicacion :idPaciente, @idServicio OUTPUT
			SELECT @idServicio AS idServicio";

		$params = [
			'idPaciente' => ($lIdPaciente == 0)? Null: $lIdPaciente, 
			'idServicio' => 0, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function MovimientosHistoriasClinicasPorIdGrupo($lIdGrupo)
	{
		$query = "
			EXEC MovimientosHistoriasClinicasPorIdGrupo :idGrupo";

		$params = [
			'idGrupo' => $lIdGrupo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function MovimientosHistoriasClinicasDetallePorIdPaciente($lIdPaciente)
	{
		$query = "
			EXEC MovimientosHistoriasClinicasDetallePorIdPaciente :idGrupo";

		$params = [
			'idGrupo' => $lIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EsUltimoMovimiento($lIdPaciente, $lIdMovimiento)
	{
		$query = "
			DECLARE @esUltimo AS Int = :esUltimo
			SET NOCOUNT ON 
			EXEC MovimientosHistoriaClinicaEsUltimoMovimiento :idPaciente, :idMovimiento, @esUltimo OUTPUT
			SELECT @esUltimo AS esUltimo";

		$params = [
			'idPaciente' => ($lIdPaciente == 0)? Null: $lIdPaciente, 
			'idMovimiento' => ($lIdMovimiento == 0)? Null: $lIdMovimiento, 
			'esUltimo' => 0, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function MovimientosHistoriasClinicasParaDevolverPorNroHistoria()
	{
		dd( 'not found');
		// $query = "
		// 	EXEC MovimientosHistoriaClinicaParaDevolver2 :lIdUsuario, :sFechaMovimiento, :lIdServiciodestino, :lnIdPacienteSolo, :idPaciente, :idMovimiento, :lIdUsuario, :lcFiltro, :lnIdArchivoClinico, :lcParametro231, :lIdUsuario";

		// $params = [
		// 	'lIdUsuario' => lIdUsuario, 
		// 	'sFechaMovimiento' => CDate(sFechaMovimiento), 
		// 	'lIdServiciodestino' => lIdServiciodestino, 
		// 	'lnIdPacienteSolo' => lnIdPacienteSolo, 
		// 	'idPaciente' => rsPaciente!IdPaciente, 
		// 	'idMovimiento' => rsMaxMov!IdMovimiento, 
		// 	'lIdUsuario' => lIdUsuario, 
		// 	'lcFiltro' => sSql, 
		// 	'lnIdArchivoClinico' => lnIdArchivoClinico, 
		// 	'lcParametro231' => lcParametro231, 
		// 	'lIdUsuario' => lIdUsuario, 
		// ];

		// $data = \DB::select($query, $params);

		// return $data;
	}

	public function MovimientosHistoriasClinicasParaDevolverPorServicio()
	{
		dd( 'not work');
		// $query = "
		// 	EXEC MovimientosHistoriaClinicaParaDevolver3 :lIdUsuario, :sFechaMovimiento, :lIdServiciodestino, :lnIdPacienteSolo, :idPaciente, :idMovimiento, :lIdUsuario, :lcFiltro, :lnIdArchivoClinico, :lcParametro231, :lIdUsuario";

		// $params = [
		// 	'lIdUsuario' => lIdUsuario, 
		// 	'sFechaMovimiento' => CDate(sFechaMovimiento), 
		// 	'lIdServiciodestino' => lIdServiciodestino, 
		// 	'lnIdPacienteSolo' => lnIdPacienteSolo, 
		// 	'idPaciente' => rsPaciente!IdPaciente, 
		// 	'idMovimiento' => rsMaxMov!IdMovimiento, 
		// 	'lIdUsuario' => lIdUsuario, 
		// 	'lcFiltro' => sSql, 
		// 	'lnIdArchivoClinico' => lnIdArchivoClinico, 
		// 	'lcParametro231' => lcParametro231, 
		// 	'lIdUsuario' => lIdUsuario, 
		// ];

		// $data = \DB::select($query, $params);

		return $data;
	}

	public function MovimientosHistoriasClinicasParaDevolver2()
	{
		dd( 'dont work');
		// $query = "
		// 	EXEC MovimientosHistoriaClinicaParaDevolver2 :lIdUsuario, :sFechaMovimiento, :lIdServiciodestino, :lnIdPacienteSolo, :idPaciente, :idMovimiento, :lIdUsuario, :lcFiltro, :lnIdArchivoClinico, :lcParametro231, :lIdUsuario";

		// $params = [
		// 	'lIdUsuario' => lIdUsuario, 
		// 	'sFechaMovimiento' => CDate(sFechaMovimiento), 
		// 	'lIdServiciodestino' => lIdServiciodestino, 
		// 	'lnIdPacienteSolo' => lnIdPacienteSolo, 
		// 	'idPaciente' => rsPaciente!IdPaciente, 
		// 	'idMovimiento' => rsMaxMov!IdMovimiento, 
		// 	'lIdUsuario' => lIdUsuario, 
		// 	'lcFiltro' => sSql, 
		// 	'lnIdArchivoClinico' => lnIdArchivoClinico, 
		// 	'lcParametro231' => lcParametro231, 
		// 	'lIdUsuario' => lIdUsuario, 
		// ];

		// $data = \DB::select($query, $params);

		// return $data;
	}

	public function MovimientosHistoriasClinicasParaDevolver($lIdServiciodestino, $sFechaMovimiento, $lIdUsuario)
	{
		$query = "
			EXEC MovimientosHistoriasClinicasParaDevolver :idServiciodestino, :fechaMovimiento, :idUsuario";

		$params = [
			'idServiciodestino' => $lIdServiciodestino, 
			'fechaMovimiento' => $sFechaMovimiento, 
			'idUsuario' => $lIdUsuario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function MovimientosHistoriaClinicaEliminarMovIdPaciente($oTabla)
	{
		$query = "
			EXEC MovimientosHistoriaClinicaEliminarMovIdPaciente :idMovimiento, :idPaciente";

		$params = [
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'idPaciente' => $oTabla->idPaciente, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}