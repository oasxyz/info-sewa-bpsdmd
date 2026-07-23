@extends('layouts.admin')

@section('title', 'Grafik Rekapitulasi - Admin BPSDMD')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin-grafik.css') }}">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush

@section('content')

@include('auth.partials.rekap-table', ['rekap' => $rekap])

<div class="chart-card">
  <div class="chart-card-header">Grafik Rekapitulasi Jumlah Pemakai</div>
  <div class="chart-card-body">
    <div class="chart-wrapper chart-wrapper--bar">
        <canvas id="barChart"></canvas>
    </div>
  </div>
</div>

<div class="chart-card">
  <div class="chart-card-header">Grafik Total Pemakai</div>
  <div class="chart-card-body">
    <div class="chart-wrapper chart-wrapper--pie">
        <canvas id="pieChart"></canvas>
    </div>
  </div>
</div>

<script>
const chartLabels = @json($chartLabels);
const chartDatasets = @json($chartDatasets);
const pieLabels = @json($pieLabels);
const pieData = @json($pieData);
</script>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="{{ asset('js/admin-grafik-rekapitulasi.js') }}"></script>
@endpush

@endsection