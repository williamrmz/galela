<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxOrdenOperatoria extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idOrdenOperatoria AS Int = :idOrdenOperatoria
			SET NOCOUNT ON 
			EXEC CQxOrdenOperatoriaAgregar @idOrdenOperatoria OUTPUT, :idPaciente, :idUsuarioAuditoria, :nroOp
			SELECT @idOrdenOperatoria AS idOrdenOperatoria";

		$params = [
			'idOrdenOperatoria' => 0, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'nroOp' => ($oTabla->nroOrdenOperatoria == "")? Null: $oTabla->nroOrdenOperatoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CQxOrdenOperatoriaModificar :idOrdenOperatoria, :idMedico, :idGravedad, :idServicio, :fechaEstimadaQx, :observacion, :idUsuario, :estacion, :idUsuarioAuditoria";

		$params = [
			'idOrdenOperatoria' => ($oTabla->idOrdenOperatoria == 0)? Null: $oTabla->idOrdenOperatoria, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idGravedad' => ($oTabla->idGravedad == 0)? Null: $oTabla->idGravedad, 
			'idServicio' => ($oTabla->idServicioIngreso == 0)? Null: $oTabla->idServicioIngreso, 
			'fechaEstimadaQx' => ($oTabla->fechaEstimadaQx == 0)? Null: $oTabla->fechaEstimadaQx, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => ($oTabla->estacion == "")? Null: $oTabla->estacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CQxOrdenOperatoriaEliminar :idOrdenOperatoria";

		$params = [
			'idOrdenOperatoria' => $oTabla->idOrdenOperatoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function FiltrarGrilla($dni)
	{
		$query = "
			EXEC DNIFiltrarClientes :dNI";

		$params = [
			'dNI' => ($dni == 0)? Null: $dni, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ClienteDevuelveTodos($lcFiltro)
	{
		$query = "
			EXEC listarcliente :lcFiltro";

		$params = [
			'lcFiltro' => $lcFiltro, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oDOEmpleado)
	{
		$query = "
			EXEC CQxOrdenOperatoriaFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarFavoritos()
	{
		$query = "
			EXEC CQx_ListarDiagnosticosFavoritos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodosFavoritos()
	{
		$query = "
			EXEC CQx_ListarDiagnosticosFavoritos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodosComunes()
	{
		$query = "
			EXEC CQx_ListarDiagnosticosComunes ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarProgramacionFavoritos()
	{
		$query = "
			EXEC CQx_ListarProcedimietnosFavoritos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarProgramacionComunes()
	{
		$query = "
			EXEC CQx_ListarProcedimientosComunes ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdPaciente($oTabla)
	{
		$query = "
			EXEC ClientesSeleccionarPorId :idPaciente";

		$params = [
			'idPaciente' => $oTabla->idOrdenOperatoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AgregarVarios($oArchiveroServicio)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ModificarVarios($oArchiveroServicio)
	{
		$query = "
			EXEC CQxOrdenOperatoriaCIEModificar :idOrdenOperatoriaCIE";

		$params = [
			'idOrdenOperatoriaCIE' => $oArchiveroServicio->idOrdenOperatoriaCIE, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function InsertarDiagnostico($oTabla)
	{
		$query = "
			DECLARE @idOrdenOperatoriaCIE AS Int = :idOrdenOperatoriaCIE
			SET NOCOUNT ON 
			EXEC CQxOrdenOperatoriaCIEAgregar @idOrdenOperatoriaCIE OUTPUT, :idOrdenOperatoria, :idDiagnostico, :idUsuarioAuditoria
			SELECT @idOrdenOperatoriaCIE AS idOrdenOperatoriaCIE";

		$params = [
			'idOrdenOperatoriaCIE' => 0, 
			'idOrdenOperatoria' => ($oTabla->idOrdenOperatoria == 0)? Null: $oTabla->idOrdenOperatoria, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function SeleccionarTodosPrioridad()
	{
		$query = "
			EXEC SP_CQx_ListarTipoPrioridad ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Validar($id)
	{
		$query = "
			EXEC CQxOrdenOperatoriaValidarUsuario :idordenoperatoria";

		$params = [
			'idordenoperatoria' => Id, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarPacientesCitadosXMedico($id)
	{
		$query = "
			EXEC FiltrarPacientesCitadosXMedico :medico";

		$params = [
			'medico' => Id, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarPacientesCentroQuirurgico($dni, $apellidopaterno, $apellidomaterno, $hc)
	{
		$query = "
			EXEC ListarPacientesCentroCQX :dni, :apellidopaterno, :apellidomaterno, :hc";

		$params = [
			'dni' => $dni, 
			'apellidopaterno' => $apellidopaterno, 
			'apellidomaterno' => $apellidomaterno, 
			'hc' => $hc, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}