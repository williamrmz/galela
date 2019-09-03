<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxProgramacionSala extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC CQxProgramacionSalaAgregar :fecha, :horaIngreso, :horaSalida, :idOrdenOperatoriaMQ, :idPaciente, :idServicio, :idUsuario, :estacion, :idUsuarioAuditoria";

		$params = [
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'horaIngreso' => ($oTabla->horaIngreso == "")? Null: $oTabla->horaIngreso, 
			'horaSalida' => ($oTabla->horaSalida == "")? Null: $oTabla->horaSalida, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CQxProgramacionSalaModificar :idProgramacionSala, :fecha, :horaIngreso, :horaSalida, :idOrdenOperatoriaMQ, :idPaciente, :idEstadoSalaOperacion, :idServicio, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idProgramacionSala' => ($oTabla->idProgramacionSala == 0)? Null: $oTabla->idProgramacionSala, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'horaIngreso' => ($oTabla->horaIngreso == "")? Null: $oTabla->horaIngreso, 
			'horaSalida' => ($oTabla->horaSalida == "")? Null: $oTabla->horaSalida, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idEstadoSalaOperacion' => ($oTabla->idEstadoSalaOperacion == 0)? Null: $oTabla->idEstadoSalaOperacion, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CQxProgramacionSalaEliminar :idProgramacionSala, :idUsuarioAuditoria";

		$params = [
			'idProgramacionSala' => $oTabla->idProgramacionSala, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxProgramacionSalaSeleccionarPorId :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $oTabla->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SalaSeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxProgramacionSalaListarSala :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $oTabla->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTreeView($oTabla)
	{
		$query = "
			EXEC CQxProgramacionSalaSeleccionarTreeView :idOrdenOperatoriaMQ";

		$params = [
			'idOrdenOperatoriaMQ' => $oTabla->idOrdenOperatoriaMQ, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ProgramacionSalaSeleccionarID($oDOProg)
	{
		$query = "
			EXEC pa_CQxProgramacionSalaSeleccionarPorID :idProgramacion";

		$params = [
			'idProgramacion' => $oDOProg->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarEpicrisis($oTabla)
	{
		$query = "
			EXEC CQxProgramacionSalaSelEpicrisis :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $oTabla->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarPorAprobar($oDOCQxOrdenOperatoriaMQ)
	{
		$query = "
			EXEC CQxProgramacionSalaFiltrarPorAprobar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarAprobados($oDOCQxOrdenOperatoriaMQ)
	{
		$query = "
			EXEC CQxProgramacionSalaFiltrarPorAprobar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AprobarPacienteCQx($oTabla)
	{
		$query = "
			EXEC Aprobar_CCQxProgramacionSala :id";

		$params = [
			'id' => ($oTabla->idProgramacionSala == 0)? Null: $oTabla->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RevertirPacienteCQx($oTabla)
	{
		$query = "
			EXEC RevertirAprobacion_CCQxProgramacionSala :id";

		$params = [
			'id' => ($oTabla->idProgramacionSala == 0)? Null: $oTabla->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}