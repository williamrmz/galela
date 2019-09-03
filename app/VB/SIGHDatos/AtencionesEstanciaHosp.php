<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionesEstanciaHosp extends Model
{
	public function InsertarAtencionesEstancia($oTabla, $tabla2)
	{
		$query = "
			DECLARE @idEstanciaHospitalaria AS Int = :idEstanciaHospitalaria
			SET NOCOUNT ON 
			EXEC AtencionesEstanciaHospitalariaAgregar :diasEstancia, :idAtencion, :idFacturacionServicio, :idMedicoOrdena, :idCama, :idServicio, :horaDesocupacion, :fechaDesocupacion, :horaOcupacion, :fechaOcupacion, :secuencia, @idEstanciaHospitalaria OUTPUT, :llegoAlServicio, :idProducto, :idMedicoOrdenaOrigen, :idDiagnosticoTrasf, :idUsuarioAuditoria
			SELECT @idEstanciaHospitalaria AS idEstanciaHospitalaria";

		$params = [
			'diasEstancia' => ($oTabla->diasEstancia == 0)? Null: $oTabla->diasEstancia, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idFacturacionServicio' => ($oTabla->idFacturacionServicio == 0)? Null: $oTabla->idFacturacionServicio, 
			'idMedicoOrdena' => ($oTabla->idMedicoOrdena == 0)? Null: $oTabla->idMedicoOrdena, 
			'idCama' => ($oTabla->idCama == 0)? Null: $oTabla->idCama, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'horaDesocupacion' => ($oTabla->horaDesocupacion == "")? Null: $oTabla->horaDesocupacion, 
			'fechaDesocupacion' => ($oTabla->fechaDesocupacion == 0)? Null: $oTabla->fechaDesocupacion, 
			'horaOcupacion' => ($oTabla->horaOcupacion == "")? Null: $oTabla->horaOcupacion, 
			'fechaOcupacion' => ($oTabla->fechaOcupacion == 0)? Null: $oTabla->fechaOcupacion, 
			'secuencia' => ($oTabla->secuencia == 0)? Null: $oTabla->secuencia, 
			'idEstanciaHospitalaria' => 0, 
			'llegoAlServicio' => $oTabla->llegoAlServicio, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idMedicoOrdenaOrigen' => ($oTabla->idMedicoOrdenaOrigen == 0)? Null: $oTabla->idMedicoOrdenaOrigen, 
			'idDiagnosticoTrasf' => ($oTabla->idDiagnosticoTrasferencia == 0)? Null: $oTabla->idDiagnosticoTrasferencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function InsertarAtencionesEstanciaSoat($oTabla, $tabla2)
	{
		$query = "
			DECLARE @idEstanciaHospitalaria AS Int = :idEstanciaHospitalaria
			SET NOCOUNT ON 
			EXEC AtencionesEstanciaHospitalariaAgregar :diasEstancia, :idAtencion, :idFacturacionServicio, :idMedicoOrdena, :idCama, :idServicio, :horaDesocupacion, :fechaDesocupacion, :horaOcupacion, :fechaOcupacion, :secuencia, @idEstanciaHospitalaria OUTPUT, :llegoAlServicio, :idProducto, :idMedicoOrdenaOrigen, :idDiagnosticoTrasf, :idUsuarioAuditoria
			SELECT @idEstanciaHospitalaria AS idEstanciaHospitalaria";

		$params = [
			'diasEstancia' => ($oTabla->diasEstancia == 0)? Null: $oTabla->diasEstancia, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idFacturacionServicio' => ($oTabla->idFacturacionServicio == 0)? Null: $oTabla->idFacturacionServicio, 
			'idMedicoOrdena' => ($oTabla->idMedicoOrdena == 0)? Null: $oTabla->idMedicoOrdena, 
			'idCama' => ($oTabla->idCama == 0)? Null: $oTabla->idCama, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'horaDesocupacion' => ($oTabla->horaDesocupacion == "")? Null: $oTabla->horaDesocupacion, 
			'fechaDesocupacion' => ($oTabla->fechaDesocupacion == 0)? Null: $oTabla->fechaDesocupacion, 
			'horaOcupacion' => ($oTabla->horaOcupacion == "")? Null: $oTabla->horaOcupacion, 
			'fechaOcupacion' => ($oTabla->fechaOcupacion == 0)? Null: $oTabla->fechaOcupacion, 
			'secuencia' => ($oTabla->secuencia == 0)? Null: $oTabla->secuencia, 
			'idEstanciaHospitalaria' => 0, 
			'llegoAlServicio' => $oTabla->llegoAlServicio, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idMedicoOrdenaOrigen' => ($oTabla->idMedicoOrdenaOrigen == 0)? Null: $oTabla->idMedicoOrdenaOrigen, 
			'idDiagnosticoTrasf' => ($oTabla->idDiagnosticoTrasferencia == 0)? Null: $oTabla->idDiagnosticoTrasferencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function InsertarAtencionesEstanciaParticular($oTabla, $tabla2)
	{
		$query = "
			DECLARE @idEstanciaHospitalaria AS Int = :idEstanciaHospitalaria
			SET NOCOUNT ON 
			EXEC AtencionesEstanciaHospitalariaAgregar :diasEstancia, :idAtencion, :idFacturacionServicio, :idMedicoOrdena, :idCama, :idServicio, :horaDesocupacion, :fechaDesocupacion, :horaOcupacion, :fechaOcupacion, :secuencia, @idEstanciaHospitalaria OUTPUT, :llegoAlServicio, :idProducto, :idMedicoOrdenaOrigen, :idDiagnosticoTrasf, :idUsuarioAuditoria
			SELECT @idEstanciaHospitalaria AS idEstanciaHospitalaria";

		$params = [
			'diasEstancia' => ($oTabla->diasEstancia == 0)? Null: $oTabla->diasEstancia, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idFacturacionServicio' => ($oTabla->idFacturacionServicio == 0)? Null: $oTabla->idFacturacionServicio, 
			'idMedicoOrdena' => ($oTabla->idMedicoOrdena == 0)? Null: $oTabla->idMedicoOrdena, 
			'idCama' => ($oTabla->idCama == 0)? Null: $oTabla->idCama, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'horaDesocupacion' => ($oTabla->horaDesocupacion == "")? Null: $oTabla->horaDesocupacion, 
			'fechaDesocupacion' => ($oTabla->fechaDesocupacion == 0)? Null: $oTabla->fechaDesocupacion, 
			'horaOcupacion' => ($oTabla->horaOcupacion == "")? Null: $oTabla->horaOcupacion, 
			'fechaOcupacion' => ($oTabla->fechaOcupacion == 0)? Null: $oTabla->fechaOcupacion, 
			'secuencia' => ($oTabla->secuencia == 0)? Null: $oTabla->secuencia, 
			'idEstanciaHospitalaria' => 0, 
			'llegoAlServicio' => $oTabla->llegoAlServicio, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idMedicoOrdenaOrigen' => ($oTabla->idMedicoOrdenaOrigen == 0)? Null: $oTabla->idMedicoOrdenaOrigen, 
			'idDiagnosticoTrasf' => ($oTabla->idDiagnosticoTrasferencia == 0)? Null: $oTabla->idDiagnosticoTrasferencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Insertar($oTabla, $otablaAtencion)
	{
		$query = "
			DECLARE @idEstanciaHospitalaria AS Int = :idEstanciaHospitalaria
			SET NOCOUNT ON 
			EXEC AtencionesEstanciaHospitalariaAgregar :diasEstancia, :idAtencion, :idFacturacionServicio, :idMedicoOrdena, :idCama, :idServicio, :horaDesocupacion, :fechaDesocupacion, :horaOcupacion, :fechaOcupacion, :secuencia, @idEstanciaHospitalaria OUTPUT, :llegoAlServicio, :idProducto, :idMedicoOrdenaOrigen, :idDiagnosticoTrasf, :idUsuarioAuditoria
			SELECT @idEstanciaHospitalaria AS idEstanciaHospitalaria";

		$params = [
			'diasEstancia' => ($oTabla->diasEstancia == 0)? Null: $oTabla->diasEstancia, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idFacturacionServicio' => ($oTabla->idFacturacionServicio == 0)? Null: $oTabla->idFacturacionServicio, 
			'idMedicoOrdena' => ($oTabla->idMedicoOrdena == 0)? Null: $oTabla->idMedicoOrdena, 
			'idCama' => ($oTabla->idCama == 0)? Null: $oTabla->idCama, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'horaDesocupacion' => ($oTabla->horaDesocupacion == "")? Null: $oTabla->horaDesocupacion, 
			'fechaDesocupacion' => ($oTabla->fechaDesocupacion == 0)? Null: $oTabla->fechaDesocupacion, 
			'horaOcupacion' => ($oTabla->horaOcupacion == "")? Null: $oTabla->horaOcupacion, 
			'fechaOcupacion' => ($oTabla->fechaOcupacion == 0)? Null: $oTabla->fechaOcupacion, 
			'secuencia' => ($oTabla->secuencia == 0)? Null: $oTabla->secuencia, 
			'idEstanciaHospitalaria' => 0, 
			'llegoAlServicio' => $oTabla->llegoAlServicio, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idMedicoOrdenaOrigen' => ($oTabla->idMedicoOrdenaOrigen == 0)? Null: $oTabla->idMedicoOrdenaOrigen, 
			'idDiagnosticoTrasf' => ($oTabla->idDiagnosticoTrasferencia == 0)? Null: $oTabla->idDiagnosticoTrasferencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionesEstanciaHospitalariaModificar :diasEstancia, :idAtencion, :idFacturacionServicio, :idMedicoOrdena, :idCama, :idServicio, :horaDesocupacion, :fechaDesocupacion, :horaOcupacion, :fechaOcupacion, :secuencia, :idEstanciaHospitalaria, :llegoAlServicio, :idProducto, :idMedicoOrdenaOrigen, :idDiagnosticoTrasf, :idUsuarioAuditoria";

		$params = [
			'diasEstancia' => ($oTabla->diasEstancia == 0)? Null: $oTabla->diasEstancia, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idFacturacionServicio' => ($oTabla->idFacturacionServicio == 0)? 0: $oTabla->idFacturacionServicio, 
			'idMedicoOrdena' => ($oTabla->idMedicoOrdena == 0)? Null: $oTabla->idMedicoOrdena, 
			'idCama' => ($oTabla->idCama == 0)? Null: $oTabla->idCama, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'horaDesocupacion' => ($oTabla->horaDesocupacion == "")? Null: $oTabla->horaDesocupacion, 
			'fechaDesocupacion' => ($oTabla->fechaDesocupacion == 0)? Null: $oTabla->fechaDesocupacion, 
			'horaOcupacion' => ($oTabla->horaOcupacion == "")? Null: $oTabla->horaOcupacion, 
			'fechaOcupacion' => ($oTabla->fechaOcupacion == 0)? Null: $oTabla->fechaOcupacion, 
			'secuencia' => ($oTabla->secuencia == 0)? Null: $oTabla->secuencia, 
			'idEstanciaHospitalaria' => $oTabla->idEstanciaHospitalaria, 
			'llegoAlServicio' => $oTabla->llegoAlServicio, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idMedicoOrdenaOrigen' => ($oTabla->idMedicoOrdenaOrigen == 0)? Null: $oTabla->idMedicoOrdenaOrigen, 
			'idDiagnosticoTrasf' => ($oTabla->idDiagnosticoTrasferencia == 0)? Null: $oTabla->idDiagnosticoTrasferencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionesEstanciaHospitalariaEliminar :idEstanciaHospitalaria, :idUsuarioAuditoria";

		$params = [
			'idEstanciaHospitalaria' => ($oTabla->idEstanciaHospitalaria == 0)? Null: $oTabla->idEstanciaHospitalaria, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionesEstanciaHospitalariaSeleccionarPorId :idEstanciaHospitalaria";

		$params = [
			'idEstanciaHospitalaria' => $oTabla->idEstanciaHospitalaria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorAtencion($lIdAtencion, $lnSecuenciaMayorA)
	{
		$query = "
			EXEC EstanciaHospitalariaSeleccionarPorAtencion :idAtencion, :secuenciaMayorA";

		$params = [
			'idAtencion' => $lIdAtencion, 
			'secuenciaMayorA' => $lnSecuenciaMayorA, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodosPorCuentaAtencion($lIdCuentaAtencion)
	{
		$query = "
			EXEC AtencionesEstanciaHospitalariaSeleccionarTodosPorCuentaAtencion :lIdCuentaAtencion";

		$params = [
			'lIdCuentaAtencion' => $lIdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarEstanciaHospitalaria($oEstanciaHospitalaria, $oDOAtencion)
	{
		$query = "
			EXEC AtencionesEstanciaHospitalariaEliminaXidAtencion :idAtencion";

		$params = [
			'idAtencion' => $oDOAtencion->idAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarEstanciaHospitalariaParticular($oEstanciaHospitalaria, $oDOAtencion)
	{
		$query = "
			EXEC AtencionesEstanciaHospitalariaEliminaXidAtencion :idAtencion";

		$params = [
			'idAtencion' => $oDOAtencion->idAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarEstanciaHospitalariaSoat($oEstanciaHospitalaria, $oDOAtencion)
	{
		$query = "
			EXEC AtencionesEstanciaHospitalariaEliminaXidAtencion :idAtencion";

		$params = [
			'idAtencion' => $oDOAtencion->idAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AgregarServicioyEstanciaHospitalariaParticular($oDOEstanciaHospitalaria, $oDOAtencion, $oDoFactordenServicio)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AgregarServicioyEstanciaHospitalaria($oDOEstanciaHospitalaria, $oDOAtencion, $oDoFactordenServicio)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarEstanciaHospitalaria($lIdAtencion)
	{
		$query = "
			EXEC AtencionesEstanciaHospitalariaEliminaXidAtencion :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function DevuelveIdProductoSegunIdServicio($lnIdServicio)
	{
		$query = "
			EXEC ServiciosSeleccionarPorId :idServicio";

		$params = [
			'idServicio' => $lnIdServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function DevuelveIdProductoSegunIdServicioSoat($lnIdServicio)
	{
		$query = "
			EXEC ServiciosSeleccionarPorIdparaSOAT :idServicio";

		$params = [
			'idServicio' => $lnIdServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function DevuelveIdProductoSegunIdServicioParticular($lnIdServicio)
	{
		$query = "
			EXEC ServiciosSeleccionarPorIdparaParticular :idServicio";

		$params = [
			'idServicio' => $lnIdServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}