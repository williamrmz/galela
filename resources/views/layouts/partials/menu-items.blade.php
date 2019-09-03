
@foreach ($items as $item)

    @php
        $url = url($item->url);

        $subItems = null;

        if(isset($item->items)){
            if(!empty($item->items)){
                $subItems = $item->items;
                $url = "#";
            }
        }

        $class = $subItems? 'treeview': ''; //active

    @endphp

    
    <li class="{{ $class }} @yield($item->key)" yield='{{$item->key}}'>
        <a href="{{ $url }}" >
            <i class="{{ $item->icon }}"></i> <span style="font-size: 12px;">{{ $item->label }}</span>
            <span class="pull-right-container">
            @if ($subItems)
                <span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></span>
            @endif
        </a>

        @if ($subItems)
            <ul class='treeview-menu'>
                @include('layouts.partials.menu-items', ['items'=>$subItems])
            </ul>
        @endif

    </li>
 
@endforeach