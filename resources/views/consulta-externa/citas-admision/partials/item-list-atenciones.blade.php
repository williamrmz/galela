@php
    if(empty($items)) { $items = []; }
@endphp

<table class="table table-condensed table-bordered">
    <thead class="bg-gray">
    <tr align="center">
        <td width="40">Hora</td>
        <td>Cita</td>
        <td></td>
    </tr>
    </thead>
    <tbody class="tbody-atenciones-cronograma-dia">
    @foreach($items as $item)
        <tr>
            <td align="center">
                N° {{ $item["nro_cita"]  }}
                <br>
                {{ $item["hora_inicio"]  }}
            </td>
            <td>
                @if(!empty($item["cita"]))
                    {{ ucase($item["cita"]["EstadoCita"]) }} - {{ $item["atencion"]->Descripcion }} <br>
                    {{ $item["cita"]["HoraInicio"] }} -  {{$item["cita"]["HoraFin"]}} (N° de
                    Cuenta: {{ $item["atencion"]->IdAtencion }}) <br>
                    HC: {{ $item["atencion"]->NroHistoriaClinica }} {{ $item["atencion"]->ApellidoPaterno }} {{ $item["atencion"]->ApellidoMaterno  }} {{ $item["atencion"]->PrimerNombre }}
                @endif
            </td>
            <td width="20px">
                @if(!empty($item["cita"]))

                    <input type="hidden" value="{{ $item["cita"]["IdCita"] }}">
                    <a href="#" class="btn btn-xs btn-default cita-btn-show" title="ver"> <i
                            class="fa fa-fw fa-eye"></i></a>
                    <a href="#" class="btn btn-xs btn-default cita-btn-edit" title="editar"> <i
                            class="fa fa-fw fa-edit"></i></a>
                    <a href="#" class="btn btn-xs btn-default cita-btn-delete" title="eliminar"> <i
                            class="fa fa-fw fa-trash"></i></a>
                @else
                    <a href="#!" class="btn btn-xs btn-default citas-admision-btn-create" title="agregar" data-info="{{ json_encode($item) }}"> <i class="fa fa-fw fa-plus text-green" data-nrocita="{{ $item["nro_cita"]  }}"></i></a>
                @endif

            </td>
        </tr>
    @endforeach

    @empty($items)
        <tr>
            <td colspan="3" align="center">Sin programacion</td>
        </tr>
    @endempty
    </tbody>
</table>
