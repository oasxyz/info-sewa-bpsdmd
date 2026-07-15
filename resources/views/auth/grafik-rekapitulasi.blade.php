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
    <canvas id="barChart"></canvas>
  </div>
</div>

<div class="chart-card">
  <div class="chart-card-header">Grafik Total Pemakai</div>
  <div class="chart-card-body">
    <canvas id="pieChart"></canvas>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const chartLabels = @json($chartLabels);
    const chartDatasets = @json($chartDatasets);
    const pieLabels = @json($pieLabels);
    const pieData = @json($pieData);

    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: chartDatasets,
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Jumlah Pemakai' },
                },
            },
        },
    });

    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: pieLabels,
            datasets: [{
                data: pieData,
                backgroundColor: ['#fed136', '#212529', '#4caf50', '#ff9800', '#2196f3', '#e91e63', '#9c27b0', '#00bcd4', '#795548', '#607d8b'],
            }],
        },
        options: {
            responsive: true,
        },
    });
});
</script>
@endpush

@endsection