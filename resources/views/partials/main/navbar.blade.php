
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Utama</div>
                <a class="nav-link {{ Route::is('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                    <div class="sb-nav-link-icon"><i class="bi bi-house-door"></i></div>
                    Beranda
                </a>
                <div class="sb-sidenav-menu-heading">Data</div>
                <a class="nav-link {{ Route::is('tamu.index') ? 'active' : '' }}" href="{{ route('tamu.index') }}">
                    <div class="sb-nav-link-icon"><i class="bi bi-file-earmark"></i></div>
                    Data Tamu
                </a>
              
                <a class="nav-link {{ Route::is('rekap.index') ? 'active' : '' }}" href="{{ route('rekap.index') }}">
                    <div class="sb-nav-link-icon"></i></div>
                    Laporan Tamu
                </a>
                <a class="nav-link {{ Route::is('tujuan.index') ? 'active' : '' }}" href="{{ route('tujuan.index') }}">
                    <div class="sb-nav-link-icon"><i class="bi bi-person-circle"></i></i></div>
                    Data Tujuan
                </a>

                <a class="nav-link {{ Route::is('pegawai.index') ? 'active' : '' }}" href="{{ route('pegawai.index') }}">
                    <div class="sb-nav-link-icon"><i class="bi bi-person-circle"></i></i></div>
                    Data Pegawai
                </a>
                <div class="sb-sidenav-menu-heading">Admin</div>
                <a class="nav-link {{ Route::is('pengguna.index') ? 'active' : '' }}" href="{{ route('pengguna.index') }}">
                    <div class="sb-nav-link-icon"><i class="bi bi-person-circle"></i></i></div>
                    Beranda
                </a>
               
            </div>
        </div>
    </nav>
</div>