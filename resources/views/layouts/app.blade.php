<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Info Sewa - BPSDMD Provinsi Jawa Tengah')</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

@stack('styles')
</head>
<body>

<!-- ================= NAVBAR ================= -->
<nav class="navbar-custom">
  <div class="container d-flex align-items-center justify-content-between">

    <div class="d-flex align-items-center gap-2">
      <div class="brand-logo">
        <img src="{{ asset('images/logo-jateng.png') }}" alt="Logo BPSDMD Jawa Tengah">
      </div>
      <div>
        <div class="brand-text-main">INFO SEWA</div>
        <div class="brand-text-sub">BPSDMD Provinsi Jawa Tengah</div>
      </div>
    </div>

    <div class="nav-links d-none d-lg-flex">
      <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
      <a href="{{ url('/pesan') }}" class="{{ request()->is('pesan') ? 'active' : '' }}">Pesan</a>
      <a href="{{ url('/informasi') }}" class="{{ request()->is('informasi') ? 'active' : '' }}">Informasi</a>
    </div>

    @yield('nav-cta')
  </div>
</nav>

@yield('content')

<!-- ================= FOOTER ================= -->
<footer class="site-footer">
  <div class="container">
    <div class="row gy-4">
      <div class="col-md-4">
        <h6>BPSDMD<br>PROVINSI JAWA TENGAH</h6>
        <p>Jl. Setiabudi No. 201 A, Semarang 50263</p>
        <p>Telepon: 024-7472046</p>
        <p>Faximile: 7472930</p>
        <p>Email: bpsdmd@jatengprov.go.id</p>
      </div>
      <div class="col-md-4 text-md-center">
        <h6>Link Terkait</h6>
        <p><a href="#">Website BPSDMD</a></p>
        <p><a href="#">PPID BPSDMD</a></p>
      </div>
      <div class="col-md-4 text-md-end">
        <h6>Follow Us</h6>
        <div class="footer-social">
          <a href="#"><i class="bi bi-instagram"></i></a>
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-twitter-x"></i></a>
        </div>
      </div>
    </div>
  </div>
</footer>

@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>