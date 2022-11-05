@if(Auth::user()->role==1)
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
    data-accordion="false">
    <li class="nav-item">
        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->is(['dashboard','/']) ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('users.index') }}"
           class="nav-link {{ request()->is(['users','users/*']) ? 'active' : '' }}">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
                Users
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('hotels.index') }}"
           class="nav-link {{ request()->is(['hotels','hotels/*']) ? 'active' : '' }}">
            <i class="nav-icon far fa-image"></i>
            <p>
                Hotels
            </p>
        </a>
    </li>
        <li class="nav-item">
            <a href="{{ route('booking.index') }}"
               class="nav-link {{ request()->is(['bookings','bookings/*']) ? 'active' : '' }}">
                <i class="nav-icon far fa-image"></i>
                <p>
                    Bookings
                </p>
            </a>
        </li>
    <li class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link bg-danger" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <p>Logout</p>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </a>
    </li>
</ul>

@elseif(Auth::user()->role==2)
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ request()->is(['dashboard','/']) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('booking.index') }}"
                   class="nav-link {{ request()->is(['bookings','bookings/*']) ? 'active' : '' }}">
                    <i class="nav-icon far fa-image"></i>
                    <p>
                        Bookings
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link bg-danger" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <p>Logout</p>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
            </li>
        </ul>
@endif
