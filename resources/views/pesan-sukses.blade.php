@extends('layouts.app')

@section('title', 'Pemesanan Berhasil - Info Sewa BPSDMD Provinsi Jawa Tengah')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pesan.css') }}">
@endpush

@section('nav-cta')
<a href="{{ url('/pesan') }}" class="btn-pesan">Pesan Gedung</a>
@endsection

@section('content')
<div class="page-wrap">
  <div class="form-card">
    <div class="form-card-header">Pemesanan Berhasil</div>
    <div class="form-card-body">
      <div class="text-center py-4">
        <div style="font-size: 80px; color: #28a745;">&#10004;</div>
        <h3 class="mt-3">Pemesanan Berhasil!</h3>
        <p class="text-muted">Terima kasih, data pemesanan Anda telah tersimpan.</p>
      </div>

      <div class="card p-4 mb-4">
        <h5>Ringkasan Pemesanan</h5>
        <table class="table table-borderless">
          <tr><td>No. KTP</td><td>: {{ $data['no_ktp'] }}</td></tr>
          <tr><td>Nama Pemesan</td><td>: {{ $data['nama_pemesan'] }}</td></tr>
          <tr><td>Nama Pemakai</td><td>: {{ $data['nama_pemakai'] }}</td></tr>
          <tr><td>Gedung</td><td>: {{ $data['gedung'] }}</td></tr>
          <tr><td>Tanggal Pakai</td><td>: {{ $data['tanggal_pemakaian'] }}</td></tr>
          <tr><td>Waktu</td><td>: {{ $data['waktu_pakai'] }}</td></tr>
          <tr><td>Keperluan</td><td>: {{ $data['keperluan'] }}</td></tr>
        </table>
      </div>

      <div class="alert alert-info">
        <strong>Penting!</strong> Lakukan verifikasi paling lambat 7 hari setelah pemesanan, dengan cara datang langsung pada jam kerja ke <strong>Ruang Layanan Informasi BPSDMD Provinsi Jawa Tengah</strong> dan menunjukkan <strong>KTP</strong> beserta bukti pemesanan ini.
      </div>

      <div class="text-center mt-4">
        <a href="{{ url('/') }}" class="btn btn-secondary">Kembali ke Beranda</a>
        <button onclick="window.print()" class="btn btn-primary">Cetak</button>
      </div>
    </div>
  </div>
</div>
@endsection