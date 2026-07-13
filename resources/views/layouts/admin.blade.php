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
    @stack('styles')
</head>
<body>

    <!-- ================= HEADER ================= -->
    <header class="admin-header">
        <div class="admin-header-inner">

            <div class="admin-brand">
                <div class="brand-logo">
                    <img src="{{ asset('images/logo-jateng.png') }}" alt="Logo Jawa Tengah">
                </div>
                <div>
                    <p class="brand-title">SISTEM INFORMASI PEMESANAN GEDUNG</p>
                    <p class="brand-sub">BPSDMD Provinsi Jawa Tengah</p>
                </div>
            </div>

            <div class="dropdown admin-user-dropdown">
                <button class="btn admin-user-btn dropdown-toggle" type="button" data-toggle="dropdown">
                    <i class="bi bi-person-circle"></i> Admin ({{ Session::get('login_user') }}) <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('admin.logout') }}">Keluar</a></li>
                </ul>
            </div>

        </div>
    </header>

    <!-- ================= SUB NAVBAR ================= -->
    <nav class="admin-subnav">
        <ul class="admin-nav-menu">
            <li class="{{ request()->is('admin/dashboard') || request()->is('admin') ? 'active' : '' }}">
                <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
            </li>
            <li class="dropdown {{ request()->is('admin/pemesanan*') ? 'active' : '' }}">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data Pemesanan <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/admin/pemesanan') }}">Semua Pemesanan</a></li>
                    <li><a href="{{ url('/admin/pemesanan/verifikasi') }}">Verifikasi</a></li>
                </ul>
            </li>
            <li class="{{ request()->is('admin/pemesan/create') ? 'active' : '' }}">
                <a href="{{ url('/admin/pemesan/create') }}">Tambah Pemesan</a>
            </li>
            <li class="dropdown {{ request()->is('admin/laporan*') ? 'active' : '' }}">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/admin/laporan/bulanan') }}">Laporan Bulanan</a></li>
                    <li><a href="{{ url('/admin/laporan/tahunan') }}">Laporan Tahunan</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->is('admin/grafik*') ? 'active' : '' }}">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Grafik <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/admin/grafik/pemesanan') }}">Grafik Pemesanan</a></li>
                    <li><a href="{{ url('/admin/grafik/pendapatan') }}">Grafik Pendapatan</a></li>
                </ul>
            </li>
            <li class="{{ request()->is('admin/pengaturan*') ? 'active' : '' }}">
                <a href="{{ url('/admin/pengaturan') }}">Pengaturan</a>
            </li>
        </ul>
    </nav>

    <!-- ================= CONTENT ================= -->
    <main class="container-fluid content1">
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

    <script src="{{ asset('assets/fancybox/lib/jquery-1.10.1.min.js') }}"></script>
    <script src="{{ asset('assets/fancybox/source/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap3-wysihtml5.all.min.js') }}"></script>

    <script src="{{ asset('js/admin-layout.js') }}"></script>
    @stack('scripts')
</body>
</html>