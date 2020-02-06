<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    protected $table = "Pacientes";

    protected $primaryKey = 'IdPaciente';

    protected $fillable = [
        "IdPaciente",
        "ApellidoPaterno",
        "ApellidoMaterno",
        "PrimerNombre",
        "SegundoNombre",
        "TercerNombre",
        "FechaNacimiento",
        "NroDocumento",
        "Telefono",
        "DireccionDomicilio",
        "Autogenerado",
        "IdTipoSexo",
        "IdProcedencia",
        "IdGradoInstruccion",
        "IdEstadoCivil",
        "IdDocIdentidad",
        "IdTipoOcupacion",
        "IdCentroPobladoNacimiento",
        "IdCentroPobladoDomicilio",
        "NombrePadre",
        "NombreMadre",
        "NroHistoriaClinica",
        "IdTipoNumeracion",
        "IdCentroPobladoProcedencia",
        "Observacion",
        "IdPaisDomicilio",
        "IdPaisProcedencia",
        "IdPaisNacimiento",
        "IdDistritoProcedencia",
        "IdDistritoDomicilio",
        "IdDistritoNacimiento",
        "FichaFamiliar",
        "IdEtnia",
        "GrupoSanguineo",
        "FactorRh",
        "UsoWebReniec",
        "IdIdioma",
        "Email",
        "madreDocumento",
        "madreApellidoPaterno",
        "madreApellidoMaterno",
        "madrePrimerNombre",
        "madreSegundoNombre",
        "NroOrdenHijo",
        "madreTipoDocumento",
        "Sector",
        "Sectorista",
    ];
}
