@extends('layouts.app')

@section('title', 'Status Pemesanan - Info Sewa BPSDMD Provinsi Jawa Tengah')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pesan.css') }}">
@endpush

@section('content')
<div class="page-wrap">
  <div class="form-card">
    <div class="form-card-header">Detail Status Pemesanan</div>
    <div class="form-card-body">

      {{-- KODE BOOKING --}}
      <div class="text-center mb-3">
        <small class="text-muted">Kode Booking</small>
        <h4 class="fw-bold" style="letter-spacing: 2px;">{{ $pemesanan->kode_booking }}</h4>
      </div>

      {{-- TIMELINE / STEPPER --}}
      @php
        $status = $pemesanan->status;
      @endphp
      <div class="stepper">
        {{-- STEP 1: Diajukan --}}
        <div class="step">
          <div class="step-icon done"><i class="bi bi-check-circle-fill"></i></div>
          <div class="step-label done">Diajukan</div>
        </div>
        <div class="step-connector done"></div>

        {{-- STEP 2: Verifikasi KTP --}}
        @if($status === 'dibatalkan')
          <div class="step">
            <div class="step-icon cancel"><i class="bi bi-x-circle-fill"></i></div>
            <div class="step-label cancel">Dibatalkan</div>
          </div>
        @else
          <div class="step">
            <div class="step-icon {{ $status === 'proses' ? 'active' : 'done' }}">
              <i class="bi {{ $status === 'proses' ? 'bi-hourglass-split' : 'bi-check-circle-fill' }}"></i>
            </div>
            <div class="step-label {{ $status === 'proses' ? 'active' : 'done' }}">Verifikasi KTP</div>
          </div>
          <div class="step-connector {{ $status === 'dipesan' || $status === 'terverifikasi' ? 'done' : '' }}"></div>

          {{-- STEP 3: Terverifikasi --}}
          <div class="step">
            <div class="step-icon {{ $status === 'terverifikasi' ? 'active' : ($status === 'dipesan' ? 'done' : 'pending') }}">
              <i class="bi {{ $status === 'terverifikasi' ? 'bi-hourglass-split' : ($status === 'dipesan' ? 'bi-check-circle-fill' : 'bi-circle') }}"></i>
            </div>
            <div class="step-label {{ $status === 'terverifikasi' ? 'active' : ($status === 'dipesan' ? 'done' : 'pending') }}">Terverifikasi</div>
          </div>
          <div class="step-connector {{ $status === 'dipesan' ? 'done' : '' }}"></div>

          {{-- STEP 4: Pesanan Berhasil --}}
          <div class="step">
            <div class="step-icon {{ $status === 'dipesan' ? 'done' : 'pending' }}">
              <i class="bi {{ $status === 'dipesan' ? 'bi-check-circle-fill' : 'bi-circle' }}"></i>
            </div>
            <div class="step-label {{ $status === 'dipesan' ? 'done' : 'pending' }}">Pesanan Berhasil</div>
          </div>
        @endif
      </div>

      {{-- RINGKASAN PEMESANAN --}}
      <div class="card p-4 mb-4">
        <h5>Ringkasan Pemesanan</h5>
        <table class="table table-borderless mb-0">
          <tr><td style="width:120px;">No. KTP</td><td>: {{ $pemesanan->no }}</td></tr>
          <tr><td>Nama Pemesan</td><td>: {{ $pemesanan->pemesan }}</td></tr>
          <tr><td>Nama Pemakai</td><td>: {{ $pemesanan->pemakai }}</td></tr>
          <tr><td>Gedung</td><td>: {{ $pemesanan->gedung }}</td></tr>
          <tr><td>Tanggal Pakai</td><td>: {{ \Carbon\Carbon::parse($pemesanan->tanggal_pakai)->translatedFormat('d F Y') }}</td></tr>
          <tr><td>Waktu</td><td>: {{ $pemesanan->waktu }}</td></tr>
          <tr><td>Keperluan</td><td>: {{ $pemesanan->keperluan }}</td></tr>
        </table>
      </div>

      {{-- INFO PER STATUS --}}
      @switch($status)
        @case('proses')
          <div class="info-box info-box-verif">
            <h5 class="fw-bold" style="color:#8a6d00;"><i class="bi bi-exclamation-triangle me-2"></i>Verifikasi KTP Diperlukan</h5>
            <p>Pemesanan Anda belum selesai. Lakukan langkah berikut:</p>
            <ol class="mb-0">
              <li>Datang langsung ke <strong>Ruang Layanan Informasi BPSDMD Provinsi Jawa Tengah</strong> pada jam kerja.</li>
              <li>Tunjukkan <strong>KTP asli</strong> beserta kode booking.</li>
              <li><strong>Tanda tangan MOU</strong> (Surat Perjanjian Sewa) di depan petugas.</li>
            </ol>
          </div>
        @break

        @case('terverifikasi')
          <div class="info-box info-box-bayar">
            <h5 class="fw-bold" style="color:#1a4d8f;"><i class="bi bi-credit-card me-2"></i>Informasi Pembayaran</h5>
            <p>Verifikasi KTP selesai. Silakan lakukan pembayaran:</p>
            <table class="table table-borderless mb-3">
              <tr><td style="width:120px;">Bank</td><td>: <strong>{{ config('pengaturan.nama_bank') }}</strong></td></tr>
              <tr><td>No. Rekening</td><td>: <strong>{{ config('pengaturan.no_rekening') }}</strong></td></tr>
              <tr><td>Atas Nama</td><td>: <strong>{{ config('pengaturan.atas_nama') }}</strong></td></tr>
              <tr><td>Konfirmasi</td><td>: <a href="https://wa.me/{{ config('pengaturan.wa_admin') }}" target="_blank">{{ config('pengaturan.wa_admin') }}</a> (WA)</td></tr>
            </table>
            <p class="mb-0 small text-muted">
              <i class="bi bi-info-circle me-1"></i>
              Setelah transfer, kirim bukti bayar via WA ke admin untuk konfirmasi.
            </p>
          </div>
        @break

        @case('dipesan')
          <div class="info-box info-box-selesai">
            <h5 class="fw-bold" style="color:#1e6b2e;"><i class="bi bi-check-circle me-2"></i>Pemesanan Selesai</h5>
            <p class="mb-0">Pembayaran telah dikonfirmasi. Pemesanan gedung Anda sudah selesai dan lunas.</p>
          </div>
        @break

        @case('dibatalkan')
          <div class="info-box info-box-batal">
            <h5 class="fw-bold" style="color:#7a1f1f;"><i class="bi bi-x-circle me-2"></i>Pemesanan Dibatalkan</h5>
            <p class="mb-0">Pemesanan ini telah dibatalkan. Hubungi petugas untuk informasi lebih lanjut.</p>
          </div>
        @break
      @endswitch

      {{-- TOMBOL KEMBALI --}}
<div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-3 gap-sm-5">
  <div class="text-center">
    <a href="{{ route('cek.status') }}" class="btn btn-secondary" style="min-width: 180px;">Kembali ke Cek Pemesanan</a>
  </div>
    <a href="{{ route('pesan.cetak', $pemesanan->kode_booking) }}" class="btn btn-primary" style="min-width: 180px;" target="_blank">Cetak</a>
  </div>
     </div>

    </div>
  </div>
</div>
@endsection