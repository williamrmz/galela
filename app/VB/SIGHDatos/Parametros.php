<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Parametros extends Model
{
    protected $table = "Parametros";
    protected $primaryKey = "IdParametro";
    protected $fillable = [
        "IdParametro",
        "Tipo",
        "Codigo",
        "ValorTexto",
        "ValorInt",
        "ValorFloat",
        "Descripcion",
        "Grupo"
    ];


	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idParametro AS Int = :idParametro
			SET NOCOUNT ON 
			EXEC ParametrosAgregar :descripcion, :codigo, :tipo, @idParametro OUTPUT, :valorFloat, :valorInt, :valorTexto, :grupo, :idUsuarioAuditoria
			SELECT @idParametro AS idParametro";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'tipo' => ($oTabla->tipo == "")? Null: $oTabla->tipo, 
			'idParametro' => 0, 
			'valorFloat' => ($oTabla->valorFloat == 0)? Null: $oTabla->valorFloat, 
			'valorInt' => ($oTabla->valorInt == 0)? Null: $oTabla->valorInt, 
			'valorTexto' => ($oTabla->valorTexto == "")? Null: $oTabla->valorTexto, 
			'grupo' => ($oTabla->grupo == "")? Null: $oTabla->grupo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ParametrosModificar :descripcion, :codigo, :tipo, :idParametro, :valorFloat, :valorInt, :valorTexto, :grupo, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'tipo' => ($oTabla->tipo == "")? Null: $oTabla->tipo, 
			'idParametro' => ($oTabla->idParametro == 0)? Null: $oTabla->idParametro, 
			'valorFloat' => $oTabla->valorFloat, 
			'valorInt' => $oTabla->valorInt, 
			'valorTexto' => $oTabla->valorTexto, 
			'grupo' => ($oTabla->grupo == "")? Null: $oTabla->grupo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ParametrosEliminar :idParametro, :idUsuarioAuditoria";

		$params = [
			'idParametro' => ($oTabla->idParametro == 0)? Null: $oTabla->idParametro, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ParametrosSeleccionarPorId :idParametro";

		$params = [
			'idParametro' => $oTabla->idParametro, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarComparadorFechas()
	{
		$query = "
			EXEC ParametrosSeleccionarComparadorFechas ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTipo($sTipo)
	{
		$query = "
			EXEC ParametrosSeleccionarPorTipo :tipo";

		$params = [
			'tipo' => ($sTipo == "")? Null: $sTipo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerCadenaConexion()
	{
		$query = "
			EXEC ParametrosSeleccionarCadenaConexion ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerCadenaConexionShape()
	{
		$query = "
			EXEC ParametrosSeleccionarCadenaConexionShape ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function GenerarIdGrupoMovimiento()
	{
		$query = "
			DECLARE @idGrupoMovimiento AS Int = :idGrupoMovimiento
			SET NOCOUNT ON 
			EXEC ParametrosGenerarNroAgrupadorMovimientos @idGrupoMovimiento OUTPUT
			SELECT @idGrupoMovimiento AS idGrupoMovimiento";

		$params = [
			'idGrupoMovimiento' => 0, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function SeleccionarIdServicioArchivoClinico()
	{
		$query = "
			EXEC ParametrosSeleccionarIdServicioArchivoClinico ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTiposConsulta()
	{
		$query = "
			EXEC ParametrosSeleccionarTiposConsulta ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTiposConsultaPorEspecialidad($lIdEspecialidad)
	{
		$query = "
			EXEC FactCatalogoServiciosSeleccionarTipoConsulta :idEspecialidad";

		$params = [
			'idEspecialidad' => $lIdEspecialidad, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerCodigoDeNuevoCarnet()
	{
		$query = "
			EXEC ParametrosObtenerCodigoDeNuevoCarnet ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerCodigoDeDuplicadoCarnet()
	{
		$query = "
			EXEC ParametrosObtenerCodigoDeDuplicadoCarnet ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerCodigoDeFolder()
	{
		$query = "
			EXEC ParametrosObtenerCodigoDeFolder ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTiposConsultaInterconsulta()
	{
		$query = "
			EXEC ParametrosSeleccionarTiposConsultaInterconsulta ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerCodigoDeConsultaDeEmergencia()
	{
		$query = "
			EXEC ParametrosObtenerCodigoDeConsultaDeEmergencia ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerValorIntPorTipoYCodigo($sTipo, $sCodigo)
	{
		$query = "
			EXEC ParametrosObtenerValorIntPorTipoYCodigo :sTipo, :sCodigo";

		$params = [
			'sTipo' => $sTipo, 
			'sCodigo' => $sCodigo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function DiasDelPacienteEnHospitalizacionEmergencia($ldFechaIngreso, $lcHoraIngreso, $ldFechaAlta, $lcHoraAlta, $lcHoraEstanciaMax)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function DiasDelPacienteEnHospitalizacionEmergencia1($ldFechaIngreso, $lcHoraIngreso, $ldFechaAlta, $lcHoraAlta, $lcHoraEstanciaMax)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function HorasDelPacienteEnHospitalizacionEmergencia($ldFechaIngreso, $lcHoraIngreso, $ldFechaAlta, $lcHoraAlta)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionaFilaParametro($lnIdParametro)
	{
		$query = "
			EXEC ParametrosSeleccionarPorId :lnIdParametro";

		$params = [
			'lnIdParametro' => $lnIdParametro, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionaFilaParametro2($lnIdParametro)
	{
		$query = "
			EXEC ParametrosSeleccionarPorId :lnIdParametro";

		$params = [
			'lnIdParametro' => $lnIdParametro, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RetornaFechaServidorSQLserver()
	{
		$query = "
			EXEC RetornaFechaServidorSQL ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RetornaFechaServidorSQL()
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RetornaHoraServidorSQL()
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RetornaHoraServidorSQL1()
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RetornaNombreDeServidor()
	{
		$query = "
			EXEC RetornaNombreDeServidor ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RetornaFechaHoraServidorSQL()
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function DevuelveUbigeoDetalladoDelHospital()
	{
		$query = "
			EXEC DevuelveUbigeoDetalladoDelHospital :seleccionaFilaParametro208";

		$params = [
			'seleccionaFilaParametro208' => SeleccionaFilaParametro(208), 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RetornaLoginUsuario($idCodigoUsuario)
	{
		$query = "
			EXEC EmpleadosRetornaLoginUsuario :idCodigoUsuario";

		$params = [
			'idCodigoUsuario' => $idCodigoUsuario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RetornaFechaServidorSQL_AAMMDD()
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RetornaVersionServidorSQLserver()
	{
		$query = "
			EXEC RetornaVersionDeServidor ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorGrupo($lcParametro)
	{
		$query = "
			EXEC ParametrosSeleccionarPorGrupo :grupo";

		$params = [
			'grupo' => $lcParametro, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RetornaHoraServidorSQLserverFormatoGalenhos()
	{
		$query = "
			EXEC RetornaHoraServidorSQLserverFormatoGalenhos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarIdPermisoSIS()
	{
		$query = "
			EXEC ParametrosObtenerCodigoDePermisoSIS ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}