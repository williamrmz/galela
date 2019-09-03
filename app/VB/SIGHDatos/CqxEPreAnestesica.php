<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CqxEPreAnestesica extends Model
{
	public function Modificar($oTabla, $otabladet)
	{
		$query = "
			EXEC CQxEvaluacionPreAnestesicaCabAgregar :idProgramacionSala, :idOrdenOperatoriaMQ, :idMedico, :idAnestesiologo, :efectiva, :emergencia, :idServicio, :ultimaIngestaAlimientos, :indicaciones, :planAnestesico, :idUsuario, :estacion, :horaIngreso, :idExamenFisico, :valor, :idUsuario1, :estacion2";

		$params = [
			'idProgramacionSala' => ($oTabla->idProgramacionSala == 0)? Null: $oTabla->idProgramacionSala, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idMedico' => ($oTabla->idMedico == 0)? 0: $oTabla->idMedico, 
			'idAnestesiologo' => ($oTabla->idAnestesiologo == 0)? 0: $oTabla->idAnestesiologo, 
			'efectiva' => ($oTabla->efectiva == 0)? 0: $oTabla->efectiva, 
			'emergencia' => ($oTabla->emergencia == 0)? 0: $oTabla->emergencia, 
			'idServicio' => ($oTabla->idServicio == 0)? 0: $oTabla->idServicio, 
			'ultimaIngestaAlimientos' => ($oTabla->ultimaIngestaAlimientos == 0)? Null: $oTabla->ultimaIngestaAlimientos, 
			'indicaciones' => ($oTabla->indicaciones == "")? Null: $oTabla->indicaciones, 
			'planAnestesico' => ($oTabla->planAnestesico == "")? Null: $oTabla->planAnestesico, 
			'idUsuario' => ($oTabla->idUsuario == 0)? 0: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'horaIngreso' => ($oTabla->horaIngreso == "")? Null: $oTabla->horaIngreso, 
			'idExamenFisico' => ($otabladet->idExamenFisico == 0)? 0: $otabladet->idExamenFisico, 
			'valor' => ($otabladet->valor == "")? Null: $otabladet->valor, 
			'idUsuario1' => ($oTabla->idUsuario == 0)? 0: $otabladet->idUsuario, 
			'estacion2' => $otabladet->estacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Insertar($oTabla)
	{
		$query = "
			EXEC pa_CQxExamenFisicoDetAgregar :idProgramacionSala, :idUsuario, :estacion";

		$params = [
			'idProgramacionSala' => ($oTabla->idProgramacionSala == 0)? Null: $oTabla->idProgramacionSala, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			DECLARE @ IdExamenFisicoDet AS Int = : IdExamenFisicoDet
			SET NOCOUNT ON 
			EXEC pa_CQxExamenFisicoDetEliminar @ IdExamenFisicoDet OUTPUT, :idProgramacionSala
			SELECT @ IdExamenFisicoDet AS  IdExamenFisicoDet";

		$params = [
			' IdExamenFisicoDet' => 0, 
			'idProgramacionSala' => ($oTabla->idProgramacionSala == 0)? Null: $oTabla->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function CargarDatosEFisico($aDOAEFisicoDet)
	{
		$query = "
			EXEC Cqx_ExamenFisicoDetListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $aDOAEFisicoDet->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function CargarDatosEPreAnestesico($aDOEPreAnestesico)
	{
		$query = "
			EXEC Cq_EPreAnestesicaListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $aDOEPreAnestesico->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorPaciente($oTabla)
	{
		$query = "
			EXEC LabFacturacionServicioDespachoFiltraPorIdOrdenIdPuntoCarga :idOrden, :idPuntoCarga, :idMovimiento";

		$params = [
			'idOrden' => $oTabla->idOrden, 
			'idPuntoCarga' => $oTabla->idPuntoCarga, 
			'idMovimiento' => $oTabla->idMovimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarProductoxPaciente($oTabla)
	{
		$query = "
			EXEC Cqx_LabFacturacionServicioDespachoFiltraPorIdOrdenIdPuntoCarga :idPaciente";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Validar($id)
	{
		$query = "
			EXEC Cq_EPreAnestesicaListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => Id, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}