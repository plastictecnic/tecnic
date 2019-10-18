<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            {{-- Some user image goes here --}}
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
            <div class="email">{{Auth::user()->email}}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="{{ route('change-password') }}"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">input</i>Sign Out</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ Route::is('home') ? 'active' : '' }}">
                <a href="{{route('home')}}">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            @hasanyrole('admin|manager')
            <li class="{{ Route::is('pallet*') ? 'active' : '' }}">
                <a href="{{route('pallet-all')}}">
                    <i class="material-icons">widgets</i>
                    <span>Pallets</span>
                </a>
            </li>
            <li class="{{ Route::is('shippment*') ? 'active' : '' }}">
                <a href="{{route('shippment-all')}}">
                    <i class="material-icons">local_shipping</i>
                    <span>Shippment</span>
                </a>
            </li>
            @endhasanyrole

            @hasanyrole('admin')
            <li class="{{ (Route::is('admin*') || Route::is('organization*')) ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">group</i>
                    <span>Personel</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ Route::is('admin-x*') ? 'active' : '' }}">
                        <a href="{{route('admin-xall-user')}}">Users</a>
                    </li>
                    <li class="{{ Route::is('organization*') ? 'active' : '' }}">
                        <a href="{{route('organization.index')}}">Organization</a>
                    </li>
                </ul>
            </li>
            @endhasanyrole

            @hasanyrole('admin|manager')
            <li class="{{ Route::is('report*') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">library_books</i>
                    <span>Reports</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ Route::is('report-shipment') ? 'active' : '' }}">
                        <a href="{{route('report-shipment')}}">Shipments</a>
                    </li>
                    <li class="{{ Route::is('report-pallet') ? 'active' : '' }}">
                        <a href="{{route('report-pallet')}}">Pallets</a>
                    </li>
                </ul>
            </li>
            <li class="{{ (Route::is('location*') || Route::is('vehicle*')) ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">settings</i>
                    <span>Others</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ Route::is('vehicle*') ? 'active' : '' }}">
                        <a href="{{route('vehicle.index')}}">Vehicle</a>
                    </li>
                    <li class="{{ Route::is('location*') ? 'active' : '' }}">
                        <a href="{{route('location.index')}}">Location</a>
                    </li>
                </ul>
            </li>
            @endhasanyrole
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; {{ Carbon\carbon::now()->year }} <a href="javascript:void(0);">Plastictecnic (M) Sdn Bhd</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.1.2
        </div>
    </div>
    <!-- #Footer -->
</aside>
<!-- #END# Left Sidebar -->
