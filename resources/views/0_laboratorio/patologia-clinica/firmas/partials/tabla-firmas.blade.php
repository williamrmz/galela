<table class="table table-condensed" style="margin-bottom:0">
    <thead>
        <tr style="font-weight:bold">
            <td>DNI</td>
            <td>Empleado</td>
            <td>Firma</td>
            <td>Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
            <tr>
                <td>{{ $item->DNI }}</td>
                <td>{{ $item->fullname() }}</td>
                <td>
                    <i class="fa {{ $item->Firma?'fa-check text-green': 'fa-close text-red' }}"></i>
                </td>
                <td>
                    <input type="hidden" value="{{ $item->IdEmpleado }}">
                    <a href="#" class="btn btn-xs btn-default firmas-btn-edit"><i class="fa fa-fw fa-edit"></i></a>
                    <a href="#" class="btn btn-xs btn-default firmas-btn-delete"><i class="fa fa-fw fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="firma-paginator">
    {{ $list->render() }}
</div>

