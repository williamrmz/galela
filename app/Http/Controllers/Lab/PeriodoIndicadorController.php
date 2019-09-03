<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\LabGrupos as Area;
use App\Model\WLabPeriodos as Periodo;
use App\Model\WLabIndicadores as Indicador;
use App\Model\WLabPeriodosDias as PeriodoDia;
Use DB;

use Illuminate\Validation\Rule;

class PeriodoIndicadorController extends Controller
{
    const PATH_VIEW = 'laboratorio.patologia-clinica.periodo-indicadores.';

    public function index(Request $request)
    {
        if(request()->ajax()) {
            $periodos = Periodo::orderBy('IdPeriodo', 'desc')->paginate(3);
            return view(self::PATH_VIEW.'partials.tabla-periodos', compact('periodos'));
        }
        return view(self::PATH_VIEW.'index');
    }

    public function create()
    {
        if(request()->ajax()) {
            $areas = Area::orderBy('NombreGrupo', 'asc')->get();
            $areas = $areas->pluck('NombreGrupo', 'idGrupo');
            $meses = Periodo::meses();
            $anios = Periodo::anios();
            return view(self::PATH_VIEW.'partials.form-create', compact('areas', 'meses', 'anios'));
        }
    }

    public function store(Request $request)
    {
        if(request()->ajax()) {
            $this->validate($request, [
                'IdArea' => 'required',
                'Mes' => 'required',
                'Anio' => 'required',

                'IdArea' => Rule::unique('WLabPeriodos')->where(function ($query) use($request) {
                    return $query->where('IdArea', $request->IdArea)
                                ->where('Anio', $request->Anio)
                                ->where('Mes', $request->Mes);
                }),
            ], [
                'IdArea.unique' => 'El periodo ya existe',
            ]);


            $periodo = new Periodo;
            $periodo->IdArea = $request->IdArea;
            $periodo->Mes = $request->Mes;
            $periodo->Anio = $request->Anio;
            $periodo->Descrip = $request->Descrip;
            $periodo->NumDias = Periodo::calNumDias($request->Anio, $request->Mes);

            DB::beginTransaction();
            try {
                $saved = $periodo->save();
                $this->storePeriodoDetallle($periodo);
                DB::commit();
                return ['success' => true,];
            } catch (\Exception $e) {
                DB::rollback();
                return ['success' => false, 'message'=>'Falló la transaccion'];
            }

        }
    }

    public function show($id)
    {
        $periodo = Periodo::find($id);

        $periodoDias = DB::table('WLabPeriodosDias as pd')->where('IdPeriodo', $id)
            ->leftJoin('WLabIndicadores as i', 'i.IdIndicador', 'pd.IdIndicador')
            ->select('i.Nombre as NombreIndicador', 'pd.*')
            ->orderBy('pd.IdIndicador', 'asc')->get();

        $data = [];
        foreach($periodoDias as $dia)
        {
            $data[$dia->IdIndicador]['inicador_id'] = $dia->IdIndicador;
            $data[$dia->IdIndicador]['indicador_nombre'] = $dia->NombreIndicador;
            $data[$dia->IdIndicador]['dias'][] = $dia ;
        }
        $data = json_decode(json_encode($data));

        // dd($data);

        return view(self::PATH_VIEW.'show', compact('periodo', 'data'));
    }

    public function edit($id)
    {
        if(request()->ajax()) {
            $periodo = Periodo::findOrFail($id);
            $areas = Area::orderBy('NombreGrupo', 'asc')->get();
            $areas = $areas->pluck('NombreGrupo', 'idGrupo');
            $meses = Periodo::meses();
            $anios = Periodo::anios();
            return view(self::PATH_VIEW.'partials.form-edit', compact('periodo','areas', 'meses', 'anios'));
        }
    }

    public function sumary($id)
    {
        $periodo = Periodo::findOrFail($id);

        $sql = "SELECT 
                i.IdIndicador, i.Nombre NombreIndicador,
                ig.IdIndicadorGrupo, ig.nombre NombreIndicadorGrupo,
                SUM( CAST(pd.Valor AS DECIMAL)) Suma, AVG(CAST(pd.Valor AS DECIMAL)) Promedio, 
                ( 
                        SELECT SUM(CAST(d.Valor AS DECIMAL)) 
                        FROM WLabPeriodosDias d 
                        WHERE d.IdPeriodo = $id 
                ) Total 
                FROM WLabPeriodosDias pd
                LEFT JOIN WLabIndicadores i ON (i.IdIndicador = pd.IdIndicador)
                LEFT JOIN WLabIndicadoresGrupos ig ON (ig.IdIndicadorGrupo = i.IdIndicadorGrupo)
                WHERE pd.IdPeriodo = $id
                GROUP BY i.IdIndicador, i.Nombre, ig.IdIndicadorGrupo, ig.Nombre
                ORDER BY ig.IdIndicadorGrupo";

        $data = DB::select($sql);
        $indicadores = [];
        foreach($data as $row){
            $indicadores[$row->IdIndicadorGrupo]['IdGrupo'] = $row->IdIndicadorGrupo;
            $indicadores[$row->IdIndicadorGrupo]['Nombre'] = $row->NombreIndicadorGrupo;
            $indicadores[$row->IdIndicadorGrupo]['indicadores'][] = $row;
        }
        $grupos = json_decode( json_encode($indicadores) );
        // dd($indicadores);
        return view(self::PATH_VIEW.'sumary', compact('periodo', 'grupos'));
    }

    public function update(Request $request, $id)
    {
        if(request()->ajax()) {
            $this->validate($request, [
                'IdArea' => 'required',
                'Mes' => 'required',
                'Anio' => 'required',

                'IdArea' => Rule::unique('WLabPeriodos')->where(function ($query) use($request, $id) {
                    return $query->where('IdArea', $request->IdArea)
                                ->where('Anio', $request->Anio)
                                ->where('Mes', $request->Mes)
                                ->where('IdPeriodo', '<>', $id);
                }),
            ], [
                'IdArea.unique' => 'El periodo ya existe',
            ]);

            $periodo = Periodo::find($id);
            $periodo->IdArea = $request->IdArea;
            $periodo->Mes = $request->Mes;
            $periodo->Anio = $request->Anio;
            $periodo->Descrip = $request->Descrip;
            $periodo->NumDias = Periodo::calNumDias($request->Anio, $request->Mes);

            DB::beginTransaction();
            try {
                $saved = $periodo->save();
                $this->storePeriodoDetallle($periodo);
                DB::commit();
                return ['success' => true,];
            } catch (\Exception $e) {
                DB::rollback();
                return ['success' => false, 'message'=>'Falló la transaccion'];
            }
        }
    }

    public function delete($id)
    {
        if(request()->ajax()) {
            $periodo = Periodo::findOrFail($id);
            $areas = Area::orderBy('NombreGrupo', 'asc')->get();
            $areas = $areas->pluck('NombreGrupo', 'idGrupo');
            $meses = Periodo::meses();
            $anios = Periodo::anios();
            return view(self::PATH_VIEW.'partials.form-delete', compact('periodo','areas', 'meses', 'anios'));
        }
    }

    public function destroy($id)
    {
        if(request()->ajax()) {
            $periodo = Periodo::findOrFail($id);

            DB::beginTransaction();
            try {
                PeriodoDia::where('IdPeriodo', $periodo->IdPeriodo)->delete();
                $periodo->delete();
                DB::commit();
                return ['success' => true];
            } catch (\Exception $e) {
                DB::rollback();
                return ['success' => false, 'message'=>'Falló la transaccion'];
            }

            return ['success' => $deleted];
        }
    }

    private function storePeriodoDetallle($periodo)
    {
        PeriodoDia::where('IdPeriodo', $periodo->IdPeriodo)->delete();

        $indicadores = Indicador::all();
        $numDias = $periodo->NumDias;
        $detalles = [];

        foreach ( $indicadores as $indicador)
        {
            for($i=1; $i<=$numDias; $i++){
                $detalles[] = [
                    'IdPeriodo' => $periodo->IdPeriodo,
                    'IdIndicador' => $indicador->IdIndicador,
                    'Dia' => $i,
                    'Valor' => rand(0,5),
                    // 'Valor' => 0,
                ];
            }
        }

        $bloques = array_chunk($detalles, 500, true);

        foreach($bloques as $bloque)
        {
            PeriodoDia::insert($bloque);
        }
    }

    public function updatePeriodoDia(Request $request)
    {
        if(request()->ajax()) {
            $this->validate($request, [
                'IdPeriodoDia' => 'required',
                'Valor' => 'required',
            ]);

            $periodoDia = PeriodoDia::find($request->IdPeriodoDia);
            $periodoDia->Valor = $request->Valor;
            $saved = $periodoDia->save();
            return ['success' => $saved];
        }
    }
}
