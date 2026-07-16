@extends('layouts.app')

@section('title', 'Cek Pemesanan - Info Sewa BPSDMD Provinsi Jawa Tengah')

@push('styles')
<style>
.page-wrap {
  max-width: 900px;
  margin: 40px auto 90px;
  padding: 0 40px;
}
.card {
  background: #fff;
  border: 1px solid #e6e6e6;
  border-radius: 8px;
  box-shadow: 0 10px 40px rgba(0,0,0,.18);
  overflow: hidden;
  margin-bottom: 36px;
}
.card-header {
  background: #f5f5f5;
  text-align: center;
  padding: 22px 0;
  font-weight: 700;
  font-size: 1.3rem;
  color: #1b2a4b;
  border-bottom: 1px solid #e2e2e2;
}
.card-body {
  padding: 32px;
}
.form-control {
  border: 1px solid #d8d8d8;
  border-radius: 5px;
  padding: 10px 14px;
  font-size: .92rem;
}
.form-control:focus {
  border-color: #17150f;
  box-shadow: 0 0 0 .15rem rgba(23,21,15,.08);
}
.btn-cek {
  background: #212529;
  color: #fed136;
  border: none;
  padding: 12px 40px;
  font-weight: 700;
  border-radius: 5px;
  cursor: pointer;
}
.btn-cek:hover { background: #000; }

.status-badge {
  display: inline-block;
  padding: 4px 10px;
  border-radius: 999px;
  font-size: .78rem;
  font-weight: 700;
}
.status-proses        { background: #fff6d8; color: #8a6d00; border: 1px solid #fed136; }
.status-terverifikasi { background: #e6f0ff; color: #1a4d8f; border: 1px solid #6aa8ff; }
.status-dipesan       { background: #e5f6e8; color: #1e6b2e; border: 1px solid #6aa84f; }
.status-dibatalkan    { background: #fbe7e7; color: #7a1f1f; border: 1px solid #d97b7b; }

.table { font-size: .9rem; }
.table th { background: #f5f5f5; }

.info-bayar {
  background: #e6f0ff;
  border: 1px solid #6aa8ff;
  border-radius: 8px;
  padding: 20px;
  margin-top: 12px;
}
.info-bayar h6 { color: #1a4d8f; font-weight: 700; margin-bottom: 12px; }
.info-bayar p { margin-bottom: 4px; font-size: .9rem; }
</style>
@endpush

@section('content')
<div class="page-wrap">

  <div class="card">
    <div class="card-header">Cek Status Pemesanan</div>
    <div class="card-body">
      <form method="POST">
        @csrf
        <div class="row g-3 align-items-end">
          <div class="col-md-8">
            <label class="form-label fw-semibold">Masukkan No. KTP</label>
            <input type="text" class="form-control" name="no_ktp" placeholder="Nomor KTP" value="{{ old('no_ktp') }}" required>
            @error('no_ktp') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
          </div>
          <div class="col-md-4">
            <button type="submit" class="btn-cek w-100">Cek</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  @if(isset($pemesanan))
    @if($pemesanan->count() > 0)
      <div class="card">
        <div class="card-header">Hasil Pemesanan</div>
        <div class="card-body p-0">
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