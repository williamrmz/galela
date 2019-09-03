<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionesNacimientos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idNacimiento AS Int = :idNacimiento
			SET NOCOUNT ON 
			EXEC AtencionesNacimientosAgregar :idAtencion, :idCondicionRN, :idTipoSexo, :peso, :talla, :edadSemanas, :fechaNacimiento, @idNacimiento OUTPUT, :apgar_1, :apgar_5, :clamplajeFecha, :nroOrdenHijoEnParto, :nroOrdenHijo, :idPacienteNacido, :docIdentidad, :idDocIdentidad, :idUsuarioAuditoria
			SELECT @idNacimiento AS idNacimiento";

		$params = [
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idCondicionRN' => ($oTabla->idCondicionRN == 0)? Null: $oTabla->idCondicionRN, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'peso' => ($oTabla->peso == 0)? Null: $oTabla->peso, 
			'talla' => ($oTabla->talla == 0)? Null: $oTabla->talla, 
			'edadSemanas' => $oTabla->edadSemanas, 
			'fechaNacimiento' => ($oTabla->fechaNacimiento == 0)? Null: $oTabla->fechaNacimiento, 
			'idNacimiento' => 0, 
			'apgar_1' => ($oTabla->apgar_1 == 0)? Null: $oTabla->apgar_1, 
			'apgar_5' => ($oTabla->apgar_5 == 0)? Null: $oTabla->apgar_5, 
			'clamplajeFecha' => ($oTabla->clamplajeFecha == 0)? Null: $oTabla->clamplajeFecha, 
			'nroOrdenHijoEnParto' => ($oTabla->nroOrdenHijoEnParto == 0)? Null: $oTabla->nroOrdenHijoEnParto, 
			'nroOrdenHijo' => ($oTabla->nroOrdenHijo == 0)? Null: $oTabla->nroOrdenHijo, 
			'idPacienteNacido' => ($oTabla->idPacienteNacido == 0)? Null: $oTabla->idPacienteNacido, 
			'docIdentidad' => ($oTabla->docIdentidad == "")? Null: $oTabla->docIdentidad, 
			'idDocIdentidad' => ($oTabla->idDocIdentidad == 0)? Null: $oTabla->idDocIdentidad, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionesNacimientosModificar :idAtencion, :idCondicionRN, :idTipoSexo, :peso, :talla, :edadSemanas, :fechaNacimiento, :idNacimiento, :apgar_1, :apgar_5, :clamplajeFecha, :nroOrdenHijoEnParto, :nroOrdenHijo, :idPacienteNacido, :docIdentidad, :idDocIdentidad, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idCondicionRN' => ($oTabla->idCondicionRN == 0)? Null: $oTabla->idCondicionRN, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'peso' => ($oTabla->peso == 0)? Null: $oTabla->peso, 
			'talla' => ($oTabla->talla == 0)? Null: $oTabla->talla, 
			'edadSemanas' => $oTabla->edadSemanas, 
			'fechaNacimiento' => ($oTabla->fechaNacimiento == 0)? Null: $oTabla->fechaNacimiento, 
			'idNacimiento' => ($oTabla->idNacimiento == 0)? Null: $oTabla->idNacimiento, 
			'apgar_1' => ($oTabla->apgar_1 == 0)? Null: $oTabla->apgar_1, 
			'apgar_5' => ($oTabla->apgar_5 == 0)? Null: $oTabla->apgar_5, 
			'clamplajeFecha' => ($oTabla->clamplajeFecha == 0)? Null: $oTabla->clamplajeFecha, 
			'nroOrdenHijoEnParto' => ($oTabla->nroOrdenHijoEnParto == 0)? Null: $oTabla->nroOrdenHijoEnParto, 
			'nroOrdenHijo' => ($oTabla->nroOrdenHijo == 0)? Null: $oTabla->nroOrdenHijo, 
			'idPacienteNacido' => ($oTabla->idPacienteNacido == 0)? Null: $oTabla->idPacienteNacido, 
			'docIdentidad' => ($oTabla->docIdentidad == "")? Null: $oTabla->docIdentidad, 
			'idDocIdentidad' => ($oTabla->idDocIdentidad == 0)? Null: $oTabla->idDocIdentidad, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionesNacimientosEliminar :idNacimiento, :idUsuarioAuditoria";

		$params = [
			'idNacimiento' => ($oTabla->idNacimiento == 0)? Null: $oTabla->idNacimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionesNacimientosSeleccionarPorId :idNacimiento";

		$params = [
			'idNacimiento' => $oTabla->idNacimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorAtencion($lIdAtencion)
	{
		$query = "
			EXEC AtencionesNacimientosSeleccionarPorAtencion :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarNacimientosAtencion($oNacimientos, $lIdAtencion)
	{
		$query = "
			EXEC AtencionesNacimientosEliminarXIdAtencion :lIdAtencion";

		$params = [
			'lIdAtencion' => $lIdAtencion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function EliminarNacimientosPorAtencion($lIdAtencion)
	{
		$query = "
			EXEC AtencionesNacimientosEliminarXIdAtencion :lIdAtencion";

		$params = [
			'lIdAtencion' => $lIdAtencion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function AsignaNULLidPacienteNacido($lnIdPaciente)
	{
		$query = "
			EXEC AtencionesNacimientosAsignaNULLidPacienteNacido :idPaciente";

		$params = [
			'idPaciente' => $lnIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}