<?php
namespace App\Http\Controllers\ProgramacionGeneral;

use App\Http\Requests\TurnoRequest;
use App\VB\SIGHDatos\Turno;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TurnoController extends Controller
{
	const PATH_VIEW = 'programacion-general.turno.';

	public function index(Request $request)
	{

		if($request->ajax())
		{
            $items = Turno::filtrar($request->search);
			return view(self::PATH_VIEW.'partials.item-list', compact('items'));
		}
		return view(self::PATH_VIEW.'index');
	}

	public function show($id)
    {
        return Turno::find($id);
    }

    public function edit($id)
    {
        abort(404);
    }

    private function fillFromRequest($request, $tempTurno = null)
    {
        $oTurno = ($tempTurno)?$tempTurno:new Turno();
        $oTurno->Codigo = $request->txtCodigo;
        $oTurno->Descripcion = $request->txtDescripcion;
        $oTurno->IdTipoServicio = $request->cmbIdTipoServicio;
        $oTurno->HoraInicio = $request->txtHoraInicio;
        $oTurno->HoraFin = $request->txtHoraFin;
        return $oTurno;
    }

    public function store(TurnoRequest $request)
    {
        try
        {
            $oTurno = $this->fillFromRequest($request);
            $oTurno = $oTurno::guardar($oTurno);
            return imprimeJSON(true, "Registrado correctamente", $oTurno);
        }
        catch (\Exception $e)
        {
            return imprimeJSON(false, $e->getMessage());
        }
    }

    public function update(TurnoRequest $request, Turno $turno)
    {
        try
        {
            $oTurno = $this->fillFromRequest($request, $turno);
            $oTurno = $oTurno::guardar($oTurno);
            return imprimeJSON(true, "Registrado actualizado", $oTurno);
        }
        catch (\Exception $e)
        {
            return imprimeJSON(false, $e->getMessage());
        }
    }

    public function destroy(Turno $turno)
    {
        try
        {
            $turno->delete();
            return imprimeJSON(true, "Registrado eliminado", $turno);
        }
        catch (\Exception $e)
        {
            return imprimeJSON(false, "No es posible eliminar, se está utilizando en otros módulos del sistema.");
        }
    }




}