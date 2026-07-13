@extends('layouts.app')

@section('title', 'Info Sewa - BPSDMD Provinsi Jawa Tengah')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/locales/id.global.min.js"></script>
@endpush

@section('nav-cta')
<a href="#jadwal" class="btn-lihat-jadwal">Lihat Jadwal</a>
@endsection

@section('content')
<section class="hero">
  <h1>Ruang yang Tepat,<br>Untuk Momen yang Berkesan</h1>
  <p>Jelajahi fasilitas, lihat ketersediaan jadwal, dan lakukan pemesanan gedung dengan pengalaman yang sederhana, cepat, dan nyaman.</p>
</section>

<section class="showcase-wrap">
  <div id="showcaseCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">

    <div class="carousel-indicators">
      <button type="button" data-bs-target="#showcaseCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#showcaseCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#showcaseCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#showcaseCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#showcaseCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
      <button type="button" data-bs-target="#showcaseCarousel" data-bs-slide-to="5" aria-label="Slide 6"></button>
    </div>

    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="carousel-slide s1">
          <img src="{{ asset('images/gambar1.jpg') }}" alt="Gambar Gedung 1">
        </div>
      </div>
      <div class="carousel-item">
        <div class="carousel-slide s2">
          <img src="{{ asset('images/gambar2.jpg') }}" alt="Gambar Gedung 2">
        </div>
      </div>
      <div class="carousel-item">
        <div class="carousel-slide s3">
          <img src="{{ asset('images/gambar3.jpg') }}" alt="Gambar Gedung 3">
        </div>
      </div>
      <div class="carousel-item">
        <div class="carousel-slide s4">
          <img src="{{ asset('images/gambar4.jpg') }}" alt="Gambar Gedung 4">
        </div>
      </div>
      <div class="carousel-item">
        <div class="carousel-slide s5">
          <img src="{{ asset('images/gambar5.jpg') }}" alt="Gambar Gedung 5">
        </div>
      </div>
      <div class="carousel-item">
        <div class="carousel-slide s6">
          <img src="{{ asset('images/gambar6.jpg') }}" alt="Gambar Gedung 6">
        </div>
      </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#showcaseCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Sebelumnya</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#showcaseCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Berikutnya</span>
    </button>

  </div>
</section>

<section class="jadwal-section" id="jadwal">
  <h2>Jadwal Pemesanan Tempat</h2>

  <div class="kalender-card">
    <div class="kalender-header">Jadwal Pemesanan Tempat</div>
    <div class="kalender-body">
      <div id="calendar"></div>

      <hr class="my-3">

      <div class="row">
        <div class="col-6">
          <div class="legend-title">Balai Sasana Widya Praja</div>
          <div class="legend-item"><span class="legend-swatch" style="background:#7a1f1f"></span> Sudah Dipesan</div>
          <div class="legend-item"><span class="legend-swatch" style="background:#e8834e"></span> Proses Administrasi</div>
        </div>
        <div class="col-6">
          <div class="legend-title">Aula Muria</div>
          <div class="legend-item"><span class="legend-swatch" style="background:#1e4d20"></span> Sudah Dipesan</div>
          <div class="legend-item"><span class="legend-swatch" style="background:#6aa84f"></span> Proses Administrasi</div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="cta-banner-wrap">
  <a href="{{ url('/pesan') }}" class="cta-banner">Pesan Gedung</a>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/home.js') }}"></script>
@endpush