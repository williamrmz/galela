@if (session('user'))
    @php
        $user = session('user');

    @endphp


    <!-- User Account: style can be found in dropdown.less -->
    <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="{{ $user->getFoto() }}" class="user-image" alt="User Image">
          <span class="hidden-xs">{{ $user->Usuario }}</span>
        </a>
        <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
                <img src="{{ $user->getFoto() }}" class="img-circle" alt="User Image">
    
                <p>
                {{ $user->Fullname() }}
                <small>Member since Nov. 2012</small>
                </p>
            </li>
            <li class="user-footer">
                <div class="pull-left">
                <a href="{{ url('/profile') }}" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Salir</a>
                </div>
            </li>
        </ul>
    </li>
@endif




@guest
    {{-- pagina de invitados --}}
@else
    @php
        $user = Auth::user();
    @endphp



    <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ $user->image() }}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{ $user->username }}</span>
        </a>
        <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
                <img src="{{ $user->image() }}" class="img-circle" alt="User Image">
    
                <p>
                {{ $user->firstname }}
                <small>{{ $user->empleado->Nombres }}</small>
                </p>
            </li>
            <li class="user-footer">
                <div class="pull-left">
                <a href="{{ url('/profile') }}" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">

                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Salir
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </li>
@endguest
