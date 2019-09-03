<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Medicos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idMedico AS Int = :idMedico
			SET NOCOUNT ON 
			EXEC MedicosAgregar :idEmpleado, :colegiatura, @idMedico OUTPUT, :loteHis, :idColegioHIS, :rne, :egresado, :idUsuarioAuditoria
			SELECT @idMedico AS idMedico";

		$params = [
			'idEmpleado' => $oTabla->idEmpleado, 
			'colegiatura' => $oTabla->colegiatura, 
			'idMedico' => 0, 
			'loteHis' => ($oTabla->loteHis == "")? Null: $oTabla->loteHis, 
			'idColegioHIS' => ($oTabla->idColegioHis == "")? Null: $oTabla->idColegioHis, 
			'rne' => ($oTabla->rne == "")? Null: $oTabla->rne, 
			'egresado' => ($oTabla->egresado == True)? 1: 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC MedicosModificar :idEmpleado, :colegiatura, :idMedico, :loteHis, :idColegioHIS, :rne, :egresado, :idUsuarioAuditoria";

		$params = [
			'idEmpleado' => $oTabla->idEmpleado, 
			'colegiatura' => $oTabla->colegiatura, 
			'idMedico' => $oTabla->idMedico, 
			'loteHis' => ($oTabla->loteHis == "")? Null: $oTabla->loteHis, 
			'idColegioHIS' => ($oTabla->idColegioHis == "")? Null: $oTabla->idColegioHis, 
			'rne' => ($oTabla->rne == "")? Null: $oTabla->rne, 
			'egresado' => ($oTabla->egresado == True)? 1: 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC MedicosEliminar :idMedico, :idUsuarioAuditoria";

		$params = [
			'idMedico' => $oTabla->idMedico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC MedicosSeleccionarPorId :idMedico";

		$params = [
			'idMedico' => $oTabla->idMedico, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigo($oDOMedico, $oDOEmpleado)
	{
		$query = "
			EXEC MedicosXcodigoPlanilla :codigoPlanilla";

		$params = [
			'codigoPlanilla' => $oDOEmpleado->codigoPlanilla, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC MedicosSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarPorDptosYEspecialidadEsActivo($idDepartamento, $idEspecialidad)
	{
		$query = "
			EXEC MedicosPorFiltro :lcFiltro";

		$params = [
			'lcFiltro' => lcSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarPorDptosYEspecialidadEsActivoConEspecialidad($idDepartamento, $idEspecialidad)
	{
		$query = "
			EXEC MedicosPorFiltroConEspecialidad :lcFiltro";

		$params = [
			'lcFiltro' => lcSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarEspecialidadCE()
	{
		$query = "
			EXEC Listaespecialidades ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarPorProgramacion($idDepartamento, $idEspecialidad, $lnIdservicio, $daFecha)
	{
		$query = "
			EXEC MedicosFiltrarPorProgramacion :lcFiltro";

		$params = [
			'lcFiltro' => lcSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarPorProgramacion1($idEspecialidad, $lnIdservicio, $daFecha)
	{
		$query = "
			EXEC MedicosFiltrarPorProgramacion1 :idespecialidad";

		$params = [
			'idespecialidad' => IdEspecialidad, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oDOMedico, $oDOEmpleado, $lIdEspecialidad)
	{
		$query = "
			EXEC MedicosFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar1($oDOMedico, $oDOEmpleado, $lIdEspecialidad)
	{
		$query = "
			EXEC MedicosFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDepartamento($idMedico)
	{
		$query = "
			DECLARE @idDepartamento AS Int = :idDepartamento
			SET NOCOUNT ON 
			EXEC MedicosObtenerDepartamento :idMedico, @idDepartamento OUTPUT
			SELECT @idDepartamento AS idDepartamento";

		$params = [
			'idMedico' => IdMedico, 
			'idDepartamento' => 0, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function FiltrarPorDptosYEspecialidad($idDepartamento, $idEspecialidad)
	{
		$query = "
			EXEC MedicosPorFiltro :lcFiltro";

		$params = [
			'lcFiltro' => lcSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdEmpleado($oTabla)
	{
		$query = "
			EXEC MedicosXidEmpleado :idEmpleado";

		$params = [
			'idEmpleado' => $oTabla->idEmpleado, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}