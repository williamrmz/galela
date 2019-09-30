@if( $items->count() > 0)

    <table class="table table-condensed table-hover table-bordered" style="margin-top:10px; margin-bottom:0px;">
        <thead>
            <tr class="bg-purple disabled">
                <td>CIE-10</td>
                <td>Descripcion</td>
                <td>CIE-9</td>
                <td width="30"></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->CodigoCIE10 }}</td>
                    <td>{{ $item->Descripcion }}</td>
                    <td>{{ $item->CodigoCIE9 }}</td>
                    <td>
                        <input type="hidden" value="{{ json_encode($item) }}">
                        <a href="#" class="btn btn-xs btn-default btn-select"> <i class="fa fa-plus"></i></a>
                    </td>
                </tr>   
            @endforeach
        </tbody>
    </table>

    {{ $items->links() }}
@else
    <br><div class="text-center">Sin resultados</div>
@endif
