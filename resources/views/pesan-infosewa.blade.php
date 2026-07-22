@extends('layouts.app')

@section('title', 'Pesan Gedung - Info Sewa BPSDMD Provinsi Jawa Tengah')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pesan.css') }}">
@endpush

@section('nav-cta')
<a href="#formulir" class="btn-lihat-jadwal">Pesan Gedung</a>
@endsection

@section('content')
<div class="page-wrap">

  <div class="petunjuk-card">
    <h5>Petunjuk Pemesanan:</h5>
    <ol>
      <li>Silakan isi identitas Anda dengan benar termasuk KTP (Kartu Tanda Penduduk), karena akan digunakan pada saat verifikasi.</li>
      <li>Setelah berhasil melakukan pemesanan, Anda bisa melihat jadwal pemesanan Anda di menu 'Jadwal pemesanan'.</li>
      <li>Setelah berhasil melakukan pemesanan, lakukan <strong>verifikasi paling lambat 7 hari setelah pemesanan</strong>, dengan cara datang langsung pada jam kerja ke <strong>Ruang Layanan Informasi BPSDMD Provinsi Jawa Tengah</strong> dan menunjukkan <strong>KTP</strong> beserta bukti cetak pemesanan online.</li>
      <li>Jika dalam waktu 7 hari Anda belum melakukan verifikasi, data pemesanan Anda akan dihapus.</li>
      <li>Pelunasan biaya sewa gedung dilakukan <strong>paling lambat 60 hari sebelum tanggal pemakaian.</strong> Apabila melebihi batas waktu tersebut maka pemesanan akan dibatalkan.</li>
      <li>Penggunaan Gedung Sasana Widya Praja hanya dapat disewa pada hari <strong>Jumat (khusus sesi malam), Sabtu, Minggu</strong> dan <strong>hari libur nasional</strong></li>
      <li>Apabila terjadi pembatalan segera hubungi petugas.</li>
    </ol>
  </div>

  <div class="form-card" id="formulir">
    <div class="form-card-header">Formulir Pemesanan</div>
    <div class="form-card-body">
        <form action="{{ route('pesan') }}" method="POST">
          @csrf

          @if($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

        <div class="row g-4 mb-1">
          <div class="col-12">
            <label class="form-label">No. KTP <span class="text-muted fw-normal">(Kartu Tanda Penduduk)</span><span class="req">*</span></label>
            <input type="text" class="form-control" name="no_ktp" placeholder="Nomor KTP" value="{{ old('no_ktp') }}" required>
            @error('no_ktp') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="row g-4 mt-1">
          <div class="col-md-6">
            <label class="form-label">Nama pemesan<span class="req">*</span></label>
            <input type="text" class="form-control" name="nama_pemesan" placeholder="Nama pemesan" value="{{ old('nama_pemesan') }}" required>
            @error('nama_pemesan') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label">Nama pemakai<span class="req">*</span></label>
            <input type="text" class="form-control" name="nama_pemakai" placeholder="Nama pemakai" value="{{ old('nama_pemakai') }}" required>
            @error('nama_pemakai') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="row g-4 mt-1">
          <div class="col-md-6">
            <label class="form-label">No. telepon pemesan<span class="req">*</span></label>
            <input type="tel" class="form-control" name="no_telepon_pemesan" placeholder="Nomor telepon pemesan" value="{{ old('no_telepon_pemesan') }}" required>
            @error('no_telepon_pemesan') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label">No. telepon pemakai<span class="req">*</span></label>
            <input type="tel" class="form-control" name="no_telepon_pemakai" placeholder="Nomor telepon pemakai" value="{{ old('no_telepon_pemakai') }}" required>
            @error('no_telepon_pemakai') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="row g-4 mt-1">
          <div class="col-md-6">
            <label class="form-label">Email<span class="req">*</span></label>
            <input type="email" class="form-control" name="email" placeholder="Alamat email" value="{{ old('email') }}" required>
            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label">Alamat<span class="req">*</span></label>
            <textarea class="form-control" name="alamat" rows="1" placeholder="Alamat" required>{{ old('alamat') }}</textarea>
            @error('alamat') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="row g-4 mt-1">
          <div class="col-md-6">
            <label class="form-label">Tanggal pemakaian<span class="req">*</span></label>
            <input type="date" class="form-control" name="tanggal_pemakaian" value="{{ old('tanggal_pemakaian') }}" required>
            @error('tanggal_pemakaian') <div class="text-danger small">{{ $message }}</div> @enderror
            <div class="radio-group">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="waktu_pakai" id="waktuSiang" value="siang" {{ old('waktu_pakai') == 'siang' ? 'checked' : '' }}>
                <label class="form-check-label" for="waktuSiang">siang</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="waktu_pakai" id="waktuMalam" value="malam" {{ old('waktu_pakai') == 'malam' ? 'checked' : '' }}>
                <label class="form-check-label" for="waktuMalam">malam</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="waktu_pakai" id="waktuSehari" value="1hari" {{ old('waktu_pakai') == '1hari' ? 'checked' : '' }}>
                <label class="form-check-label" for="waktuSehari">1 hari</label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <label class="form-label">Keperluan<span class="req">*</span></label>
            <input type="text" class="form-control" name="keperluan" placeholder="Contoh resepsi" value="{{ old('keperluan') }}" required>
            @error('keperluan') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="row g-4 mt-1 mb-4">
          <div class="col-md-6">
            <label class="form-label">Gedung yang dipesan</label>
            <select class="form-select" name="gedung" required>
              @foreach($gedungs as $g)
                <option value="{{ $g->gedung }}" {{ old('gedung') == $g->gedung ? 'selected' : '' }}>{{ $g->gedung }}</option>
              @endforeach
            </select>
            @error('gedung') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
        </div>

        <button type="submit" class="btn-submit-pesan">Pesan Sekarang</button>
      </form>
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script src="{{ asset('js/pesan.js') }}"></script>
@endpush