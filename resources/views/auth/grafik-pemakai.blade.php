@extends('layouts.admin')

@section('title', 'Grafik Jumlah Pemakai - Admin BPSDMD')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-grafik.css') }}">
@endpush

@section('content')

<form method="GET" action="{{ url('/admin/grafik/jumlah-pemakai') }}" class="filter-bar">
  <label for="tahun">Tahun:</label>
  <select name="tahun" id="tahun" class="form-control">
    <option value="">--Tahun--</option>
    @foreach($tahunOptions as $t)
      <option value="{{ $t }}" {{ (string) $tahunDipilih === (string) $t ? 'selected' : '' }}>{{ $t }}</option>
    @endforeach
  </select>
  <button type="submit" class="btn-filter">Filter</button>
</form>

@if($tahunDipilih)
  @php
    $namaBulan = [
      1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
      5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
      9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
    ];
    $total = 0;
  @endphp

  <div class="grafik-card">
    <div class="grafik-card-header">Tabel Jumlah Pemakai per Tahun {{ $tahunDipilih }}</div>
    <div class="grafik-card-body">
      <table class="grafik-table">
        <thead>
          <tr><th>Bulan</th><th>Jumlah Pemakai</th></tr>
        </thead>
        <tbody>
          @for($b = 1; $b <= 12; $b++)
            @php $jumlah = $data[$b] ?? 0; $total += $jumlah; @endphp
            <tr>
              <td>{{ $namaBulan[$b] }}</td>
              <td>{{ $jumlah }}</td>
            </tr>
          @endfor
        </tbody>
        <tfoot>
          <tr class="total-row">
            <td>Total</td>
            <td>{{ $total }}</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
@else
  <p class="empty-hint">Pilih tahun dulu, terus klik Filter buat liat datanya.</p>
@endif

@endsection