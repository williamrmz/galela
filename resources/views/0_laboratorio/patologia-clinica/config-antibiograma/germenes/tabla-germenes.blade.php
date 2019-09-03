<div class="table-responsive">
    <table class="table table-condensed" style="margin-bottom:0">
        <thead>
            <tr>
                <td>#</td>
                <td>Germen</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($germenes as $germen)
                <tr>
                    <td>{{ $germen->id }}</td>
                    <td>{{ $germen->nombre }}</td>
                    <td>
                        <input type="hidden" value="{{ $germen->id }}">
                        <a href="#" class="btn btn-xs btn-default germenes-btn-edit"> <i class="fa fa-fw fa-edit"></i></a>
                        <a href="#" class="btn btn-xs btn-default germenes-btn-delete"> <i class="fa fa-fw fa-trash"></i></a>
                    </td>
                </tr>  
            @endforeach
            
        </tbody>
    </table>
</div>

<div class="germenes-paginator">
    {{ $germenes->render() }}
</div>


