<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOPaciente extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'sectorista', 
		'sector', 
		'madreTipoDocumento', 
		'nroOrdenHijo', 
		'madreSegundoNombre', 
		'madrePrimerNombre', 
		'madreApellidoMaterno', 
		'madreApellidoPaterno', 
		'madreDocumento', 
		'email', 
		'idIdioma', 
		'usoWebReniec', 
		'factorRh', 
		'grupoSanguineo', 
		'idEtnia', 
		'fichaFamiliar', 
		'idDistritoNacimiento', 
		'idDistritoDomicilio', 
		'idDistritoProcedencia', 
		'idUsuarioAuditoria', 
		'idCentroPobladoProcedencia', 
		'idCentroPobladoNacimiento', 
		'nroHistoriaClinica', 
		'idPaisDomicilio', 
		'nombreMadre', 
		'nombrePadre', 
		'idCentroPobladoDomicilio', 
		'idTipoOcupacion', 
		'idDocIdentidad', 
		'idEstadoCivil', 
		'idGradoInstruccion', 
		'idProcedencia', 
		'idTipoSexo', 
		'autogenerado', 
		'telefono', 
		'telefono2', 
		'telefono3', 
		'telefono4', 
		'nroDocumento', 
		'fechaNacimiento', 
		'tercerNombre', 
		'segundoNombre', 
		'primerNombre', 
		'apellidoPaterno', 
		'idPaciente', 
		'idTipoNumeracion', 
		'observacion', 
		'idPaisProcedencia', 
		'idPaisNacimiento', 
		'direccionDomicilio', 
		'apellidoMaterno', 
		'idCentroPobladoDomicilioTutor', 
		'idDistritoDomicilioTutor', 
		'idPaisDomicilioTutor', 
		'direccionDomiciliotutor', 
		'religion', 
	];


	public function filtrar( $nroHistoriaClinica = 0, $apellidoPaterno = '', $apellidoMaterno = '', $primerNombre = '', $segundoNombre = '', $idDocIdentidad = 0, $nroDocumento = '', $fichaFamiliar = '' )
	{
		$page = request()->page;
		$size = 50;
		$rowStart = ($page-1) * $size;

		$params = [ 'size' => $size, 'rowStart' => $rowStart,];

		$queryPag = "ORDER BY dbo.Pacientes.idPaciente OFFSET :rowStart ROWS FETCH NEXT :size ROWS ONLY";

		$querySelect = "SELECT 
		    dbo.Pacientes.IdPaciente, 
			dbo.Pacientes.ApellidoPaterno, 
			dbo.Pacientes.ApellidoMaterno, 
			dbo.Pacientes.PrimerNombre, 
			dbo.Pacientes.SegundoNombre, 
			dbo.Pacientes.NroHistoriaClinica, 
			dbo.Pacientes.fichaFamiliar,
			dbo.Pacientes.FechaNacimiento, 
			dbo.TiposServicio.Descripcion AS TipoServicio, 
			dbo.Servicios.Nombre AS ServicioIngreso, 
			dbo.TiposNumeracionHistoria.Descripcion AS TipoNumeracion, 
			dbo.Pacientes.IdTipoNumeracion, 
			CONVERT(char(10), dbo.Atenciones.FechaIngreso, 103) AS FechaIngreso, 
			CONVERT(char(10), dbo.Atenciones.FechaEgreso, 103) AS FechaEgreso";

		$queryFrom = " FROM dbo.Pacientes 
			LEFT OUTER JOIN dbo.TiposNumeracionHistoria ON dbo.Pacientes.IdTipoNumeracion = dbo.TiposNumeracionHistoria.IdTipoNumeracion
			LEFT OUTER JOIN dbo.Atenciones ON dbo.Pacientes.IdPaciente = dbo.Atenciones.IdPaciente AND dbo.Atenciones.IdAtencion =
															(SELECT MAX(IdAtencion) FROM Atenciones WHERE Atenciones.IdPaciente = Pacientes.IdPaciente) 
			LEFT OUTER JOIN dbo.Servicios ON dbo.Servicios.IdServicio = dbo.Atenciones.IdServicioIngreso 
			LEFT OUTER JOIN dbo.TiposServicio ON dbo.TiposServicio.IdTipoServicio = dbo.Atenciones.IdTipoServicio";

		$queryWhere = " WHERE 1=1 ";


		if( $this->nroHistoriaClinica > 0 ) $queryWhere .= " AND Pacientes.NroHistoriaClinica = $this->nroHistoriaClinica";
		if( $this->fichaFamiliar <> '') $queryWhere .= " AND Pacientes.FichaFamiliar like $fichaFamiliar";
		if( $this->nroDocumento <> '') $queryWhere .= " AND Pacientes.NroDocumento = '$this->nroDocumento' AND Pacientes.idDocIdentidad = $this->idDocIdentidad ";
		if( $this->apellidoPaterno <> '' ) $queryWhere .= " AND Pacientes.ApellidoPaterno like '$this->apellidoPaterno%' ";
		if( $this->apellidoMaterno <> '' ) $queryWhere .= " AND Pacientes.ApellidoMaterno like '$this->apellidoMaterno%' ";
		if( $this->primerNombre <> '' ) $queryWhere .= " AND Pacientes.PrimerNombre like '$this->primerNombre%' ";
		if( $this->segundoNombre <> '' ) $queryWhere .= " AND Pacientes.SegundoNombre like '$this->segundoNombre%' ";

		// dd( $queryWhere );

		$queryItems = $querySelect . $queryFrom . $queryWhere .$queryPag;

		$queryCount = "SELECT count(*) total" . $queryFrom . $queryWhere;

		$items = DB::select( $queryItems, $params );

		$count = DB::select( $queryCount );
		$total = reset( $count )->total; // first element of array

		$pag = new \Illuminate\Pagination\LengthAwarePaginator(
			collect ( $items )->forPage(1, $size),
			$total,
			$size,
			$page
		);

		return $pag;
	}
}