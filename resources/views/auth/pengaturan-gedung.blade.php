@extends('layouts.admin')

@section('title', 'Pengaturan Gedung - Admin BPSDMD')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-pengaturan.css') }}">
@endpush

@section('content')

@if(session('success'))
  <div class="alert-success-box">{{ session('success') }}</div>
@endif

<!-- ===== TARIF GEDUNG ===== -->
<div class="settings-card">
  <div class="settings-card-header">Tarif Pemakaian Gedung</div>
  <div class="settings-card-body">
    <div class="settings-table tarif-table">
      <div class="settings-row settings-row-head">
        <span>Gedung</span><span>Siang (Rp)</span><span>Malam (Rp)</span><span>1 Hari (Rp)</span>
      </div>
      @foreach($gedungs as $g)
        <div class="settings-row">
          <form action="{{ url('/admin/pengaturan/gedung/'.$g->kode) }}" method="POST" class="row-form tarif-form">
            @csrf
            @method('PUT')
            <span class="col-gedung">{{ $g->gedung }}</span>
            <input type="number" name="hargasiang" class="form-control" value="{{ $g->hargasiang }}" required>
            <input type="number" name="hargamalam" class="form-control" value="{{ $g->hargamalam }}" required>
            <input type="number" name="hargahari" class="form-control" value="{{ $g->hargahari }}" required>
            <button type="submit" class="btn-icon btn-check" title="Simpan"><i class="bi bi-check-lg"></i></button>
          </form>
        </div>
      @endforeach
    </div>
  </div>
</div>

<!-- ===== FASILITAS PER GEDUNG ===== -->
@foreach($gedungs as $g)
  @php
    $f = $fasilitasList->firstWhere('kode_gedung', $g->kode);
  @endphp
  <div class="settings-card">
    <div class="settings-card-header">Fasilitas {{ $g->gedung }}</div>
    <div class="settings-card-body">
      <form action="{{ url('/admin/pengaturan/fasilitas/'.$g->kode) }}" method="POST">
        @csrf
        @method('PUT')
        <textarea name="deskripsi_fasilitas" class="wysihtml5 fasilitas-editor">{!! $f->deskripsi_fasilitas ?? '' !!}</textarea>
        <button type="submit" class="btn-simpan">Simpan</button>
      </form>
    </div>
  </div>
@endforeach

@endsection