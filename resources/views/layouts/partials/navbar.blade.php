<nav class="main-navbar">
    <div class="container">
        <ul class="menu">
            <li class="menu-item">
                <a href="{{ route('home') }}" class="menu-link {{ request()->is('home') ? 'text-white' : '' }}">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('kriteria.index') }}"
                    class="menu-link {{ request()->is('kriteria*') ? 'text-white' : '' }}">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Data Kriteria</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('alternatif.index') }}"
                    class="menu-link {{ request()->is('alternatif*') ? 'text-white' : '' }}">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Data Alternatif</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('bobot-kriteria.index') }}"
                    class="menu-link {{ request()->is('bobot-kriteria*') ? 'text-white' : '' }}">
                    <i class="bi bi-clipboard-data"></i>
                    <span>Perbandingan Kriteria</span>
                </a>
            </li>
            @if (Helper::getJumlah('alternatif') >= 3) 
            <li class="menu-item">
                <a href="{{ route('bobot-alternatif.index',1) }}"
                    class="menu-link {{ request()->is('bobot-alternatif*') ? 'text-white' : '' }}">
                    <i class="bi bi-clipboard-data"></i>
                    <span>Perbandingan Alternatif</span>
                </a>
            </li>
            @endif
            <li class="menu-item">
                <a href="{{ route('ranking.index') }}" class="menu-link">
                    <i class="bi bi-bar-chart-steps"></i>
                    <span>Hasil Akhir</span>
                </a>
            </li>

            <li class="menu-item  has-sub">
                <a href="#" class="menu-link {{ isset($setting) ? 'text-white' : '' }}">
                    <i class="bi bi-gear"></i>
                    <span>Pengaturan</span>
                </a>
                <div class="submenu ">
                    <div class="submenu-group-wrapper">
                        <ul class="submenu-group">
                            <li class="submenu-item  ">
                                <a href="{{ route('permissions.index') }}"
                                    class="submenu-link {{ request()->is('permissions*') ? 'text-info' : '' }}">
                                    <i class="bi bi-shield"></i>
                                    Permission
                                </a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="{{ route('roles.index') }}"
                                    class="submenu-link {{ request()->is('roles*') ? 'text-info' : '' }}">
                                    <i class="bi bi-shield"></i>
                                    Role
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="{{ route('users.index') }}"
                                    class="submenu-link {{ request()->is('users*') ? 'text-info' : '' }}">
                                    <i class="bi bi-person"></i>
                                    Pengguna
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</nav>
