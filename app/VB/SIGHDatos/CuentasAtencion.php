<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CuentasAtencion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idCuentaAtencion AS Int = :idCuentaAtencion
			SET NOCOUNT ON 
			EXEC FacturacionCuentasAtencionAgregar :totalPorPagar, :idEstado, :totalPagado, :totalAsegurado, :totalExonerado, :horaCierre, :fechaCierre, :horaApertura, :fechaApertura, :idPaciente, @idCuentaAtencion OUTPUT, :fechaCreacion, :idUsuarioAuditoria
			SELECT @idCuentaAtencion AS idCuentaAtencion";

		$params = [
			'totalPorPagar' => ($oTabla->totalPorPagar == 0)? Null: $oTabla->totalPorPagar, 
			'idEstado' => ($oTabla->idEstado == 0)? Null: $oTabla->idEstado, 
			'totalPagado' => ($oTabla->totalPagado == 0)? Null: $oTabla->totalPagado, 
			'totalAsegurado' => ($oTabla->totalAsegurado == 0)? Null: $oTabla->totalAsegurado, 
			'totalExonerado' => ($oTabla->totalExonerado == 0)? Null: $oTabla->totalExonerado, 
			'horaCierre' => ($oTabla->horaCierre == "")? Null: $oTabla->horaCierre, 
			'fechaCierre' => ($oTabla->fechaCierre == 0)? Null: $oTabla->fechaCierre, 
			'horaApertura' => ($oTabla->horaApertura == "")? Null: $oTabla->horaApertura, 
			'fechaApertura' => ($oTabla->fechaApertura == 0)? Null: $oTabla->fechaApertura, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => 0, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FacturacionCuentasAtencionModificar :totalPorPagar, :idEstado, :totalPagado, :totalAsegurado, :totalExonerado, :horaCierre, :fechaCierre, :horaApertura, :fechaApertura, :idPaciente, :idCuentaAtencion, :fechaCreacion, :idUsuarioAuditoria";

		$params = [
			'totalPorPagar' => ($oTabla->totalPorPagar == 0)? Null: $oTabla->totalPorPagar, 
			'idEstado' => ($oTabla->idEstado == 0)? Null: $oTabla->idEstado, 
			'totalPagado' => ($oTabla->totalPagado == 0)? Null: $oTabla->totalPagado, 
			'totalAsegurado' => ($oTabla->totalAsegurado == 0)? Null: $oTabla->totalAsegurado, 
			'totalExonerado' => ($oTabla->totalExonerado == 0)? Null: $oTabla->totalExonerado, 
			'horaCierre' => ($oTabla->horaCierre == "")? Null: $oTabla->horaCierre, 
			'fechaCierre' => ($oTabla->fechaCierre == 0)? Null: $oTabla->fechaCierre, 
			'horaApertura' => ($oTabla->horaApertura == "")? Null: $oTabla->horaApertura, 
			'fechaApertura' => ($oTabla->fechaApertura == 0)? Null: $oTabla->fechaApertura, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FacturacionCuentasAtencionEliminar :idCuentaAtencion, :idUsuarioAuditoria";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FacturacionCuentasAtencionSeleccionarPorId :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $oTabla->idCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC CuentasAtencionSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarIdPorIdAtencion($lIdAtencion)
	{
		$query = "
			DECLARE @idCuentaAtencion AS Int = :idCuentaAtencion
			SET NOCOUNT ON 
			EXEC CuentasAtencionSeleccionarIdPorIdAtencion :idAtencion, @idCuentaAtencion OUTPUT
			SELECT @idCuentaAtencion AS idCuentaAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
			'idCuentaAtencion' => 0, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function SeleccionarConsultaExterna()
	{
		$query = "
			EXEC CuentasAtencionSeleccionarConsultaExterna ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTopicoEmergencia()
	{
		$query = "
			EXEC CuentasAtencionSeleccionarTopicoEmergencia ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarObservacionEmergencia()
	{
		$query = "
			EXEC CuentasAtencionSeleccionarObservacionEmergencia ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ValidarUsuario()
	{
		$query = "
			EXEC CuentasAtencionSeleccionarHospitalizacion ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarHospitalizacion()
	{
		$query = "
			EXEC CuentasAtencionSeleccionarHospitalizacion ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ValidarCuentaAtencionFacturable($idCuentaAtencion)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function DatosPacientePorIdCuentaAtencion($lIdCuentaAtencion)
	{
		$query = "
			EXEC FacturacionCuentasAtencionDatosPacientePorIdCuentaAtencion :lIdCuentaAtencion";

		$params = [
			'lIdCuentaAtencion' => $lIdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerCuentasAtencionPorHistoriaClinica($nroHistoriaClinica)
	{
		$query = "
			EXEC FacturacionCuentasAtencionObtenerCuentasAtencionPorHistoriaClinica :nroHistoriaClinica";

		$params = [
			'nroHistoriaClinica' => NroHistoriaClinica, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerUltimaCuentaAtencionPorIdPaciente($lIdPaciente)
	{
		$query = "
			EXEC FacturacionCuentasAtencionObtenerUltimaCuentaAtencionPorIdPaciente :lIdPaciente";

		$params = [
			'lIdPaciente' => $lIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerCuentasAtencionPorHistoriaClinicaV2($nroHistoriaClinica)
	{
		$query = "
			EXEC FacturacionCuentasAtencionObtenerCuentasAtencionPorHistoriaClinicaV2 :nroHistoriaClinica";

		$params = [
			'nroHistoriaClinica' => NroHistoriaClinica, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Abrir($oTabla)
	{
		$query = "
			EXEC FacturacionCuentasAtencionAbrir :idCuentaAtencion, :idUsuarioAuditoria";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Cerrar($oTabla)
	{
		$query = "
			EXEC FacturacionCuentasAtencionCerrar :idCuentaAtencion, :idUsuarioAuditoria, :lcHoraCierre, :lnDeudaPendiente";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'lcHoraCierre' => lcHora, 
			'lnDeudaPendiente' => $oTabla->totalPorPagar, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function PendientePagoSeguro($oTabla)
	{
		$query = "
			EXEC FacturacionCuentasAtencionPendientePagoSeguro :idCuentaAtencion, :idUsuarioAuditoria, :lcHoraCierre, :lnDeudaPendiente";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'lcHoraCierre' => lcHora, 
			'lnDeudaPendiente' => $oTabla->totalPorPagar, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Pagada($oTabla)
	{
		$query = "
			EXEC FacturacionCuentasAtencionPagada :idCuentaAtencion, :idUsuarioAuditoria, :lcHoraCierre";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'lcHoraCierre' => lcHora, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Anulada($oTabla)
	{
		$query = "
			EXEC FacturacionCuentasAtencionAnulada :idCuentaAtencion, :idUsuarioAuditoria, :lcHoraCierre, :lnDeudaPendiente";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'lcHoraCierre' => lcHora, 
			'lnDeudaPendiente' => $oTabla->totalPorPagar, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AltaConDeudaYGarante($oTabla)
	{
		$query = "
			EXEC FacturacionCuentasAtencionAltaConDeudaYGarante"    '"FacturacionAltaConDeudaYGarante :idCuentaAtencion, :idUsuarioAuditoria, :lcHoraCierre, :lnDeudaPendiente";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'lcHoraCierre' => lcHora, 
			'lnDeudaPendiente' => $oTabla->totalPorPagar, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}