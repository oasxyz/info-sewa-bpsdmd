@extends('layouts.admin')

@section('title', 'Laporan Pemakai Gedung')

@section('content')

<div class="laporan-card">
    <div class="laporan-card-header">LAPORAN PEMAKAI GEDUNG</div>
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
            <a href="{{ route('admin.laporan.pemakai_gedung') }}" class="btn-reset">Reset</a>
        </form>

        <div class="table-responsive">
            <table class="laporan-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tgl Pakai</th>
                        <th>Nama Pemesan</th>
                        <th>Nama Pemakai</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $row)
                        <tr>
                            <td>{{ $row->no }}</td>
                            <td>{{ date('d/m/Y', strtotime($row->tanggal_pakai)) }}</td>
                            <td>{{ $row->pemesan }}</td>
                            <td>{{ $row->pemakai }}</td>
                            <td>{{ $row->alamat }}</td>
                            <td>{{ $row->telp }}</td>
                            <td>
                                <button class="btn-aksi" onclick="alert('Fitur belum tersedia')">Detail</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" style="text-align:center;">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection