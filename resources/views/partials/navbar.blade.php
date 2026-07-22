<nav class="navbar-custom">
  <div class="container navbar-grid">

    <!-- LEFT: Logo + Brand -->
    <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 text-decoration-none">
      <div class="brand-logo">
        <img src="{{ asset('images/logo-jateng.png') }}" alt="Logo BPSDMD Jawa Tengah">
      </div>
      <div>
        <div class="brand-text-main">INFO SEWA</div>
        <div class="brand-text-sub">BPSDMD Provinsi Jawa Tengah</div>
      </div>
    </a>

    <!-- CENTER: Nav Links (desktop) -->
    <ul class="nav-links">
      <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
      <li><a href="{{ url('/pesan') }}" class="{{ request()->is('pesan') ? 'active' : '' }}">Pesan</a></li>
      <li><a href="{{ url('/cek-pesanan') }}" class="{{ request()->is('cek-pesanan') ? 'active' : '' }}">Status</a></li>
      <li><a href="{{ url('/informasi') }}" class="{{ request()->is('informasi') ? 'active' : '' }}">Informasi</a></li>
    </ul>

    <!-- RIGHT: CTA + Hamburger (mobile) -->
    <div class="navbar-right">
      @yield('nav-cta')

      <button class="navbar-hamburger" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNav" aria-label="Menu navigasi">
        <i class="bi bi-list"></i>
      </button>
    </div>

  </div>
</nav>

<!-- OFFCANVAS MOBILE MENU -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNav" aria-labelledby="offcanvasNavLabel">
  <div class="offcanvas-header">
    <div class="d-flex align-items-center gap-2">
      <div class="brand-logo">
        <img src="{{ asset('images/logo-jateng.png') }}" alt="Logo BPSDMD Jawa Tengah">
      </div>
      <div>
        <div class="brand-text-main">INFO SEWA</div>
        <div class="brand-text-sub">BPSDMD Provinsi Jawa Tengah</div>
      </div>
    </div>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="mobile-nav-links">
      <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
      <li><a href="{{ url('/pesan') }}" class="{{ request()->is('pesan') ? 'active' : '' }}">Pesan</a></li>
      <li><a href="{{ url('/cek-pesanan') }}" class="{{ request()->is('cek-pesanan') ? 'active' : '' }}">Status</a></li>
      <li><a href="{{ url('/informasi') }}" class="{{ request()->is('informasi') ? 'active' : '' }}">Informasi</a></li>
    </ul>
    <div class="mobile-cta mt-4">
      @yield('nav-cta')
    </div>
  </div>
</div>

<script src="{{ asset('js/landing-nav.js') }}"></script>