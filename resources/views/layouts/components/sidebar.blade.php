<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box mt-2">
        <!-- Dark Logo-->
        <a href="{{ url('/') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/img/logo.png') }}" alt="" height="10">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/img/logo.png') }}" alt="" height="50">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ url('/') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/img/logo clickcar.png') }}" alt="" height="10">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/img/logo clickcar.png') }}" alt="" height="50">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ ($title === 'Dashboard') ? 'active' : '' }}" href="/">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ $title === 'Reservasi Mobil' ? 'active' : '' }}" href="{{ url('reservasi-mobil') }}">
                        <i class="ri-roadster-fill"></i> <span>Reservasi Mobil</span>
                    </a>
                </li>

                @hasanyrole('Admin Umum|Admin Driver|Driver')
                <li class="menu-title"><i class="ri-more-fill"></i> <span>Driver</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ $title === 'Checklist Kendaraan' ? 'active' : '' }}" href="{{ url('checklist-kendaraan') }}">
                        <i class="ri-file-list-3-line"></i> <span>Checklist Kendaraan</span>
                    </a>
                </li>
                @endrole
                @role('Admin Umum|Admin')
                <li class="menu-title"><i class="ri-more-fill"></i> <span>Master</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (in_array($title, ['Mobil', 'Supir', 'Jenis Kendaraan', 'Item Inspeksi Kendaraan'])) ? 'collapsed active' : '' }}" href="#masterData" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-database-2-fill"></i> <span>Master Data</span>
                    </a>
                    <div class="collapse menu-dropdown {{ (in_array($title, ['Mobil', 'Supir', 'Jenis Kendaraan', 'Item Inspeksi'])) ? 'show' : '' }}" id="masterData">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('mobil.index') }}" class="nav-link {{ ($title === 'Mobil') ? 'active' : '' }}"> Mobil
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('supir.index') }}" class="nav-link {{ ($title === 'Supir') ? 'active' : '' }}"> Supir
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('jenis-kendaraan.index') }}" class="nav-link {{ ($title === 'Jenis Kendaraan') ? 'active' : '' }}"> Jenis Kendaraan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('item-inspeksi.index') }}" class="nav-link {{ ($title === 'Item Inspeksi') ? 'active' : '' }}"> Item Inspeksi Kendaraan
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (in_array($title, ['Users', 'Roles', 'Permissions', 'Activity Log'])) ? 'collapsed active' : '' }}" href="#masterUser" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-account-circle-line"></i> <span>Master User</span>
                    </a>
                    <div class="collapse menu-dropdown {{ (in_array($title, ['Users', 'Roles', 'Permissions', 'Activity Log'])) ? 'show' : '' }}" id="masterUser">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('users') }}" class="nav-link {{ ($title === 'Users') ? 'active' : '' }}"> Users
                                </a>
                            </li>
                            @role('Admin')
                            <li class="nav-item">
                                <a href="{{ url('roles') }}" class="nav-link {{ ($title === 'Roles') ? 'active' : '' }}"> Roles
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('permissions') }}" class="nav-link {{ ($title === 'Permissions') ? 'active' : '' }}"> Permissions
                                </a>
                            </li>
                            @endrole
                            <li class="nav-item">
                                <a href="{{ url('activity-log') }}" class="nav-link {{ ($title === 'Activity Log') ? 'active' : '' }}"> Activity Log
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endrole
                <li class="menu-title"><i class="ri-more-fill"></i> <span>Help</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" target="_blank" href="https://kavia.kimiafarma.co.id/">
                        <i class="ri-question-line"></i> <span>Help Desk</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>