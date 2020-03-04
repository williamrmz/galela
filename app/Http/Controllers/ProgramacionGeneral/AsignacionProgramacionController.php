<?php

namespace App\Http\Controllers\ProgramacionGeneral;

use App\Http\Controllers\Controller;
use App\AsignacionProgramacion;
use App\Http\Requests\AsignacionRequest;
use App\RolProgramacion;
use App\VB\SIGHDatos\DepartamentosHospital;
use App\VB\SIGHDatos\Servicios;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsignacionProgramacionController extends Controller
{
    const PATH_VIEW = 'programacion-general.asignacion.';

    public function index()
    {
        $items = AsignacionProgramacion::simplePaginate(15);
        return view(self::PATH_VIEW."index", compact('items'));
    }

    public function create()
    {
        return view(self::PATH_VIEW."create");
    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function store(AsignacionRequest $request)
    {
        
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

    public function apiService(Request $request)
    {
        $name = $request->name;
        switch ($name)
        {
            case 'getCombos':
            {
                return $this->getCombos();
            }
            case 'getComboServicio':
            {
                $idDepartamento = $request->idDepartamento;
                return $this->getComboServicios($idDepartamento);
            }
        }
    }

    public function getCombos()
    {
        $data["cmbIdRol"]            = $this->geCombotRol();
        $data["cmbIdEmpleado"]       = $this->getComboEmpleadosSalud();
        $data["cmbIdDepartamento"]   = $this->getComboDepartamento();
        $data["cmbIdServicio"]       = $this->getComboServicios(null);
        return $data;
    }

    public function geCombotRol()
    {
        $data = RolProgramacion::orderBy('Descripcion', 'asc')->get();
        $opcionBlanco = new RolProgramacion();
        $opcionBlanco->IdRol = "";
        $opcionBlanco->Descripcion = "...";
        $data->prepend($opcionBlanco);

        foreach ($data as $item)
        {
            $item->id   = $item->IdRol;
            $item->text = $item->Descripcion;
        }

        return $data;
    }

    public function getComboEmpleadosSalud()
    {
        $sql = "select e.IdEmpleado, e.ApellidoPaterno, e.ApellidoMaterno, e.Nombres, m.IdMedico from empleados e inner join Medicos m on e.IdEmpleado = m.IdEmpleado";
        $data = DB::select($sql);
        foreach ($data as $item)
        {
            $item->id = $item->IdEmpleado;
            $item->text = strtoupper($item->ApellidoPaterno ." ". $item->ApellidoMaterno.", ". $item->Nombres);
            unset($item->ApellidoPaterno, $item->ApellidoMaterno, $item->Nombres);
        }
        return $data;
    }

    public function getComboDepartamento()
    {
        $ids = [1, 2, 3, 4, 52, 55, 5, 9, 56, 58, 59, 7, 8];
        $data = DepartamentosHospital::whereIn("IdDepartamento", $ids)->orderBy('IdDepartamento', 'asc')->get();

        foreach ($data as $item)
        {
            $item->id   = $item->IdDepartamento;
            $item->text = $item->id ." = ". $item->Nombre;
        }

        $opcionBlanco = new DepartamentosHospital();
        $opcionBlanco->id = "";
        $opcionBlanco->text = "...";
        $data->prepend($opcionBlanco);

        return $data;
    }

    public function getComboServicios($idDepartamento)
    {
        $sql = "select IdServicio, Nombre from v_servicios where IdDepartamento = ?";
        $data = DB::select($sql, [$idDepartamento]);
        foreach ($data as $item)
        {
            $item->id   = $item->IdServicio;
            $item->text = $item->id ." = ". $item->Nombre;
        }

        $opcionBlanco = collect(["id" => "", "text" => "..."]);
        array_unshift($data, $opcionBlanco);


        return $data;
    }
}
