@php
$ConsumoInsumoClass = \App\Model\WLabConsumoInsumos::class;
$insumos = $ConsumoInsumoClass::insumosDePrueba($movCPT->idProductoCPT);
$pruebaTieneInsumos = $ConsumoInsumoClass::pruebaTieneInsumos($movCPT->idProductoCPT);
$pruebaTieneConsumos = $ConsumoInsumoClass::pruebaTieneConsumos($movLab->IdOrden, $movCPT->idProductoCPT);
$pruebaConsumoCerrado = $ConsumoInsumoClass::pruebaConsumoCerrado($movLab->IdOrden, $movCPT->idProductoCPT);

$disabled = ''; $checked = ''; $title = '';

if( !$pruebaTieneConsumos ){ 
    $checked = 'checked'; 
}

if( !$pruebaTieneInsumos ){ 
    $checked = ''; 
    $disabled = 'disabled'; 
    $title = 'Esta prueba no tiene insumos configurados';
}

if($pruebaConsumoCerrado){ 
    $checked = ''; 
    $disabled = 'disabled'; 
    $title = 'Almacen cerrado';
}

$data = $ConsumoInsumoClass::consumosDePrueba($movLab->IdOrden, $movCPT->idProductoCPT, $insumos, $pruebaTieneConsumos);
// dd($data);

@endphp


<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-flask"></i> Insumos</h3>


        <div class="pull-right box-tools">
            @php
                


            @endphp
            <div class="checkbox" class="">
                <label title="{{$title}}">
                    <input type="checkbox" name="guardarInsumos" value='1' {{$disabled}} 
                        {{$checked}} style='margin-top: 2px;'/> 
                        <span>Registrar</span>
                </label>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed" style="margin-bottom:0px">
                        <tbody>
                            <tr align="center">
                                <td style="vertical-align: middle;">Insumo</td>
                                <td style="vertical-align: middle;">C/U</td>

                                @foreach ($data as $row)
                                <td >
                                    <button type="button" class="btn btn-link" data-toggle="tooltip" data-html="true" title="{{ $row['Empleado']['info'] }}">
                                        {{ $row['Empleado']['Usuario'] }}
                                      </button>
                                </td>  
                                @endforeach
                                
                            </tr>
                            
                            @foreach ($insumos as $insumo)
                            <tr>
                                <td> {{ $insumo->Nombre }}</td>
                                <td> {{ number_format($insumo->Cantidad,0) ."[".$insumo->Unidad."]" }}</td>
                                @foreach ($data as $row)
                                @php

                                    // dd($insumo);
                                    
                                    $IdInsumo = $insumo->IdInsumo;
                                    $cantidadForm = '';
                                    $cantidad = null;
                                    if( isset($row['MisInsumos'][$IdInsumo]['Cantidad']) ){
                                        $cantidad = $row['MisInsumos'][$insumo->IdInsumo]['Cantidad'];
                                        $cantidad = number_format($cantidad,0);
                                        $cantidadForm = $cantidad;
                                    }

                                    if($row['Empleado']['IdEmpleado'] == $user->id_empleado){
                                        $style = "style='width: 54px; text-align: center;' ";
                                        $cantidadForm = "<input $style name='IdInsumos[$IdInsumo]' value='$cantidad' placeholder='0' class='integer'>";
                                    }
                                @endphp
                                <td align="center"> {!! $cantidadForm !!} </td>
                                @endforeach
                            </tr>  
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
        <!-- /.box-body -->
</div>
