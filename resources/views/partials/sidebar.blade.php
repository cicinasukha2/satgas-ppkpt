<div class="main-sidebar sidebar-style-1">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('/') }}">
                <img src="{{ url('img/logosatgas.png') }}" style="width: 30px;"> Sekretaris Satgas
            </a>
        </div>
        <!-- Sidebar -->
        <ul class="sidebar-menu">
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-user text-danger"></i>
                    <span>Hai, {{ Auth::user()->name ?? 'Satgas PPKPT' }}</span>
                </a>
            </li>

            <li class="menu-header"><b>Menu Utama</b></li>
            <li>
                <a href="{{ url('/dashboard') }}" class="nav-link">
                    <i class="fas fa-fire"></i> <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="fas fa-user"></i> <span>Data User</span>
                </a>
            </li>

            <li class="menu-header"><b>Pelaporan</b></li>
            <li><a class="nav-link" href="{{ route('laporan.index') }}"><i class="fas fa-download"></i> <span>Laporan</span></a></li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" class="btn btn-danger btn-lg btn-block btn-icon-split"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit(); return confirm('Yakin ingin Logout?')">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>
</div>
