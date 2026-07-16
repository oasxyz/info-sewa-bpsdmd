@extends('layouts.app')

@section('title', 'Cek Pemesanan - Info Sewa BPSDMD Provinsi Jawa Tengah')

@section('nav-cta')
<a href="{{ url('/pesan') }}" class="btn-pesan">Pesan Gedung</a>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pesan.css') }}">
<style>
.hasil-card { margin-top: 24px; }
.info-bayar {
  background: #e6f0ff;
  border: 1px solid #6aa8ff;
  border-radius: 8px;
  padding: 20px;
}
.info-bayar h6 { color: #1a4d8f; font-weight: 700; margin-bottom: 12px; }
.info-bayar p { margin-bottom: 4px; font-size: .9rem; }
</style>
@endpush

@section('content')
<div class="page-wrap">

  <div class="form-card">
    <div class="form-card-header">Cek Status Pemesanan</div>
    <div class="form-card-body">
      <form method="POST">
        @csrf
        <div class="row g-3 align-items-end">
          <div class="col-md-8">
            <label class="form-label fw-semibold">Masukkan No. KTP</label>
            <input type="text" class="form-control" name="no_ktp" placeholder="Nomor KTP" value="{{ old('no_ktp') }}" required>
            @error('no_ktp') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
          </div>
          <div class="col-md-4">
            <button type="submit" class="btn-submit-pesan w-100" style="padding-top: 10px; padding-bottom: 10px; border-radius: 5px;">Cek</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  @if(isset($pemesanan))
    @if($pemesanan->count() > 0)
      <div class="form-card-hasil-card">
        <div class="form-card-header">Hasil Pemesanan</div>
        <div class="form-card-body p-0">
          <div class="table-responsive">
            <table class="table table-bordered mb-0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Gedung</th>
                  <th>Tanggal</th>
                  <th>Waktu</th>
                  <th>Keperluan</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($pemesanan as $i => $p)
                <tr>
                  <td>{{ $i + 1 }}</td>
                  <td>{{ $p->gedung }}</td>
                  <td>{{ \Carbon\Carbon::parse($p->tanggal_pakai)->translatedFormat('d F Y') }}</td>
                  <td>
                    @switch($p->waktu)
                      @case('SIANG') Siang @break
                      @case('MALAM') Malam @break
                      @case('1HARI') 1 Hari @break
                      @default {{ $p->waktu }}
                    @endswitch
                  </td>
                  <td>{{ $p->keperluan }}</td>
                  <td>
                    @switch($p->status)
                      @case('proses')
                        <span class="status-badge status-proses">Menunggu Verifikasi KTP</span>
                      @break
                      @case('terverifikasi')
                        <span class="status-badge status-terverifikasi">Terverifikasi</span>
                      @break
                      @case('dipesan')
                        <span class="status-badge status-dipesan">Selesai (Lunas)</span>
                      @break
                      @case('dibatalkan')
                        <span class="status-badge status-dibatalkan">Dibatalkan</span>
                      @break
                    @endswitch
                  </td>
                </tr>
                @if($p->status === 'terverifikasi')
                <tr style="background:#f8faff;">
                  <td colspan="6" class="p-3">
                    <div class="info-bayar">
                      <h6><i class="bi bi-credit-card me-1"></i> Informasi Pembayaran</h6>
                      <p><strong>Bank:</strong> {{ config('pengaturan.nama_bank') }}</p>
                      <p><strong>No. Rekening:</strong> {{ config('pengaturan.no_rekening') }}</p>
                      <p><strong>Atas Nama:</strong> {{ config('pengaturan.atas_nama') }}</p>
                      <p><strong>Konfirmasi via WA:</strong> <a href="https://wa.me/{{ config('pengaturan.wa_admin') }}" target="_blank">{{ config('pengaturan.wa_admin') }}</a></p>
                      <hr>
                      <p class="mb-0 text-muted small">
                        <i class="bi bi-info-circle me-1"></i>
                        Pembayaran dapat dilakukan maksimal 10 hari sebelum tanggal acara.
                        Setelah melakukan transfer, silakan kirim bukti bayar via WA ke admin untuk konfirmasi.
                      </p>
                    </div>
                  </td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    @else
      <div class="alert alert-warning">Tidak ditemukan pemesanan dengan KTP tersebut.</div>
    @endif
  @endif

</div>
@endsection