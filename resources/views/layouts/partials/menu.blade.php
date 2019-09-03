<!-- sidebar menu: : style can be found in sidebar.less -->

@php
    $items = \App\Menu::data();
@endphp

<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU</li>
    @include('layouts.partials.menu-items', ['items'=>$items]);
</ul>