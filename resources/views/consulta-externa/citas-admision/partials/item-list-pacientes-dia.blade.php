@php
    if(empty($items)) { $items = []; }
@endphp

<table class="table table-condensed table-bordered">
    <thead class="bg-purple disabled">
    <tr>
        <td>HI</td>
        <td>HI</td>
        <td>A.Paterno</td>
        <td>A.Materno</td>
        <td>Nombre</td>
        <td>Fecha</td>
        <td>Hora</td>
    </tr>
    </thead>
    <tbody class="tbody-atenciones-listado-dia">
    @foreach($items as $item)
        <tr>
            <td>{{ $item->HoraInicio }}</td>
            <td>{{ $item->HoraFin }}</td>
            <td>{{ $item->ApellidoPaterno }}</td>
            <td>{{ $item->ApellidoMaterno }}</td>
            <td>{{ $item->PrimerNombre }}</td>
            <td>{{ $item->FechaSolicitud }}</td>
            <td>{{ $item->HoraSolicitud }}</td>
        </tr>
    @endforeach

    @empty($items)
        <tr>
            <td colspan="7" align="center">Sin programacion</td>
        </tr>
    @endempty
    </tbody>
</table>
