<div class="table-responsive">
    <table class="table table-condensed" style="margin-bottom:0">
        <thead>
            <tr>
                <td>#</td>
                <td>Antibiotico</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($antibioticos as $antibiotico)
                <tr>
                    <td>{{ $antibiotico->id }}</td>
                    <td>{{ $antibiotico->nombre }}</td>
                    <td>
                        <input type="hidden" value="{{ $antibiotico->id }}">
                        <a href="#" class="btn btn-xs btn-default antibioticos-btn-edit"> <i class="fa fa-fw fa-edit"></i></a>
                        <a href="#" class="btn btn-xs btn-default antibioticos-btn-delete"> <i class="fa fa-fw fa-trash"></i></a>
                    </td>
                </tr>  
            @endforeach
            
        </tbody>
    </table>
</div>

<div class="antibioticos-paginator">
    {{ $antibioticos->render() }}
</div>


