<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard - BPSDMD Jateng')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet">

    <link href="{{ asset('css/admin-layout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin-laporan.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>

<div class="admin-layout" id="adminLayout">

    <!-- ================= SIDEBAR ================= -->
    <aside class="admin-sidebar" id="adminSidebar">

        <div class="sidebar-brand">
            <div class="brand-logo">
                <img src="{{ asset('images/logo-jateng.png') }}" alt="Logo Jawa Tengah">
            </div>
            <div>
                <div class="brand-text">INFO SEWA</div>
                <div class="brand-text-sub">BPSDMD Provinsi Jawa Tengah</div>
            </div>
        </div>

        <div class="sidebar-admin-info">
            <div class="admin-avatar"><i class="bi bi-person-circle"></i></div>
            <div class="admin-name">Admin</div>
            <div class="admin-role">{{ Session::get('login_user') }}</div>
        </div>

        <ul class="sidebar-nav">

            <li class="sidebar-item {{ request()->is('admin/dashboard') || request()->is('admin') ? 'active' : '' }}">
                <a href="{{ url('/admin/dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('admin/pemesanan') ? 'active' : '' }}">
                <a href="{{ route('admin.pemesanan') }}">
                    <i class="bi bi-journal-text"></i>
                    <span class="nav-text">Data Pemesanan</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.pemesanan.tambah') ? 'active' : '' }}">
    <a href="{{ route('admin.pemesanan.tambah') }}">
        <i class="bi bi-plus-circle"></i>
        <span class="nav-text">Tambah Pemesan</span>
    </a>
            </li>

            <li class="sidebar-item {{ request()->is('admin/laporan*') ? 'active' : '' }}">
                <a href="{{ route('admin.laporan') }}">
                    <i class="bi bi-bar-chart-line"></i>
                    <span class="nav-text">Laporan</span>
                </a>
            </li>

            <li class="sidebar-item has-submenu {{ request()->is('admin/grafik*') ? 'open active' : '' }}">
                <a href="#" class="submenu-toggle">
                    <i class="bi bi-graph-up"></i>
                    <span class="nav-text">Grafik</span>
                    <i class="bi bi-chevron-down submenu-caret"></i>
                </a>
                <ul class="submenu {{ request()->is('admin/grafik*') ? 'open' : '' }}">
                    <li><a href="{{ url('/admin/grafik/jumlah-pemakai') }}"><span class="nav-text">Jumlah Pemakai Pertahun</span></a></li>
                    <li><a href="{{ url('/admin/grafik/rekapitulasi') }}"><span class="nav-text">Rekapitulasi</span></a></li>
                </ul>
            </li>

            <li class="sidebar-item has-submenu {{ request()->is('admin/pengaturan*') ? 'open active' : '' }}">
                <a href="#" class="submenu-toggle">
                    <i class="bi bi-gear"></i>
                    <span class="nav-text">Pengaturan</span>
                    <i class="bi bi-chevron-down submenu-caret"></i>
                </a>
                <ul class="submenu {{ request()->is('admin/pengaturan*') ? 'open' : '' }}">
                    <li><a href="{{ url('/admin/pengaturan/user') }}"><span class="nav-text">Pengaturan User</span></a></li>
                    <li><a href="{{ url('/admin/pengaturan/gedung') }}"><span class="nav-text">Pengaturan Gedung</span></a></li>
                </ul>
            </li>

        </ul>
    </aside>

    <!-- ================= MAIN ================= -->
    <div class="admin-main">

        <div class="admin-topbar">
            <button class="sidebar-toggle-btn" id="sidebarToggleBtn" type="button" aria-label="Buka/tutup sidebar">
                <i class="bi bi-list"></i>
            </button>
            <a href="{{ route('admin.logout') }}" class="topbar-logout">
                <i class="bi bi-power"></i> Keluar
            </a>
        </div>

        <main class="admin-content">
            @yield('content')
        </main>

        <!-- ================= FOOTER (samain kayak public site) ================= -->
        <footer class="site-footer">
            <div class="footer-inner">
                <div class="footer-col">
                    <h6>BPSDMD<br>PROVINSI JAWA TENGAH</h6>
                    <p>Jl. Setiabudi No. 201 A, Semarang 50263</p>
                    <p>Telepon: 024-7472046</p>
                    <p>Faximile: 7472930</p>
                    <p>Email: bpsdmd@jatengprov.go.id</p>
                </div>
                <div class="footer-col footer-col-center">
                    <h6>Link Terkait</h6>
                    <p><a href="#">Website BPSDMD</a></p>
                    <p><a href="#">PPID BPSDMD</a></p>
                </div>
                <div class="footer-col footer-col-end">
                    <h6>Follow Us</h6>
                    <div class="footer-social">
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
            </div>
        </footer>

    </div>
</div>

<script src="{{ asset('assets/fancybox/lib/jquery-1.10.1.min.js') }}"></script>
<script src="{{ asset('assets/fancybox/source/jquery.fancybox.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap3-wysihtml5.all.min.js') }}"></script>

<script src="{{ asset('js/admin-layout.js') }}"></script>
@stack('scripts')
</body>
</html>