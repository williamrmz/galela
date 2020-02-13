<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\VB\SIGHEntidades\Enumerados;

class Servicios extends Model
{
    protected $table = "Servicios";
    protected $primaryKey = "IdServicio";
    public $timestamps = false;
    protected $fillable = [
        "IdServicio",
        "Nombre",
        "IdEspecialidad",
        "IdTipoServicio",
        "Codigo",
        "SVG",
        "IdProducto",
        "soloTipoSexo",
        "maximaEdad",
        "codigoServicioSEM",
        "ubicacionSEM",
        "codigoServicioHIS",
        "CostoCeroCE",
        "MinimaEdad",
        "idEstado",
        "Triaje",
        "EsObservacionEmergencia",
        "UsaModuloNinoSano",
        "UsaModuloMaterno",
        "UsaGalenHos",
        "TipoEdad",
        "UsaFUA"
    ];

	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idServicio AS Int = :idServicio
			SET NOCOUNT ON 
			EXEC ServiciosAgregar :idProducto, :sVG, :codigo, @idServicio OUTPUT, :nombre, :idEspecialidad, :idTipoServicio, :soloTipoSexo, :maximaEdad, :codigoServicioSEM, :ubicacionSEM, :codigoServicioHIS, :costoCeroCE, :minimaEdad, :triaje, :esObservacionEmergencia, :usaModuloNinoSano, :usaModuloMaterno, :usaGalenHos, :tipoEdad, :usaFua, :codigoServicioSuSalud, :codigoServicioFUA, :fuaTipoAnexo2015, :codigoServicioRenaes, :idUsuarioAuditoria
			SELECT @idServicio AS idServicio";

		$params = [
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'sVG' => ($oTabla->sVG == "")? Null: $oTabla->sVG, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idServicio' => 0, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idEspecialidad' => ($oTabla->idEspecialidad == 0)? Null: $oTabla->idEspecialidad, 
			'idTipoServicio' => ($oTabla->idTipoServicio == 0)? Null: $oTabla->idTipoServicio, 
			'soloTipoSexo' => $oTabla->soloTipoSexo, 
			'maximaEdad' => $oTabla->maximaEdad, 
			'codigoServicioSEM' => ($oTabla->codigoServicioSEM == "")? Null: $oTabla->codigoServicioSEM, 
			'ubicacionSEM' => ($oTabla->ubicacionSEM == "")? Null: $oTabla->ubicacionSEM, 
			'codigoServicioHIS' => ($oTabla->codigoServicioHIS == "")? Null: $oTabla->codigoServicioHIS, 
			'costoCeroCE' => ($oTabla->costoCeroCE == "")? Null: $oTabla->costoCeroCE, 
			'minimaEdad' => $oTabla->minimaEdad, 
			'triaje' => ($oTabla->triaje == True)? 1: 0, 
			'esObservacionEmergencia' => ($oTabla->esObservacionEmergencia == True)? 1: 0, 
			'usaModuloNinoSano' => ($oTabla->usaModuloNinoSano == True)? 1: 0, 
			'usaModuloMaterno' => ($oTabla->usaModuloMaterno == True)? 1: 0, 
			'usaGalenHos' => ($oTabla->usaGalenHos == True)? 1: 0, 
			'tipoEdad' => $oTabla->tipoEdad, 
			'usaFua' => ($oTabla->usaFUA == True)? 1: 0, 
			'codigoServicioSuSalud' => ($oTabla->codigoServicioSuSalud == "")? Null: $oTabla->codigoServicioSuSalud, 
			'codigoServicioFUA' => ($oTabla->codigoServicioFUA == "")? Null: $oTabla->codigoServicioFUA, 
			'fuaTipoAnexo2015' => ($oTabla->fuaTipoAnexo2015 == 0)? Null: $oTabla->fuaTipoAnexo2015, 
			'codigoServicioRenaes' => ($oTabla->codigoServicioRenaes == "")? Null: $oTabla->codigoServicioRenaes, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ServiciosModificar :idProducto, :sVG, :codigo, :idServicio, :nombre, :idEspecialidad, :idTipoServicio, :soloTipoSexo, :maximaEdad, :codigoServicioSEM, :ubicacionSEM, :codigoServicioHIS, :costoCeroCE, :minimaEdad, :idEstado, :triaje, :esObservacionEmergencia, :usaModuloNinoSano, :usaModuloMaterno, :usaGalenHos, :tipoEdad, :usaFua, :codigoServicioSuSalud, :codigoServicioFUA, :fuaTipoAnexo2015, :codigoServicioRenaes, :idUsuarioAuditoria";

		$params = [
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'sVG' => ($oTabla->sVG == "")? Null: $oTabla->sVG, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idEspecialidad' => ($oTabla->idEspecialidad == 0)? Null: $oTabla->idEspecialidad, 
			'idTipoServicio' => ($oTabla->idTipoServicio == 0)? Null: $oTabla->idTipoServicio, 
			'soloTipoSexo' => $oTabla->soloTipoSexo, 
			'maximaEdad' => $oTabla->maximaEdad, 
			'codigoServicioSEM' => ($oTabla->codigoServicioSEM == "")? Null: $oTabla->codigoServicioSEM, 
			'ubicacionSEM' => ($oTabla->ubicacionSEM == "")? Null: $oTabla->ubicacionSEM, 
			'codigoServicioHIS' => ($oTabla->codigoServicioHIS == "")? Null: $oTabla->codigoServicioHIS, 
			'costoCeroCE' => ($oTabla->costoCeroCE == "")? Null: $oTabla->costoCeroCE, 
			'minimaEdad' => $oTabla->minimaEdad, 
			'idEstado' => $oTabla->idEstado, 
			'triaje' => ($oTabla->triaje == True)? 1: 0, 
			'esObservacionEmergencia' => ($oTabla->esObservacionEmergencia == True)? 1: 0, 
			'usaModuloNinoSano' => ($oTabla->usaModuloNinoSano == True)? 1: 0, 
			'usaModuloMaterno' => ($oTabla->usaModuloMaterno == True)? 1: 0, 
			'usaGalenHos' => ($oTabla->usaGalenHos == True)? 1: 0, 
			'tipoEdad' => $oTabla->tipoEdad, 
			'usaFua' => ($oTabla->usaFUA == True)? 1: 0, 
			'codigoServicioSuSalud' => ($oTabla->codigoServicioSuSalud == "")? Null: $oTabla->codigoServicioSuSalud, 
			'codigoServicioFUA' => ($oTabla->codigoServicioFUA == "")? Null: $oTabla->codigoServicioFUA, 
			'fuaTipoAnexo2015' => ($oTabla->fuaTipoAnexo2015 == 0)? Null: $oTabla->fuaTipoAnexo2015, 
			'codigoServicioRenaes' => ($oTabla->codigoServicioRenaes == "")? Null: $oTabla->codigoServicioRenaes, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ServiciosEliminar :idServicio, :idUsuarioAuditoria";

		$params = [
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public static function SeleccionarPorId($idServicio)
	{
		$query = "
			EXEC ServiciosSeleccionarPorId :idServicio";

		$params = [
			'idServicio' => $idServicio,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigo($oTabla)
	{
		$query = "
			EXEC ServiciosXcodigo :codigo";

		$params = [
			'codigo' => Trim($oTabla->codigo), 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorTipo($idTipoServicio)
	{
		$query = "
			EXEC ServiciosSeleccionarPorTipo :idTipoServicio";

		$params = [
			'idTipoServicio' => IdTipoServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorTipoV2($idTipoServicio, $lnTipoEstados)
	{
		$query = "
			EXEC ServiciosSeleccionarPorTipoV2 :idTipoServicio";

		$params = [
			'idTipoServicio' => IdTipoServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public static function ServiciosSeleccionarConsultoriosPorEspecialidad($idEspecialidad)
	{
		$query = "
			EXEC ServiciosSeleccionarConsultoriosPorEspecialidad :idEspecialidad";

		$params = [
			'idEspecialidad' => $idEspecialidad,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorTipoServicioDptoEspecialidad($idTipoServicio, $idDepartamento, $idEspecialidad)
	{
		$query = "
			EXEC ServiciosSeleccionarPorTipoServicioDptoEspecialidad :idTipoServicio, :idDepartamento, :idEspecialidad";

		$params = [
			'idTipoServicio' => IdTipoServicio, 
			'idDepartamento' => IdDepartamento, 
			'idEspecialidad' => IdEspecialidad, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorTipoServicioYDpto($idTipoServicio, $idDepartamento)
	{
		$query = "
			EXEC ServiciosSeleccionarPorTipoServicioYDpto :idTipoServicio, :idDepartamento";

		$params = [
			'idTipoServicio' => IdTipoServicio, 
			'idDepartamento' => IdDepartamento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oTabla, $lDepartamentoHospital, $lnTipoEstado)
	{
		$sSql = "";
		$sWhere = "";

		if ($oTabla->idTipoServicio <> 0) {
			$sWhere = $sWhere . " Servicios.IdTipoServicio = " . $oTabla->idTipoServicio . " and ";
		}
		if ($oTabla->codigo <> 0) {
			$sWhere = $sWhere . " Servicios.Codigo = '" & $oTabla->codigo & "' and ";
		}
		if ($oTabla->nombre <> "") {
			$sWhere = $sWhere . " Servicios.Nombre like '%" + $oTabla->nombre + "%' and ";
		}
		if ($lDepartamentoHospital <> 0) {
			$sWhere = $sWhere . " DepartamentosHospital.IdDepartamento = " . $lDepartamentoHospital & " and ";
		}
		if ($lnTipoEstado <> Enumerados::param('sghFiltraAnuladosYactivos') ) {
			$sWhere = $sWhere . " Servicios.idEstado=" . $lnTipoEstado . " and ";
		}
		if ($sWhere <> "") {
			$sSql = $sSql . " where " . substr($sWhere, 0, strlen($sWhere) - 4);
		}
		// 'yamill palomino
		if (Enumerados::param('sghPorEspecialidad')) {
			$sSql .= " order by Especialidades.Nombre, Servicios.Nombre";
		}else{
			$sSql .= " order by Servicios.Nombre, Especialidades.Nombre";
		}
	// '    sSql = sSql + " order by Especialidades.Nombre, Servicios.Nombre"

		$query = "
			EXEC ServiciosFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => $sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerConElMismoCodigo($oTabla)
	{
		$query = "
			EXEC ServiciosXcodigoServicio :codigo, :idServicio";

		$params = [
			'codigo' => $oTabla->codigo, 
			'idServicio' => $oTabla->idServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerConElMismoNombre($oTabla)
	{
		$query = "
			EXEC ServiciosXcodigoServicio :nombre, :idServicio";

		$params = [
			'nombre' => $oTabla->nombre, 
			'idServicio' => $oTabla->idServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarIdDepartamento($lIdServicio)
	{
		$query = "
			EXEC ServiciosFiltrarDepartamentoHosp :lIdServicio";

		$params = [
			'lIdServicio' => $lIdServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdArchivero($lIdEmpleado)
	{
		// $query = "
		// 	EXEC FactPuntosCargaEliminar :lIdEmpleado, :idPuntoCarga, :idPuntoCarga, :idUsuarioAuditoria";

		// $params = [
		// 	'lIdEmpleado' => $lIdEmpleado, 
		// 	'idPuntoCarga' => oRsTmp1->fields!IdPuntoCarga, 
		// 	'idPuntoCarga' => oRsTmp1->fields!IdPuntoCarga, 
		// 	'idUsuarioAuditoria' => 0, 
		// ];

		// $data = \DB::update($query, $params);

		// return $data;
	}

	public function SeleccionarPorIdArchiveroTipoServicio($lIdEmpleado, $lcTipoServicio)
	{
		$query = "
			EXEC ServiciosFiltrarPorIdArchiveroTipoServicio :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function DevuelveEspecialidadDelServicio($lnIdServicio)
	{
		$query = "
			EXEC ServiciosDevuelveEspecialidad :lnIdServicio";

		$params = [
			'lnIdServicio' => $lnIdServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigoDiagnostico($oTabla)
	{
		$query = "
			EXEC SP_CQX_DiagnosticoXCodigoCIE10 :codigo";

		$params = [
			'codigo' => Trim($oTabla->codigoCIE10), 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerIdProducto($ml_IdServicio)
	{
		$query = "
			EXEC ServiciosSeleccionarXidentificadorSOAT :idServicio";

		$params = [
			'idServicio' => $ml_IdServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}