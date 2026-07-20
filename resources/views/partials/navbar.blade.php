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
      <a href="{{ url('/cek-pesanan') }}" class="{{ request()->is('cek-pesanan') ? 'active' : '' }}">Status</a>
      <a href="{{ url('/informasi') }}" class="{{ request()->is('informasi') ? 'active' : '' }}">Informasi</a>
    </div>

    @yield('nav-cta')
  </div>
</nav>