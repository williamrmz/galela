<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Empleados extends Model
{
    protected $table = 'Empleados';
    protected $primaryKey = 'IdEmpleado';
    public $timestamps = false;

    protected $fillable = [
        "IdEmpleado",
        "ApellidoPaterno",
        "ApellidoMaterno",
        "Nombres",
        "IdCondicionTrabajo",
        "IdTipoEmpleado",
        "DNI",
        "CodigoPlanilla",
        "FechaIngreso",
        "FechaAlta",
        "Usuario",
        "Clave",
        "loginEstado",
        "loginPC",
        "FechaNacimiento",
        "idTipoDestacado",
        "IdEstablecimientoExterno",
        "HisCodigoDigitador",
        "ReniecAutorizado",
        "idTipoDocumento",
        "idSupervisor",
        "RecordarToken",
        "Correo",
        "Firma"
    ];

    protected $hidden =
        [
            "loginEstado",
            "loginPC",
            "Clave",
            "Firma",
            "RecordarToken",
        ];

    protected $appends =
        [
            "nombre_completo",
            "nombre_supervisor"
        ];

    public function getNombreCompletoAttribute()
    {
        return $this->ApellidoPaterno." ".$this->ApellidoMaterno." ".$this->Nombres;
    }

    public function getNombreSupervisorAttribute()
    {
        $oEmpleado = Empleados::find($this->idSupervisor);
        if($oEmpleado)
        {
            return $oEmpleado->ApellidoPaterno." ".$oEmpleado->ApellidoMaterno." ".$oEmpleado->Nombres;
        }
    }

	public function Insertar($oTabla)
	{
	    // 30.01.2020 LA
        if ($oTabla->procedencia=="PROFESIONALESSALUD")
        {
            $oTabla->idTipoDocumento        = $oTabla->idTipoDocumento;
            $oTabla->dNI                    = $oTabla->DNI;
            $oTabla->apellidoPaterno        = $oTabla->ApellidoPaterno;
            $oTabla->apellidoMaterno        = $oTabla->ApellidoMaterno;
            $oTabla->nombres                = $oTabla->Nombres;
            $oTabla->idCondicionTrabajo     = $oTabla->IdCondicionTrabajo;
            $oTabla->idTipoEmpleado         = $oTabla->IdTipoEmpleado;
            $oTabla->fechaNacimiento        = $oTabla->FechaNacimiento;
            $oTabla->codigoPlanilla         = $oTabla->CodigoPlanilla;
            $oTabla->idTipoDestacado        = $oTabla->idTipoDestacado;
            $oTabla->idSupervisor           = $oTabla->idSupervisor;
        }

		$query = "
			DECLARE @idEmpleado AS Int = :idEmpleado
			SET NOCOUNT ON
			EXEC EmpleadosAgregar :usuario, :clave, :fechaAlta, :fechaIngreso, :codigoPlanilla, :dNI, :idTipoEmpleado, :idCondicionTrabajo, :nombres, :apellidoMaterno, :apellidoPaterno, @idEmpleado OUTPUT, :idUsuarioAuditoria, :loginEstado, :loginPC, :fechaNacimiento, :idDestacado, :idEstablecimientoExterno, :hisCodigoDigitador, :reniecAutorizado, :idTipoDocumento, :idSupervisor
			SELECT @idEmpleado AS idEmpleado";

		$params = [
			'usuario' => ($oTabla->usuario == "")? Null: $oTabla->usuario,
			'clave' => ($oTabla->clave == "")? Null: encryptString($oTabla->clave),
			'fechaAlta' => ($oTabla->fechaAlta == 0)? Null: $oTabla->fechaAlta,
			'fechaIngreso' => ($oTabla->fechaIngreso == 0)? Null: $oTabla->fechaIngreso,
			'codigoPlanilla' => ($oTabla->codigoPlanilla == "")? Null: $oTabla->codigoPlanilla,
			'dNI' => ($oTabla->dNI == "")? Null: $oTabla->dNI,
			'idTipoEmpleado' => ($oTabla->idTipoEmpleado == 0)? Null: $oTabla->idTipoEmpleado,
			'idCondicionTrabajo' => ($oTabla->idCondicionTrabajo == 0)? Null: $oTabla->idCondicionTrabajo,
			'nombres' => ($oTabla->nombres == "")? Null: $oTabla->nombres,
			'apellidoMaterno' => ($oTabla->apellidoMaterno == "")? Null: $oTabla->apellidoMaterno,
			'apellidoPaterno' => ($oTabla->apellidoPaterno == "")? Null: $oTabla->apellidoPaterno,
			'idEmpleado' => 0,
			// 'sexo' => ($oTabla->sexo == 0)? Null: $oTabla->sexo,
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria,
			'loginEstado' => 0,
			'loginPC' => "",
			'fechaNacimiento' => ($oTabla->fechaNacimiento == 0)? Null: date('d-m-Y', strtotime($oTabla->fechaNacimiento)),
			'idDestacado' => ($oTabla->idTipoDestacado == 0)? Null: $oTabla->idTipoDestacado,
			'idEstablecimientoExterno' => ($oTabla->idEstablecimientoExterno == 0)? Null: $oTabla->idEstablecimientoExterno,
			'hisCodigoDigitador' => ($oTabla->hisCodigoDigitador == "")? Null: $oTabla->hisCodigoDigitador,
			'reniecAutorizado' => ($oTabla->reniecAutorizado == True)? 1: 0,
			'idTipoDocumento' => ($oTabla->idTipoDocumento == 0)? Null: $oTabla->idTipoDocumento,
			'idSupervisor' => ($oTabla->idSupervisor == 0)? Null: $oTabla->idSupervisor,
			// 'esActivo' => ($oTabla->esActivo == True)? 1: 0,
			// 'accedeVWeb' => ($oTabla->accedeVWeb == True)? 1: 0,
			// 'claveVWeb' => ($oTabla->claveVWeb == "")? 1: $oTabla->claveVWeb,
			// 'telefono' => ($oTabla->telefono == "")? 1: $oTabla->telefono,
			// 'correo' => ($oTabla->correo == "")? 1: $oTabla->correo,
		];
		// dd($params);

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		// dd($oTabla);
		$query = "
			EXEC EmpleadosModificar :usuario, :clave, :fechaAlta, :fechaIngreso, :codigoPlanilla, :dNI, :idTipoEmpleado, :idCondicionTrabajo, :nombres, :apellidoMaterno, :apellidoPaterno, :idEmpleado, :idUsuarioAuditoria, :loginEstado, :loginPC, :fechaNacimiento, :idDestacado, :idEstablecimientoExterno, :hisCodigoDigitador, :reniecAutorizado, :idTipoDocumento, :idSupervisor";

		$params = [
			'usuario' => ($oTabla->usuario == "")? Null: $oTabla->usuario,
			'clave' => ($oTabla->clave == "")? Null: encryptString($oTabla->clave),
			'fechaAlta' => ($oTabla->fechaAlta == 0)? Null: $oTabla->fechaAlta,
			'fechaIngreso' => ($oTabla->fechaIngreso == 0)? Null: $oTabla->fechaIngreso,
			'codigoPlanilla' => ($oTabla->codigoPlanilla == "")? Null: $oTabla->codigoPlanilla,
			'dNI' => ($oTabla->dNI == "")? Null: $oTabla->dNI,
			'idTipoEmpleado' => ($oTabla->idTipoEmpleado == 0)? Null: $oTabla->idTipoEmpleado,
			'idCondicionTrabajo' => ($oTabla->idCondicionTrabajo == 0)? Null: $oTabla->idCondicionTrabajo,
			'nombres' => ($oTabla->nombres == "")? Null: $oTabla->nombres,
			'apellidoMaterno' => ($oTabla->apellidoMaterno == "")? Null: $oTabla->apellidoMaterno,
			'apellidoPaterno' => ($oTabla->apellidoPaterno == "")? Null: $oTabla->apellidoPaterno,
			'idEmpleado' => ($oTabla->idEmpleado == 0)? Null: $oTabla->idEmpleado,
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria,
			'loginEstado' => $oTabla->loginEstado,
			'loginPC' => $oTabla->loginPc,
			'fechaNacimiento' => ($oTabla->fechaNacimiento == 0)? Null: date('d-m-Y', strtotime($oTabla->fechaNacimiento)),
			'idDestacado' => ($oTabla->idTipoDestacado == 0)? Null: $oTabla->idTipoDestacado,
			'idEstablecimientoExterno' => ($oTabla->idEstablecimientoExterno == 0)? Null: $oTabla->idEstablecimientoExterno,
			'hisCodigoDigitador' => ($oTabla->hisCodigoDigitador == "")? Null: $oTabla->hisCodigoDigitador,
			'reniecAutorizado' => ($oTabla->reniecAutorizado == True)? 1: 0,
			'idTipoDocumento' => ($oTabla->idTipoDocumento == 0)? Null: $oTabla->idTipoDocumento,
			'idSupervisor' => ($oTabla->idSupervisor == 0)? Null: $oTabla->idSupervisor,
			// 'esActivo' => ($oTabla->esActivo == True)? 1: 0,
			// 'accedeVWeb' => ($oTabla->accedeVWeb == True)? 1: 0,
			// 'claveVWeb' => ($oTabla->claveVWeb == "")? Null: $oTabla->claveVWeb,
			// 'telefono' => ($oTabla->telefono == "")? 1: $oTabla->telefono,
			// 'correo' => ($oTabla->correo == "")? 1: $oTabla->correo,
			// 'sexo' => ($oTabla->sexo == 0)? Null: $oTabla->sexo,
		];
		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC EmpleadosEliminar :idEmpleado, :idUsuarioAuditoria";

		$params = [
			'idEmpleado' => ($oTabla->idEmpleado == 0)? Null: $oTabla->idEmpleado,
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria,
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC EmpleadosSeleccionarPorId :idEmpleado";

		$params = [
			'idEmpleado' => $oTabla->idEmpleado,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC EmpleadosSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oDOEmpleado)
	{

		$sSql = "";
		$sWhere = "";

		if ($oDOEmpleado->apellidopaterno <> "") {
			$sWhere = $sWhere . " Empleados.ApellidoPaterno like '" . $oDOEmpleado->apellidopaterno . "%' and ";
		}
		if ($oDOEmpleado->apellidomaterno <> "") {
			$sWhere = $sWhere . " Empleados.ApellidoMaterno like '" . $oDOEmpleado->apellidomaterno . "%' and ";
		}
		if ($oDOEmpleado->nombres <> "") {
			$sWhere = $sWhere . " Empleados.Nombres like '%" . $oDOEmpleado->nombres . "%' and ";
		}
		if ($oDOEmpleado->codigoPlanilla <> "") {
			$sWhere = $sWhere . " Empleados.CodigoPlanilla = '" . $oDOEmpleado->codigoPlanilla . "' and ";
		}
		if ($sWhere <> "") {
			$size = strlen($sWhere);
			$sSql = $sSql . " where " . substr($sWhere, 0, $size-4);
		}

		$sSql = $sSql . " order by Empleados.ApellidoPaterno, Empleados.ApellidoMaterno, Empleados.Nombres";

		// dd($sSql);

		$query = "
			EXEC EmpleadosFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => $sSql,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigo($oDOEmpleado)
	{
		$query = "
			EXEC EmpleadosXcodigoPlanilla :codigoPlanilla";

		$params = [
			'codigoPlanilla' => $oDOEmpleado->codigoPlanilla,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerConElMismoCodigoPlanilla($oTabla)
	{
		$query = "
			EXEC EmpleadosXidentificadorYcodigoPlanilla :idEmpleado, :codigoPlanilla";

		$params = [
			'idEmpleado' => $oTabla->idEmpleado,
			'codigoPlanilla' => $oTabla->codigoPlanilla,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

    public static function ObtenerConElMismoCodigoPlanillaGood($idEmpleado, $codigoPlanilla)
    {
        $query = "
			EXEC EmpleadosXidentificadorYcodigoPlanilla :idEmpleado, :codigoPlanilla";

        $params = [
            'idEmpleado' => $idEmpleado,
            'codigoPlanilla' => $codigoPlanilla,
        ];

        $data = \DB::select($query, $params);
        return $data;
    }

	public function ObtenerConElMismoUsuario($idEmpleado, $usuario)
	{
		$query = "
			EXEC EmpleadosXidentificadorYusuario :idEmpleado, :usuario";

		$params = [
			'idEmpleado' => $idEmpleado,
			'usuario' => $usuario,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Autenticar($sUsuario)
	{
		$query = "
			EXEC EmpleadosXusuario1 :sUsuario";

		$params = [
			'sUsuario' => $sUsuario,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AutenticarMaquina($sUsuario, $nMaquina)
	{
		$query = "
			EXEC EmpleadosXusuario1 :sUsuario";

		$params = [
			'sUsuario' => $sUsuario,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarParaExoneracionServicio($lIdCuentaAtencion, $lIdEmpleadoActual)
	{
		$query = "
			EXEC EmpleadosXidentificadorYCuentaExonera :lIdEmpleadoActua, :lIdCuentaAtencion";

		$params = [
			'lIdEmpleadoActua' => $lIdEmpleadoActual,
			'lIdCuentaAtencion' => $lIdCuentaAtencion,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarParaPendientePagoServicio($lIdCuentaAtencion, $lIdEmpleadoActual)
	{
		$query = "
			EXEC EmpleadosXidentificadorYCuentaAutorizaPendiente :lIdEmpleadoActual, :lIdCuentaAtencion";

		$params = [
			'lIdEmpleadoActual' => $lIdEmpleadoActual,
			'lIdCuentaAtencion' => $lIdCuentaAtencion,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarParaModificacionDeCuentaServicio($lIdCuentaAtencion, $lIdEmpleadoActual)
	{
		$query = "
			EXEC EmpleadosSeleccionarParaModificacionDeCuentaServicio :lIdEmpleadoActual, :lIdCuentaAtencion";

		$params = [
			'lIdEmpleadoActual' => $lIdEmpleadoActual,
			'lIdCuentaAtencion' => $lIdCuentaAtencion,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarParaExoneracionBienesInsumos($lIdCuentaAtencion, $lIdEmpleadoActual)
	{
		$query = "
			EXEC EmpleadosSeleccionarParaExoneracionBienesInsumos :lIdEmpleadoActual, :lIdCuentaAtencion";

		$params = [
			'lIdEmpleadoActual' => $lIdEmpleadoActual,
			'lIdCuentaAtencion' => $lIdCuentaAtencion,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarParaPendientePagoBienesInsumos($lIdCuentaAtencion, $lIdEmpleadoActual)
	{
		$query = "
			EXEC EmpleadosSeleccionarParaPendientePagoBienesInsumos :lIdEmpleadoActual, :lIdCuentaAtencion";

		$params = [
			'lIdEmpleadoActual' => $lIdEmpleadoActual,
			'lIdCuentaAtencion' => $lIdCuentaAtencion,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarParaModificacionDeCuentaBienesInsumos($lIdCuentaAtencion, $lIdEmpleadoActual)
	{
		$query = "
			EXEC EmpleadosSeleccionarParaModificacionDeCuentaBienesInsumos :lIdEmpleadoActual, :lIdCuentaAtencion";

		$params = [
			'lIdEmpleadoActual' => $lIdEmpleadoActual,
			'lIdCuentaAtencion' => $lIdCuentaAtencion,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerConElMismoDNI($lcDNI, $lnIdTipoDocumento)
	{
		$query = "
			EXEC EmpleadosObtenerConElMismoDNI :lnIdTipoDocumento, :lcDNI";

		$params = [
			'lnIdTipoDocumento' => $lnIdTipoDocumento,
			'lcDNI' => $lcDNI,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public static function ObtenerConLaMismaCOLEGIATURA($lcCOLEGIATURA)
	{
		$query = "
			EXEC EmpleadosXcolegiatura :lcCOLEGIATURA";

		$params = [
			'lcCOLEGIATURA' => $lcCOLEGIATURA,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function InsertarVisitas($oTabla)
	{
		$query = "
			DECLARE @idSeguridad AS Int = :idSeguridad
			SET NOCOUNT ON
			EXEC SeguridadAgregar @idSeguridad OUTPUT, :idEmpleado, :usuario, :clave, :nombres, :apellidoMaterno, :apellidoPaterno, :esActivo
			SELECT @idSeguridad AS idSeguridad";

		$params = [
			'idSeguridad' => 0,
			'idEmpleado' => ($oTabla->idEmpleado == 0)? Null: $oTabla->idEmpleado,
			'usuario' => ($oTabla->usuario == "")? Null: $oTabla->usuario,
			'clave' => ($oTabla->claveVWeb == "")? 1: $oTabla->claveVWeb,
			'nombres' => ($oTabla->nombres == "")? Null: $oTabla->nombres,
			'apellidoMaterno' => ($oTabla->apellidomaterno == "")? Null: $oTabla->apellidomaterno,
			'apellidoPaterno' => ($oTabla->apellidopaterno == "")? Null: $oTabla->apellidopaterno,
			'esActivo' => ($oTabla->esActivo == True)? 1: 0,
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function ModificarVisitas($oTabla)
	{
		$query = "
			EXEC SeguridadModificar :idEmpleado, :usuario, :clave, :nombres, :apellidoMaterno, :apellidoPaterno, :esActivo";

		$params = [
			'idEmpleado' => ($oTabla->idEmpleado == 0)? Null: $oTabla->idEmpleado,
			'usuario' => ($oTabla->usuario == "")? Null: $oTabla->usuario,
			'clave' => ($oTabla->claveVWeb == "")? 1: $oTabla->claveVWeb,
			'nombres' => ($oTabla->nombres == "")? Null: $oTabla->nombres,
			'apellidoMaterno' => ($oTabla->apellidomaterno == "")? Null: $oTabla->apellidomaterno,
			'apellidoPaterno' => ($oTabla->apellidopaterno == "")? Null: $oTabla->apellidopaterno,
			'esActivo' => ($oTabla->esActivo == True)? 1: 0,
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Listar_Usuarios()
	{
		$query = "
			EXEC ListarMedicosEgreso ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RetornaIdEmpleadoInterconsulta($sUsuario)
	{
		$query = "
			EXEC RetornaIdEmpleadoInterconsulta :idempleado";

		$params = [
			'idempleado' => $sUsuario,
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}