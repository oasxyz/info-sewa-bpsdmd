@extends('layouts.admin')

@section('title', 'Tambah Pemesanan - Admin BPSDMD Jateng')

@push('styles')
<link href="{{ asset('css/admin-pemesanan.css') }}" rel="stylesheet">
<style>
.form-tambah-card {
  background: #fff;
  border: 1px solid #e6e6e6;
  border-radius: 8px;
  box-shadow: 0 2px 12px rgba(0,0,0,.08);
  overflow: hidden;
}
.form-tambah-header {
  background: #f5f5f5;
  padding: 18px 24px;
  font-weight: 700;
  font-size: 1.15rem;
  color: #1b2a4b;
  border-bottom: 1px solid #e2e2e2;
}
.form-tambah-body {
  padding: 32px;
}
.form-tambah-body .form-label {
  font-weight: 600;
  font-size: .9rem;
  margin-bottom: 6px;
}
.form-tambah-body .form-label .req {
  color: #c0324a;
  margin-left: 2px;
}
.form-tambah-body .form-control,
.form-tambah-body .form-select {
  border: 1px solid #d8d8d8;
  border-radius: 5px;
  padding: 10px 14px;
  font-size: .9rem;
}
.form-tambah-body .form-control:focus,
.form-tambah-body .form-select:focus {
  border-color: #17150f;
  box-shadow: 0 0 0 .15rem rgba(23,21,15,.08);
}
.radio-group {
  margin-top: 10px;
  display: flex;
  gap: 22px;
}
.btn-simpan {
  width: 100%;
  background: #212529;
  color: #fed136;
  border: none;
  padding: 14px;
  font-weight: 700;
  font-size: 1rem;
  border-radius: 5px;
  cursor: pointer;
}
.btn-simpan:hover {
  background: #000;
}
</style>
@endpush

@section('content')
<div class="container-fluid px-4 py-3">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0">Tambah Pemesanan</h4>
    <a href="{{ route('admin.pemesanan') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
  </div>

  @if(session('success'))
    <div class="alert-msg alert-success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert-msg alert-error">{{ session('error') }}</div>
  @endif

  <div class="form-tambah-card">
    <div class="form-tambah-header">Formulir Pemesanan</div>
    <div class="form-tambah-body">
      <form action="{{ route('admin.pemesanan.tambah') }}" method="POST">
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
          <div class="col-md-12">
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
        
        <div style="margin-top: 30px;"> <button type="submit" class="btn-simpan">Simpan Pemesanan</button>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection