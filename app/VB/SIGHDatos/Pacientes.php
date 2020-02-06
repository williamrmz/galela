<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Pacientes extends Model
{
	public $fillable = ['conexion'];
	
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPaciente AS Int = :idPaciente
			SET NOCOUNT ON 
			EXEC PacientesAgregar :idPaisNacimiento, :apellidoMaterno, :direccionDomicilio, :observacion, :idTipoNumeracion, :idPaisProcedencia, @idPaciente OUTPUT, :apellidoPaterno, :primerNombre, :segundoNombre, :tercerNombre, :fechaNacimiento, :nroDocumento, :telefono, :autogenerado, :idTipoSexo, :idProcedencia, :idGradoInstruccion, :idEstadoCivil, :idDocIdentidad, :idTipoOcupacion, :idCentroPobladoDomicilio, :nombrePadre, :nombreMadre, :idPaisDomicilio, :nroHistoriaClinica, :idCentroPobladoNacimiento, :idCentroPobladoProcedencia, :idDistritoProcedencia, :idDistritoDomicilio, :idDistritoNacimiento, :fichaFamiliar, :idEtnia, :grupoSanguineo, :factorRh, :usoWebReniec, :idIdioma, :email, :madreDocumento, :madreApellidoPaterno, :madreApellidoMaterno, :madrePrimerNombre, :madreSegundoNombre, :nroOrdenHijo, :madreTipoDocumento, :sector, :sectorista, :idUsuarioAuditoria
			SELECT @idPaciente AS idPaciente";

		
		$params = [
			'idPaisNacimiento' => ($oTabla->idPaisNacimiento == 0)? Null: $oTabla->idPaisNacimiento, 
			'apellidoMaterno' => ($oTabla->apellidoMaterno == "")? Null: $oTabla->apellidoMaterno, 
			'direccionDomicilio' => ($oTabla->direccionDomicilio == "")? Null: $oTabla->direccionDomicilio, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'idTipoNumeracion' => ($oTabla->idTipoNumeracion == 0)? Null: $oTabla->idTipoNumeracion, 
			'idPaisProcedencia' => ($oTabla->idPaisProcedencia == 0)? Null: $oTabla->idPaisProcedencia, 
			'idPaciente' => 0, 
			'apellidoPaterno' => ($oTabla->apellidoPaterno == "")? Null: $oTabla->apellidoPaterno, 
			'primerNombre' => ($oTabla->primerNombre == "")? Null: $oTabla->primerNombre, 
			'segundoNombre' => ($oTabla->segundoNombre == "")? Null: $oTabla->segundoNombre, 
			'tercerNombre' => ($oTabla->tercerNombre == "")? Null: $oTabla->tercerNombre, 
			'fechaNacimiento' => ($oTabla->fechaNacimiento == 0)? Null: $oTabla->fechaNacimiento, 
			'nroDocumento' => ($oTabla->nroDocumento == "")? Null: $oTabla->nroDocumento, 
			'telefono' => ($oTabla->telefono == "")? Null: $oTabla->telefono, 
			'autogenerado' => ($oTabla->autogenerado == "")? Null: $oTabla->autogenerado, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'idProcedencia' => ($oTabla->idProcedencia == 0)? Null: $oTabla->idProcedencia, 
			'idGradoInstruccion' => ($oTabla->idGradoInstruccion == 0)? Null: $oTabla->idGradoInstruccion, 
			'idEstadoCivil' => ($oTabla->idEstadoCivil == 0)? Null: $oTabla->idEstadoCivil, 
			'idDocIdentidad' => ($oTabla->idDocIdentidad == 0)? Null: $oTabla->idDocIdentidad, 
			'idTipoOcupacion' => ($oTabla->idTipoOcupacion == 0)? Null: $oTabla->idTipoOcupacion, 
			'idCentroPobladoDomicilio' => ($oTabla->idCentroPobladoDomicilio == 0)? Null: $oTabla->idCentroPobladoDomicilio, 
			'nombrePadre' => ($oTabla->nombrePadre == "")? Null: $oTabla->nombrePadre, 
			'nombreMadre' => ($oTabla->nombreMadre == "")? Null: $oTabla->nombreMadre, 
			'idPaisDomicilio' => ($oTabla->idPaisDomicilio == 0)? Null: $oTabla->idPaisDomicilio, 
			'nroHistoriaClinica' => ($oTabla->nroHistoriaClinica == "")? Null: $oTabla->nroHistoriaClinica, 
			'idCentroPobladoNacimiento' => ($oTabla->idCentroPobladoNacimiento == 0)? Null: $oTabla->idCentroPobladoNacimiento, 
			'idCentroPobladoProcedencia' => ($oTabla->idCentroPobladoProcedencia == 0)? Null: $oTabla->idCentroPobladoProcedencia, 
			'idDistritoProcedencia' => ($oTabla->idDistritoProcedencia == 0)? Null: $oTabla->idDistritoProcedencia, 
			'idDistritoDomicilio' => ($oTabla->idDistritoDomicilio == 0)? Null: $oTabla->idDistritoDomicilio, 
			'idDistritoNacimiento' => ($oTabla->idDistritoNacimiento == 0)? Null: $oTabla->idDistritoNacimiento, 
			'fichaFamiliar' => ($oTabla->fichaFamiliar == "")? Null: $oTabla->fichaFamiliar, 
			'idEtnia' => ($oTabla->idEtnia == "")? Null: $oTabla->idEtnia, 
			'grupoSanguineo' => ($oTabla->grupoSanguineo == "")? Null: $oTabla->grupoSanguineo, 
			'factorRh' => ($oTabla->factorRh == "")? Null: $oTabla->factorRh, 
			'usoWebReniec' => ($oTabla->usoWebReniec == True)? 1: 0, 
			'idIdioma' => ($oTabla->idIdioma == 0)? Null: $oTabla->idIdioma, 
			'email' => ($oTabla->email == "")? Null: $oTabla->email, 
			'madreDocumento' => ($oTabla->madreDocumento == "")? Null: $oTabla->madreDocumento, 
			'madreApellidoPaterno' => ($oTabla->madreApellidoPaterno == "")? Null: $oTabla->madreApellidoPaterno, 
			'madreApellidoMaterno' => ($oTabla->madreApellidoMaterno == "")? Null: $oTabla->madreApellidoMaterno, 
			'madrePrimerNombre' => ($oTabla->madrePrimerNombre == "")? Null: $oTabla->madrePrimerNombre, 
			'madreSegundoNombre' => ($oTabla->madreSegundoNombre == "")? Null: $oTabla->madreSegundoNombre, 
			'nroOrdenHijo' => $oTabla->nroOrdenHijo, 
			'madreTipoDocumento' => $oTabla->madreTipoDocumento, 
			'sector' => $oTabla->sector, 
			'sectorista' => $oTabla->sectorista, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla, $lbVerificaPacientesRepetidosAntesDeGrabarDatos)
	{

		$errors = collect([]);
		if ($lbVerificaPacientesRepetidosAntesDeGrabarDatos == true) {
			$data = $this->PacientesVerificaRepetidosAntesDeGrabarDatos($oTabla);
			if( $data->sinProblemas != '' ) {
				throw new \Exception( $data->sinProblemas);
			}
		}

		$query = "
			EXEC PacientesModificar :idPaisNacimiento, :apellidoMaterno, :direccionDomicilio, :observacion, :idTipoNumeracion, :idPaisProcedencia, :idPaciente, :apellidoPaterno, :primerNombre, :segundoNombre, :tercerNombre, :fechaNacimiento, :nroDocumento, :telefono, :autogenerado, :idTipoSexo, :idProcedencia, :idGradoInstruccion, :idEstadoCivil, :idDocIdentidad, :idTipoOcupacion, :idCentroPobladoDomicilio, :nombrePadre, :nombreMadre, :idPaisDomicilio, :nroHistoriaClinica, :idCentroPobladoNacimiento, :idCentroPobladoProcedencia, :idDistritoProcedencia, :idDistritoDomicilio, :idDistritoNacimiento, :fichaFamiliar, :idEtnia, :grupoSanguineo, :factorRh, :usoWebReniec, :idIdioma, :email, :madreDocumento, :madreApellidoPaterno, :madreApellidoMaterno, :madrePrimerNombre, :madreSegundoNombre, :nroOrdenHijo, :madreTipoDocumento, :sector, :sectorista, :idUsuarioAuditoria";

		$params = [
			'idPaisNacimiento' => ($oTabla->idPaisNacimiento == 0)? Null: $oTabla->idPaisNacimiento,
			'apellidoMaterno' => ($oTabla->apellidoMaterno == "")? Null: $oTabla->apellidoMaterno,
			'direccionDomicilio' => ($oTabla->direccionDomicilio == "")? Null: $oTabla->direccionDomicilio,
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'idTipoNumeracion' => ($oTabla->idTipoNumeracion == 0)? Null: $oTabla->idTipoNumeracion, 
			'idPaisProcedencia' => ($oTabla->idPaisProcedencia == 0)? Null: $oTabla->idPaisProcedencia, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'apellidoPaterno' => ($oTabla->apellidoPaterno == "")? Null: $oTabla->apellidoPaterno, 
			'primerNombre' => ($oTabla->primerNombre == "")? Null: $oTabla->primerNombre, 
			'segundoNombre' => ($oTabla->segundoNombre == "")? Null: $oTabla->segundoNombre, 
			'tercerNombre' => ($oTabla->tercerNombre == "")? Null: $oTabla->tercerNombre, 
			'fechaNacimiento' => ($oTabla->fechaNacimiento == 0)? Null: $oTabla->fechaNacimiento, 
			'nroDocumento' => ($oTabla->nroDocumento == "")? Null: $oTabla->nroDocumento, 
			'telefono' => ($oTabla->telefono == "")? Null: $oTabla->telefono, 
			'autogenerado' => ($oTabla->autogenerado == "")? Null: $oTabla->autogenerado, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'idProcedencia' => ($oTabla->idProcedencia == 0)? Null: $oTabla->idProcedencia, 
			'idGradoInstruccion' => ($oTabla->idGradoInstruccion == 0)? Null: $oTabla->idGradoInstruccion, 
			'idEstadoCivil' => ($oTabla->idEstadoCivil == 0)? Null: $oTabla->idEstadoCivil, 
			'idDocIdentidad' => ($oTabla->idDocIdentidad == 0)? Null: $oTabla->idDocIdentidad, 
			'idTipoOcupacion' => ($oTabla->idTipoOcupacion == 0)? Null: $oTabla->idTipoOcupacion, 
			'idCentroPobladoDomicilio' => ($oTabla->idCentroPobladoDomicilio == 0)? Null: $oTabla->idCentroPobladoDomicilio,
			'nombrePadre' => ($oTabla->nombrePadre == "")? Null: $oTabla->nombrePadre, 
			'nombreMadre' => ($oTabla->nombreMadre == "")? Null: $oTabla->nombreMadre, 
			'idPaisDomicilio' => ($oTabla->idPaisDomicilio == 0)? Null: $oTabla->idPaisDomicilio, 
			'nroHistoriaClinica' => ($oTabla->nroHistoriaClinica == "")? Null: $oTabla->nroHistoriaClinica, 
			'idCentroPobladoNacimiento' => ($oTabla->idCentroPobladoNacimiento == 0)? Null: $oTabla->idCentroPobladoNacimiento,
			'idCentroPobladoProcedencia' => ($oTabla->idCentroPobladoProcedencia == 0)? Null: $oTabla->idCentroPobladoProcedencia,
			'idDistritoProcedencia' => ($oTabla->idDistritoProcedencia == 0)? Null: $oTabla->idDistritoProcedencia, 
			'idDistritoDomicilio' => ($oTabla->idDistritoDomicilio == 0)? Null: $oTabla->idDistritoDomicilio, 
			'idDistritoNacimiento' => ($oTabla->idDistritoNacimiento == 0)? Null: $oTabla->idDistritoNacimiento, 
			'fichaFamiliar' => ($oTabla->fichaFamiliar == "")? Null: $oTabla->fichaFamiliar, 
			'idEtnia' => ($oTabla->idEtnia == "")? Null: $oTabla->idEtnia, 
			'grupoSanguineo' => ($oTabla->grupoSanguineo == "")? Null: $oTabla->grupoSanguineo, 
			'factorRh' => ($oTabla->factorRh == "")? Null: $oTabla->factorRh, 
			'usoWebReniec' => ($oTabla->usoWebReniec == True)? 1: 0, 
			'idIdioma' => ($oTabla->idIdioma == 0)? Null: $oTabla->idIdioma, 
			'email' => ($oTabla->email == "")? Null: $oTabla->email, 
			'madreDocumento' => ($oTabla->madreDocumento == "")? Null: $oTabla->madreDocumento, 
			'madreApellidoPaterno' => ($oTabla->madreApellidoPaterno == "")? Null: $oTabla->madreApellidoPaterno, 
			'madreApellidoMaterno' => ($oTabla->madreApellidoMaterno == "")? Null: $oTabla->madreApellidoMaterno, 
			'madrePrimerNombre' => ($oTabla->madrePrimerNombre == "")? Null: $oTabla->madrePrimerNombre, 
			'madreSegundoNombre' => ($oTabla->madreSegundoNombre == "")? Null: $oTabla->madreSegundoNombre, 
			'nroOrdenHijo' => $oTabla->nroOrdenHijo, 
			'madreTipoDocumento' => $oTabla->madreTipoDocumento, 
			'sector' => $oTabla->sector, 
			'sectorista' => $oTabla->sectorista, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];


		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PacientesEliminar :idPaciente, :idUsuarioAuditoria";

		$params = [
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC PacientesSeleccionarPorId :idPaciente";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdPaciente($idPaciente)
	{
		$query = "
			EXEC PacientesSeleccionarPorId :idPaciente";

		$params = [
			'idPaciente' => IdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdCuentaAtencion($ml_IdCuentaAtencion, $ml_dias)
	{
		$query = "
			EXEC AtencionesPorIdCuentaAtencion :idcuentaAtencion, :dias";

		$params = [
			'idcuentaAtencion' => $ml_IdCuentaAtencion, 
			'dias' => $ml_dias, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarporEspecialidadxServicio($lnIdParametro)
	{
		$query = "
			EXEC SeleccionarEspecialidadxServicio :idServicio";

		$params = [
			'idServicio' => $lnIdParametro, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTipofinanciamientopoID($lnIdParametro)
	{
		$query = "
			EXEC FuentesFinanciamientoSeleccionarPorId :idTipofinanciamiento";

		$params = [
			'idTipofinanciamiento' => $lnIdParametro, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ValidarEspecialidad($ms_nombre)
	{
		$query = "
			EXEC ValidarEspecialidad :nombre";

		$params = [
			'nombre' => $ms_nombre, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorHistoriaClinicaDefinitiva($oTabla)
	{
		$query = "
			EXEC PacientesSeleccionarPorHistoriaClinicaDefinitiva :nroHistoriaClinica";

		$params = [
			'nroHistoriaClinica' => $oTabla->nroHistoriaClinica, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oTabla)
	{
		$query = "
			EXEC PacientesFiltrarTodos :nroHistoriaClinica, :apellidoPaterno, :apellidoMaterno, :primerNombre, :segundoNombre, :idDocIdentidad, :nroDocumento, :fichaFamiliar";

		$params = [
			'nroHistoriaClinica' => $oTabla->nroHistoriaClinica, 
			'apellidoPaterno' => $oTabla->apellidoPaterno, 
			'apellidoMaterno' => $oTabla->apellidoMaterno, 
			'primerNombre' => $oTabla->primerNombre, 
			'segundoNombre' => $oTabla->segundoNombre, 
			'idDocIdentidad' => $oTabla->idDocIdentidad, 
			'nroDocumento' => $oTabla->nroDocumento, 
			'fichaFamiliar' => $oTabla->fichaFamiliar, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarConHistoriasTemporales($oTabla)
	{
		$query = "
			EXEC PacientesFiltrarConHistoriasTemporales :nroHistoriaClinica, :apellidoPaterno, :apellidoMaterno, :primerNombre, :dni, :fichaFamiliar";

		$params = [
			'nroHistoriaClinica' => $oTabla->nroHistoriaClinica, 
			'apellidoPaterno' => $oTabla->apellidopaterno, 
			'apellidoMaterno' => $oTabla->apellidomaterno, 
			'primerNombre' => $oTabla->primerNombre, 
			'dni' => $oTabla->nroDocumento, 
			'fichaFamiliar' => $oTabla->fichaFamiliar, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarConHistoriasDefinitivas($oTabla, $lcSinApellido)
	{
		$query = "
			EXEC PacientesFiltrarConHistoriasDefinitivas :nroHistoriaClinica, :apellidoPaterno, :apellidoMaterno, :primerNombre, :dni, :fichaFamiliar";

		$params = [
			'nroHistoriaClinica' => $oTabla->nroHistoriaClinica, 
			'apellidoPaterno' => $oTabla->apellidopaterno, 
			'apellidoMaterno' => $oTabla->apellidomaterno, 
			'primerNombre' => $oTabla->primerNombre, 
			'dni' => $oTabla->nroDocumento, 
			'fichaFamiliar' => $oTabla->fichaFamiliar, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerConElMismoNombre($oTabla)
	{
		$query = "
			EXEC PacientesXApellidosYnombres :apellidoPaterno, :apellidoMaterno, :primerNombre, :segundoNombre";

		$params = [
			'apellidoPaterno' => $oTabla->apellidopaterno, 
			'apellidoMaterno' => $oTabla->apellidomaterno, 
			'primerNombre' => $oTabla->primerNombre, 
			'segundoNombre' => $oTabla->segundoNombre, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerConLaMismaHistoriaDefinitiva($oTabla)
	{
		$query = "
			EXEC PacientesObtenerConLaMismaHistoriaDefinitiva :nroHistoriaClinica, :idPaciente";

		$params = [
			'nroHistoriaClinica' => $oTabla->nroHistoriaClinica, 
			'idPaciente' => $oTabla->idPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerConElMismoAutogenerado($oTabla)
	{
		$query = "
			EXEC PacientesObtenerConElMismoAutogenerado :autogenerado, :idPaciente";

		$params = [
			'autogenerado' => $oTabla->autogenerado, 
			'idPaciente' => $oTabla->idPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function TieneCita($fechaIngreso, $lIdServicio, $lIdPaciente)
	{
		$query = "
			EXEC PacientesTieneCita :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarNroHistoriaYTipoNumeracion($oTabla)
	{
		$query = "
			EXEC PacientesActualizarNroHistoriaYTipoNumeracion :nroHistoriaClinica, :idTipoNumeracion, :idPaciente";

		$params = [
			'nroHistoriaClinica' => $oTabla->nroHistoriaClinica, 
			'idTipoNumeracion' => $oTabla->idTipoNumeracion, 
			'idPaciente' => $oTabla->idPaciente, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function FiltrarHistoriasParaAdmision($lNroHistoriaClinica)
	{
		$query = "
			EXEC PacientesFiltrarHistoriasParaAdmision :nroHistoriaClinica";

		$params = [
			'nroHistoriaClinica' => $lNroHistoriaClinica, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerIdPacientePorHistoriaClinica($lNroHistoriaClinica, $lIdTipoNumeracion)
	{
		$query = "
			EXEC PacientesObtenerIdPacientePorHistoriaClinica :lNroHistoriaClinica, :lIdTipoNumeracion";

		$params = [
			'lNroHistoriaClinica' => $lNroHistoriaClinica, 
			'lIdTipoNumeracion' => $lIdTipoNumeracion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SePuedeEliminar($lIdPaciente)
	{
		$query = "
			DECLARE @respuesta AS Int = :respuesta
			SET NOCOUNT ON 
			EXEC PacientesSePuedeEliminar :idPaciente, @respuesta OUTPUT
			SELECT @respuesta AS respuesta";

		$params = [
			'idPaciente' => $lIdPaciente, 
			'respuesta' => 0, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function PacientesVerificaRepetidosAntesDeGrabarDatos($oTabla)
	{
		$query = "
			DECLARE @sinProblemas AS VarChar = :sinProblemas
			SET NOCOUNT ON 
			EXEC PacientesVerificaRepetidosAntesDeGrabarDatos @sinProblemas OUTPUT, :autogenerado, :nroHistoriaClinica, :idTipoNumeracion, :idPaciente
			SELECT @sinProblemas AS sinProblemas";

		$params = [
			'sinProblemas' => 0, 
			'autogenerado' => ($oTabla->autogenerado == "")? Null: $oTabla->autogenerado, 
			'nroHistoriaClinica' => ($oTabla->nroHistoriaClinica == "")? Null: $oTabla->nroHistoriaClinica, 
			'idTipoNumeracion' => ($oTabla->idTipoNumeracion == 0)? Null: $oTabla->idTipoNumeracion, 
			'idPaciente' => $oTabla->idPaciente, 
		];

		$data = \DB::select($query, $params);
		$data = reset($data);

		return $data;
	}

	public function FiltrarTodosSoloHistoriasDefinitivas($oTabla, $ms_FechaNacimiento, $lcSinApellido)
	{
		$query = "
			EXEC PacientesFiltrarTodosSoloHistoriasDefinitivas :nroHistoriaClinica, :apellidoPaterno, :apellidoMaterno, :primerNombre, :segundoNombre, :idDocIdentidad, :nroDocumento, :fecNac";

		$params = [
			'nroHistoriaClinica' => $oTabla->nroHistoriaClinica, 
			'apellidoPaterno' => $oTabla->apellidopaterno, 
			'apellidoMaterno' => $oTabla->apellidomaterno, 
			'primerNombre' => $oTabla->primerNombre, 
			'segundoNombre' => $oTabla->segundoNombre, 
			'idDocIdentidad' => $oTabla->idDocIdentidad, 
			'nroDocumento' => $oTabla->nroDocumento, 
			'fecNac' => $ms_FechaNacimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function PacientesFiltraPorNroDocumentoYtipo($lcNroDocumento, $lnIdDocIdentidad)
	{
		$query = "
			EXEC PacientesFiltraPorNroDocumentoYtipo :nroDocumento, :idDocIdentidad";

		$params = [
			'nroDocumento' => $lcNroDocumento, 
			'idDocIdentidad' => $lnIdDocIdentidad, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RetornaFecFiliacion($lcNroDocumento)
	{
		$query = "
			EXEC RetornaFEcFiliacionSisSEguros :nroDocumento";

		$params = [
			'nroDocumento' => $lcNroDocumento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RetornaDxQx()
	{
		$query = "
			EXEC RetornaDxQx ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function REtornaDxTiempodeCarencia()
	{
		$query = "
			EXEC REtornaDxTiempoDeCarencia ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RetornaEspecialidadesQx()
	{
		$query = "
			EXEC RetornaEspecialidadesQx ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RetornaNroDocumentoxIdCuentaAtencion($ml_IdCuentaAtencion)
	{
		$query = "
			EXEC RetornaNroDocumentoxCuentaAtecion :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $ml_IdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function PacientesSeleccionarPorDNI($lcDNI, &$oTabla)
	{
		// $query = "
		// 	EXEC PacientesActualizarNroHistoriaYTipoNumeracion :nroHistoriaClinica, :idTipoNumeracion, :idPaciente";

		// $params = [
		// 	'nroHistoriaClinica' => oRsTmp1->fields!NroHistoriaClinica, 
		// 	'idTipoNumeracion' => oRsTmp->fields!IdTipoNumeracion, 
		// 	'idPaciente' => oRsTmp->fields!IdPaciente, 
		// ];

		// $data = \DB::update($query, $params);

		// return $data;
	}

	public function HistoriasClinicasXIdPaciente($lnIdPaciente, $oConexion)
	{
		$query = "
			EXEC HistoriasClinicasXIdPaciente :idPaciente";

		$params = [
			'idPaciente' => $lnIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdMQ($oTabla)
	{
		$query = "
			EXEC PacientesSeleccionarPorIdMQ :idPaciente";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function CQx_SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC SP_CQx_PacienteSeleccionarPorId :idPaciente";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AgregarTelefonoDePacientes($oTabla)
	{
		$query = "
			EXEC ActualizarTelefonosXPaciente :idPaciente, :telefono2, :telefono3";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
			'telefono2' => $oTabla->telefono2, 
			'telefono3' => $oTabla->telefono3, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function AgregarTelefonoDeTutor($oTabla)
	{
		$query = "
			EXEC AgregarTelefonoDeTutor :idPaciente, :telefono4";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
			'telefono4' => $oTabla->telefono4, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function AgregarGSanguineoFactorRhyReligion($oTabla)
	{
		$query = "
			EXEC ActualizarGSangioneoFactorRhyReligion :idPaciente, :factorRh, :grupoSanguineo, :religion";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
			'factorRh' => $oTabla->factorRh, 
			'grupoSanguineo' => $oTabla->grupoSanguineo, 
			'religion' => $oTabla->religion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function AgregarUbigeoTutor($oTabla)
	{
		$query = "
			EXEC ActualizarUbigeoDeltutor :idPaciente, :direccionDomicilioTutor, :idPaisDomicilioTutor, :iddistritoDomiciliotutor, :idCentroPobladotutor";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
			'direccionDomicilioTutor' => $oTabla->direccionDomiciliotutor, 
			'idPaisDomicilioTutor' => $oTabla->idPaisDomicilioTutor, 
			'iddistritoDomiciliotutor' => $oTabla->idDistritoDomicilioTutor, 
			'idCentroPobladotutor' => $oTabla->idCentroPobladoDomicilioTutor, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function ListarReligiones()
	{
		$query = "
			EXEC ListarReligion ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarFactorRH()
	{
		$query = "
			EXEC ListarFactorRH ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarGrupoSanguineo()
	{
		$query = "EXEC ListarGrupoSanguineo ";
		$params = [
		];
		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdCuenta($ml_idAtencion)
	{
		$query = "
			EXEC PacientesSeleccionarPorIdCuenta :idcuentaAtencion";

		$params = [
			'idcuentaAtencion' => $ml_idAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarTriaje($oTabla)
	{
		$query = "
			EXEC PacientesFiltrarCuentasDelDia :nroHistoriaClinica, :apellidoPaterno, :apellidoMaterno, :primerNombre, :segundoNombre, :idDocIdentidad, :nroDocumento, :fichaFamiliar";

		$params = [
			'nroHistoriaClinica' => $oTabla->nroHistoriaClinica, 
			'apellidoPaterno' => $oTabla->apellidopaterno, 
			'apellidoMaterno' => $oTabla->apellidomaterno, 
			'primerNombre' => $oTabla->primerNombre, 
			'segundoNombre' => $oTabla->segundoNombre, 
			'idDocIdentidad' => $oTabla->idDocIdentidad, 
			'nroDocumento' => $oTabla->nroDocumento, 
			'fichaFamiliar' => $oTabla->fichaFamiliar, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RetornaPacientesCronicos($ms_NroHistoria)
	{
		$query = "
			EXEC ListarPacientesCronicos :nroHistoriaClinica";

		$params = [
			'nroHistoriaClinica' => $ms_NroHistoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RetornaDNIReniec()
	{
		$query = "
			EXEC listarDNI ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}