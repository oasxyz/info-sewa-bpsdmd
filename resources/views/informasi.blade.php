@extends('layouts.app')

@section('title', 'Informasi - Info Sewa BPSDMD Provinsi Jawa Tengah')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/informasi.css') }}">
@endpush

@section('nav-cta')
<a href="{{ url('/pesan') }}" class="btn-lihat-jadwal">Pesan Gedung</a>
@endsection

@section('content')
<div class="info-wrap">
  <div class="info-grid">

    <!-- ===== KETENTUAN PEMAKAIAN GEDUNG ===== -->
    <div class="info-card">
      <div class="info-card-header">Ketentuan Pemakaian Gedung</div>
      <div class="info-card-body">

        <div class="dasar-box">
          <strong>Dasar</strong>
          Peraturan Daerah Provinsi Jawa Tengah No 12 Tahun 2023 tentang Pajak Daerah dan Retribusi Daerah
        </div>

        @foreach($gedungs as $g)
          <div class="gedung-block">
            <h4>{{ $g->gedung }}</h4>
            <table class="harga-table">
              <thead>
                <tr><th>Satuan Pemakaian</th><th>Besarnya Retribusi</th></tr>
              </thead>
              <tbody>
                <tr><td>Siang</td><td>Rp {{ number_format($g->hargasiang, 0, ',', '.') }}</td></tr>
                <tr><td>Malam</td><td>Rp {{ number_format($g->hargamalam, 0, ',', '.') }}</td></tr>
                <tr><td>1 hari</td><td>Rp {{ number_format($g->hargahari, 0, ',', '.') }}</td></tr>
              </tbody>
            </table>
            <div class="fasilitas-title">Fasilitas Gedung:</div>
            @php
                $f = $fasilitasList->firstWhere('kode_gedung', $g->kode);
            @endphp
            @if($f && $f->deskripsi_fasilitas)
                <ul class="fasilitas-list">
                    @foreach(preg_split('/<br\s*\/?>/i', $f->deskripsi_fasilitas) as $item)
                        @if(trim(strip_tags($item)))
                            <li>{!! trim($item) !!}</li>
                        @endif
                    @endforeach
                </ul>
            @endif
          </div>
        @endforeach

        <div class="gedung-block">
          <h4>Gedung / Asrama Lainnya</h4>
          <table class="ringkasan-table">
            <thead>
              <tr>
                <th>Gedung</th>
                <th>Siang</th>
                <th>Malam</th>
                <th>1 Hari</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>Sumbing</td><td>Rp 1.750.000</td><td>Rp 2.000.000</td><td>Rp 3.000.000</td></tr>
              <tr><td>Eks. Merapi</td><td>Rp 1.250.000</td><td>Rp 1.500.000</td><td>Rp 2.000.000</td></tr>
            </tbody>
          </table>
        </div>

      </div>
    </div>

    <!-- ===== HUBUNGI KAMI ===== -->
    <div class="info-card">
      <div class="info-card-header">Hubungi Kami</div>
      <div class="info-card-body">

        <p>Untuk pemesanan dan informasi selanjutnya silakan hubungi:</p>
        <ul class="kontak-list">
          @foreach($kontaks as $k)
            <li>
              <strong>{{ $loop->iteration }}. {{ $k->nama }}</strong> — Telepon: {{ $k->telepon }}
              @if($k->email)
                <br>Email: {{ $k->email }}
              @endif
            </li>
          @endforeach
        </ul>

        <div class="jam-title">Jam Kerja Layanan:</div>
        <div class="jam-list">
          Senin - Kamis: 07.30 - 15.30 WIB (Istirahat: 12.00 - 13.00)<br>
          Jumat: 07.30 - 14.00 WIB (Istirahat: 11.30 - 13.00)<br>
          Libur: Sabtu, Minggu dan hari libur nasional
        </div>

        <div class="peta-title">Peta Lokasi</div>
        <a
          href="https://www.google.com/maps/search/?api=1&query=BPSDMD+Provinsi+Jawa+Tengah+Semarang"
          target="_blank"
          rel="noopener"
          class="btn-buka-maps"
        >Buka di Maps ↗</a>
        <iframe
          class="peta-frame"
          src="https://www.google.com/maps?q=BPSDMD+Provinsi+Jawa+Tengah,+Jl.+Setiabudi+No.+201+A,+Semarang&output=embed"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>

      </div>
    </div>

  </div>
</div>
@endsection