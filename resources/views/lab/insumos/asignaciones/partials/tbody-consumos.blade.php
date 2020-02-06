@if (count($data) == 0)
<tr>
    <td colspan="3">
        No se ha registrado consumos en laboratorio durante el rango de fecha especificado
    </td>
</tr>
@endif

@foreach ($data as $row)
@php
    $item = json_encode($row);
@endphp
    <tr>
        <td>
            {{ $row->codigo }}
            <input type="hidden" value="{{$item}}" class="consumos-lab">
        </td>
        <td>{{ $row->nombre }}</td>
        <td align="center">{{ number_format($row->cantidad, 0) }}</td>
    </tr>
@endforeach
