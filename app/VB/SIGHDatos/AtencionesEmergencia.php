<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionesEmergencia extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAtencionEmergencia AS Int = :idAtencionEmergencia
			SET NOCOUNT ON 
			EXEC AtencionesEmergenciaAgregar :idTipoAgenteAGAN, :idGrupoOcupacionalALAB, :idPosicionLesionadoALAB, :idUbicacionLesionado, :idTipoTransporte, :idTipoVehiculo, :idClaseAccidente, :idRelacionAgresorVictima, :idSeguridad, :idTipoEvento, :idLugarEvento, :idCausaExternaMorbilidad, :idAtencion, @idAtencionEmergencia OUTPUT, :motivo, :tE, :relato, :antecedentes, :eFGeneral, :eFRespiratorio, :eFCardiovascular, :eFAbdomen, :eFNeurologico, :eFGenitourinario, :eFLocomotor, :otros, :evolucion
			SELECT @idAtencionEmergencia AS idAtencionEmergencia";

		$params = [
			'idTipoAgenteAGAN' => ($oTabla->idTipoAgenteAGAN == 0)? Null: $oTabla->idTipoAgenteAGAN, 
			'idGrupoOcupacionalALAB' => ($oTabla->idGrupoOcupacionalALAB == 0)? Null: $oTabla->idGrupoOcupacionalALAB, 
			'idPosicionLesionadoALAB' => ($oTabla->idPosicionLesionadoALAB == 0)? Null: $oTabla->idPosicionLesionadoALAB, 
			'idUbicacionLesionado' => ($oTabla->idUbicacionLesionado == 0)? Null: $oTabla->idUbicacionLesionado, 
			'idTipoTransporte' => ($oTabla->idTipoTransporte == 0)? Null: $oTabla->idTipoTransporte, 
			'idTipoVehiculo' => ($oTabla->idTipoVehiculo == 0)? Null: $oTabla->idTipoVehiculo, 
			'idClaseAccidente' => ($oTabla->idClaseAccidente == 0)? Null: $oTabla->idClaseAccidente, 
			'idRelacionAgresorVictima' => ($oTabla->idRelacionAgresorVictima == 0)? Null: $oTabla->idRelacionAgresorVictima, 
			'idSeguridad' => ($oTabla->idSeguridad == 0)? Null: $oTabla->idSeguridad, 
			'idTipoEvento' => ($oTabla->idTipoEvento == 0)? Null: $oTabla->idTipoEvento, 
			'idLugarEvento' => ($oTabla->idLugarEvento == 0)? Null: $oTabla->idLugarEvento, 
			'idCausaExternaMorbilidad' => ($oTabla->idCausaExternaMorbilidad == 0)? Null: $oTabla->idCausaExternaMorbilidad, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idAtencionEmergencia' => 0, 
			'motivo' => ($oTabla->motivoConsulta == "")? Null: $oTabla->motivoConsulta, 
			'tE' => ($oTabla->tiempoEnfermedad == "")? Null: $oTabla->tiempoEnfermedad, 
			'relato' => ($oTabla->relato == "")? Null: $oTabla->relato, 
			'antecedentes' => ($oTabla->antecedentes == "")? Null: $oTabla->antecedentes, 
			'eFGeneral' => ($oTabla->antecedentes == "")? Null: $oTabla->eFGeneral, 
			'eFRespiratorio' => ($oTabla->eFRespiratorio == "")? Null: $oTabla->eFRespiratorio, 
			'eFCardiovascular' => ($oTabla->eFCardiovascular == "")? Null: $oTabla->eFCardiovascular, 
			'eFAbdomen' => ($oTabla->eFAbdomen == "")? Null: $oTabla->eFAbdomen, 
			'eFNeurologico' => ($oTabla->eFNeurologico == "")? Null: $oTabla->eFNeurologico, 
			'eFGenitourinario' => ($oTabla->eFGenitorurinario == "")? Null: $oTabla->eFGenitorurinario, 
			'eFLocomotor' => ($oTabla->eFLocomotor == "")? Null: $oTabla->eFLocomotor, 
			'otros' => ($oTabla->eFOtros == "")? Null: $oTabla->eFOtros, 
			'evolucion' => ($oTabla->evolucion == "")? Null: $oTabla->evolucion, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionesEmergenciaModificar :idTipoAgenteAGAN, :idGrupoOcupacionalALAB, :idPosicionLesionadoALAB, :idUbicacionLesionado, :idTipoTransporte, :idTipoVehiculo, :idClaseAccidente, :idRelacionAgresorVictima, :idSeguridad, :idTipoEvento, :idLugarEvento, :idCausaExternaMorbilidad, :idAtencion, :idAtencionEmergencia, :idUsuarioAuditoria, :motivo, :tE, :relato, :antecedentes, :eFGeneral, :eFRespiratorio, :eFCardiovascular, :eFAbdomen, :eFNeurologico, :eFGenitourinario, :eFLocomotor, :otros, :evolucion";

		$params = [
			'idTipoAgenteAGAN' => ($oTabla->idTipoAgenteAGAN == 0)? Null: $oTabla->idTipoAgenteAGAN, 
			'idGrupoOcupacionalALAB' => ($oTabla->idGrupoOcupacionalALAB == 0)? Null: $oTabla->idGrupoOcupacionalALAB, 
			'idPosicionLesionadoALAB' => ($oTabla->idPosicionLesionadoALAB == 0)? Null: $oTabla->idPosicionLesionadoALAB, 
			'idUbicacionLesionado' => ($oTabla->idUbicacionLesionado == 0)? Null: $oTabla->idUbicacionLesionado, 
			'idTipoTransporte' => ($oTabla->idTipoTransporte == 0)? Null: $oTabla->idTipoTransporte, 
			'idTipoVehiculo' => ($oTabla->idTipoVehiculo == 0)? Null: $oTabla->idTipoVehiculo, 
			'idClaseAccidente' => ($oTabla->idClaseAccidente == 0)? Null: $oTabla->idClaseAccidente, 
			'idRelacionAgresorVictima' => ($oTabla->idRelacionAgresorVictima == 0)? Null: $oTabla->idRelacionAgresorVictima, 
			'idSeguridad' => ($oTabla->idSeguridad == 0)? Null: $oTabla->idSeguridad, 
			'idTipoEvento' => ($oTabla->idTipoEvento == 0)? Null: $oTabla->idTipoEvento, 
			'idLugarEvento' => ($oTabla->idLugarEvento == 0)? Null: $oTabla->idLugarEvento, 
			'idCausaExternaMorbilidad' => ($oTabla->idCausaExternaMorbilidad == 0)? Null: $oTabla->idCausaExternaMorbilidad, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idAtencionEmergencia' => ($oTabla->idAtencionEmergencia == 0)? Null: $oTabla->idAtencionEmergencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'motivo' => ($oTabla->motivoConsulta == "")? Null: $oTabla->motivoConsulta, 
			'tE' => ($oTabla->tiempoEnfermedad == "")? Null: $oTabla->tiempoEnfermedad, 
			'relato' => ($oTabla->relato == "")? Null: $oTabla->relato, 
			'antecedentes' => ($oTabla->antecedentes == "")? Null: $oTabla->antecedentes, 
			'eFGeneral' => ($oTabla->eFGeneral == "")? Null: $oTabla->eFGeneral, 
			'eFRespiratorio' => ($oTabla->eFRespiratorio == "")? Null: $oTabla->eFRespiratorio, 
			'eFCardiovascular' => ($oTabla->eFCardiovascular == "")? Null: $oTabla->eFCardiovascular, 
			'eFAbdomen' => ($oTabla->eFAbdomen == "")? Null: $oTabla->eFAbdomen, 
			'eFNeurologico' => ($oTabla->eFNeurologico == "")? Null: $oTabla->eFNeurologico, 
			'eFGenitourinario' => ($oTabla->eFGenitorurinario == "")? Null: $oTabla->eFGenitorurinario, 
			'eFLocomotor' => ($oTabla->eFLocomotor == "")? Null: $oTabla->eFLocomotor, 
			'otros' => ($oTabla->eFOtros == "")? Null: $oTabla->eFOtros, 
			'evolucion' => ($oTabla->evolucion == "")? Null: $oTabla->evolucion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionesEmergenciaEliminar :idAtencionEmergencia, :idUsuarioAuditoria";

		$params = [
			'idAtencionEmergencia' => ($oTabla->idAtencionEmergencia == 0)? Null: $oTabla->idAtencionEmergencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionesEmergenciaSeleccionarPorId :idAtencionEmergencia";

		$params = [
			'idAtencionEmergencia' => $oTabla->idAtencionEmergencia, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function CausaExternaMorbilidadSeleccionarTodos()
	{
		$query = "
			EXEC EmergenciaCausaExternaMorbilidadSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ClaseAccidenteSeleccionarTodos()
	{
		$query = "
			EXEC EmergenciaClaseAccidenteSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function GrupoOcupacionalALABSeleccionarTodos()
	{
		$query = "
			EXEC EmergenciaGrupoOcupacionalALABSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function LugarEventoSeleccionarTodos()
	{
		$query = "
			EXEC EmergenciaLugarEventoSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function PosicionLesionadoALABSeleccionarTodos()
	{
		$query = "
			EXEC EmergenciaPosicionLesionadoALABSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RelacionAgresorVictimaSeleccionarTodos()
	{
		$query = "
			EXEC EmergenciaRelacionAgresorVictimaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeguridadSeleccionarTodos()
	{
		$query = "
			EXEC EmergenciaSeguridadSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function TipoAgenteAGANSeleccionarTodos()
	{
		$query = "
			EXEC EmergenciaTipoAgenteAGANSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function TipoEventoSeleccionarTodos()
	{
		$query = "
			EXEC EmergenciaTipoEventoSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function TipoTransporteSeleccionarTodos()
	{
		$query = "
			EXEC EmergenciaTipoTransporteSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function TipoVehiculoSeleccionarTodos()
	{
		$query = "
			EXEC EmergenciaTipoVehiculoSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function UbicacionLesionadoSeleccionarTodos()
	{
		$query = "
			EXEC EmergenciaUbicacionLesionadoSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarIdPorIdAtencion($lIdAtencion)
	{
		$query = "
			DECLARE @idAtencionEmergencia AS Int = :idAtencionEmergencia
			SET NOCOUNT ON 
			EXEC AtencionesEmergenciaSeleccionarIdPorIdAtencion :idAtencion, @idAtencionEmergencia OUTPUT
			SELECT @idAtencionEmergencia AS idAtencionEmergencia";

		$params = [
			'idAtencion' => $lIdAtencion, 
			'idAtencionEmergencia' => 0, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function EliminarAtencionEmergenciaPorIdAtencion($lIdAtencion)
	{
		$query = "
			EXEC AtencionesEmergenciaEliminarXidAtencion :lIdAtencion";

		$params = [
			'lIdAtencion' => $lIdAtencion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}