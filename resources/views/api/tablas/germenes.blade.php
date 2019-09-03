<div class="table-responsive">
    <table class="table table-condensed" style="margin-bottom:0">
        @foreach ($data as $germen)
            @php
                $germenJson = json_encode($germen)
            @endphp
            <tr>
                <td> {{$germen->id }} </td>
                <td> {{$germen->nombre }} </td>
                <td>
                    <a href="#" class="btn btn-xs btn-default btn-select-germen"> <i class="fa fa-chevron-right"></i></a>
                    <input type="hidden" value="{{ $germenJson }}">
                </td>
            </tr>
        @endforeach
    </table>
    {{ $data->render() }}
</div>