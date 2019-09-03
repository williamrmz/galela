<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxRegistroAnestesiologiaCab extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idRegistroAnestesiologiaCab AS Int = :idRegistroAnestesiologiaCab
			SET NOCOUNT ON 
			EXEC CQxRegistroAnestesiologiaCabAgregar @idRegistroAnestesiologiaCab OUTPUT, :idProgramacionSala, :idOrdenOperatoriaMQ, :idMedico, :idTiposDestinoOperacion, :idDiagnosticoPostOperatorio, :fecha, :hora, :observaciones, :nroRegistroAnestesiologia, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idRegistroAnestesiologiaCab AS idRegistroAnestesiologiaCab";

		$params = [
			'idRegistroAnestesiologiaCab' => 0, 
			'idProgramacionSala' => ($oTabla->idProgramacionSala == 0)? Null: $oTabla->idProgramacionSala, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idTiposDestinoOperacion' => ($oTabla->idTiposDestinoOperacion == 0)? Null: $oTabla->idTiposDestinoOperacion, 
			'idDiagnosticoPostOperatorio' => ($oTabla->idDiagnosticoPostOperatorio == 0)? Null: $oTabla->idDiagnosticoPostOperatorio, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'hora' => ($oTabla->hora == "")? Null: $oTabla->hora, 
			'observaciones' => ($oTabla->observaciones == "")? Null: $oTabla->observaciones, 
			'nroRegistroAnestesiologia' => $oTabla->nroRegistroAnestesiologia, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CQxRegistroAnestesiologiaCabModificar :idRegistroAnestesiologiaCab, :idDiagnosticoPostOperatorio, :observaciones, :idTiposDestinoOperacion, :idUsuarioAuditoria";

		$params = [
			'idRegistroAnestesiologiaCab' => ($oTabla->idRegistroAnestesiologiaCab == 0)? Null: $oTabla->idRegistroAnestesiologiaCab, 
			'idDiagnosticoPostOperatorio' => ($oTabla->idDiagnosticoPostOperatorio == 0)? Null: $oTabla->idDiagnosticoPostOperatorio, 
			'observaciones' => $oTabla->observaciones, 
			'idTiposDestinoOperacion' => $oTabla->idTiposDestinoOperacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CQxRegistroAnestesiologiaCabEliminar :idRegistroAnestesiologiaCab, :idUsuarioAuditoria";

		$params = [
			'idRegistroAnestesiologiaCab' => $oTabla->idRegistroAnestesiologiaCab, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxRegistroAnestesiologiaCabSeleccionarPorId :idRegistroAnestesiologiaCab";

		$params = [
			'idRegistroAnestesiologiaCab' => $oTabla->idRegistroAnestesiologiaCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdMQ($oTabla)
	{
		$query = "
			EXEC CQxRegistroDeAnestesiologiaListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $oTabla->idOrdenOperatoriaMQ, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarTipos($lnIdPaciente)
	{
		$query = "
			EXEC CQxRegistroDeAnestesiologiaListar :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $lnIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarProcedimientos($oTabla)
	{
		$query = "
			EXEC ListarProcdimientosRegistrodeAnestesiologia :idPs";

		$params = [
			'idPs' => $oTabla->idOrdenOperatoriaMQ, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarDiagnosticos($oTabla)
	{
		$query = "
			EXEC ListarDiagnosticosXOrdenOperatoriaMQ :idPs";

		$params = [
			'idPs' => $oTabla->idOrdenOperatoriaMQ, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Validar($id)
	{
		$query = "
			EXEC ValidarCQxRegistroAnestesiologiaCab :idProgramacionSala";

		$params = [
			'idProgramacionSala' => Id, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}