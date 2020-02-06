<table class="table table-condensed" style="margin-bottom:0">
    <thead>
        <tr style="font-weight:bold">
            <td>ID</td>
            <td>Item</td>
            <td>Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
            <tr>
                <td>{{ $item->idItem }}</td>
                <td>{{ $item->Item}}</td>
                <td>
                    <input type="hidden" value="{{ $item->idItem }}">
                    <a href="#" class="btn btn-xs btn-default items-btn-show"><i class="fa fa-fw fa-eye"></i></a>
                    <a href="#" class="btn btn-xs btn-default items-btn-edit"><i class="fa fa-fw fa-edit"></i></a>
                    <a href="#" class="btn btn-xs btn-default items-btn-delete"><i class="fa fa-fw fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="items-paginator">
    {{ $list->render() }}
</div>

