@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')

<div class="laporan-card">
    <div class="laporan-card-header">LAPORAN</div>
    <div class="laporan-card-body">

        <form class="laporan-filter" method="GET">
            <div class="filter-group">
                <label>Tahun</label>
                <select name="tahun" onchange="this.form.submit()">
                    @foreach($tahunList as $t)
                        <option value="{{ $t }}" {{ $t == $tahun ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label>Bulan</label>
                <select name="bulan" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    @foreach(['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'] as $i => $b)
                        <option value="{{ $i+1 }}" {{ ($bulan ? (int)$bulan : '') == $i+1 ? 'selected' : '' }}>{{ $b }}</option>
                    @endforeach
                </select>
            </div>
            <a href="{{ route('admin.laporan') }}" class="btn-reset">Reset</a>
        </form>

        <div class="table-responsive">
            <table class="laporan-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tgl Pakai</th>
                        <th>Nama Pemesan</th>
                        <th>Nama Pemakai</th>
                        <th>Gedung</th>
                        <th>Waktu</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Retribusi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $row)
                        <tr>
                            <td>{{ $row->no }}</td>
                            <td>{{ date('d/m/Y', strtotime($row->tanggal_pakai)) }}</td>
                            <td>{{ $row->pemesan }}</td>
                            <td>{{ $row->pemakai }}</td>
                            <td>{{ $row->gedung }}</td>
                            <td>{{ $row->waktu }}</td>
                            <td>{{ $row->alamat }}</td>
                            <td>{{ $row->telp }}</td>
                            <td class="col-uang">Rp {{ number_format($row->retribusi, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="9" style="text-align:center;">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="8" style="text-align:right;">Total</th>
                        <th class="col-uang">Rp {{ number_format($total, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</div>

@endsection