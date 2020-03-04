@php
    if(empty($items)) { $items = []; }
@endphp

<table class="table table-condensed table-bordered">
    <thead class="bg-purple disabled">
    <tr>
        <td>Código</td>
        <td>Nombre</td>
        <td>Distrito</td>
        <td>Provincia</td>
        <td>Departamento</td>
        <td></td>
    </tr>
    </thead>
    <tbody class="tbody-atenciones-listado-dia">
    @foreach($items as $item)
        <tr>
            <td>{{ $item->Codigo }}</td>
            <td>{{ $item->Nombre }}</td>
            <td>{{ $item->distrito }}</td>
            <td>{{ $item->provincia }}</td>
            <td>{{ $item->departamento }}</td>
            <td>
                <button class="btn btn-xs establecimiento-seleccionar" data-codigo="{{ $item->Codigo }}" data-nombre="{{ $item->Nombre }}">
                    <i class="fa fa-plus"></i>
                </button>
            </td>
        </tr>
    @endforeach

    @empty($items)
        <tr>
            <td colspan="6" align="center">Sin resultados</td>
        </tr>
    @endempty
    </tbody>
</table>
