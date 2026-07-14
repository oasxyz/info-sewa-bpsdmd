@extends('layouts.admin')

@section('title', 'Data Pemesanan - Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin-pemesanan.css') }}">
@endpush

@section('content')

<div class="rekap-card">
  <div class="rekap-card-header">Data Pemesanan</div>
  <div class="rekap-card-body">

    @if(session('success'))
      <div class="alert-msg alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert-msg alert-error">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
      <table class="rekap-table pemesanan-table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Tanggal pakai</th>
            <th>Keperluan / Acara</th>
            <th>Pemesan</th>
            <th>Tempat</th>
            <th>Tagihan</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($pemesanan as $i => $p)
          <tr>
            <td>{{ $pemesanan->firstItem() + $i }}</td>
            <td>{{ $p->tanggal_pakai->format('d M Y') }}</td>
            <td>{{ $p->keperluan }}</td>
            <td>{{ $p->pemesan }}</td>
            <td>{{ $p->gedung }}</td>
            <td>Rp {{ number_format($p->tagihan, 0, ',', '.') }}</td>
            <td>
              <span class="status-badge status-{{ $p->status }}">
                @switch($p->status)
                  @case('proses') Menunggu Verifikasi @break
                  @case('terverifikasi') Menunggu Bayar @break
                  @case('dipesan') Dipesan @break
                  @case('dibatalkan') Dibatalkan @break
                @endswitch
              </span>
              @if(in_array($p->status, ['proses','terverifikasi']) && $p->batas_waktu !== null)
                <div class="status-sisa">
                  {{ $p->batas_waktu > 0 ? "Sisa {$p->batas_waktu} hari" : 'Lewat batas waktu' }}
                </div>
              @endif
            </td>
            <td>
              @if($p->status == 'proses')
                <form action="{{ route('admin.pemesanan.status', $p->id) }}" method="POST" class="aksi-form">
                  @csrf
                  <button type="submit" name="status" value="terverifikasi" class="btn-aksi btn-verif">Verifikasi KTP</button>
                  <button type="submit" name="status" value="dibatalkan" class="btn-aksi btn-batal" onclick="return confirm('Batalkan pemesanan ini?')">Batalkan</button>
                </form>
              @elseif($p->status == 'terverifikasi')
                <form action="{{ route('admin.pemesanan.status', $p->id) }}" method="POST" class="aksi-form">
                  @csrf
                  <button type="submit" name="status" value="dipesan" class="btn-aksi btn-bayar">Konfirmasi Bayar</button>
                  <button type="submit" name="status" value="dibatalkan" class="btn-aksi btn-batal" onclick="return confirm('Batalkan pemesanan ini?')">Batalkan</button>
                </form>
              @else
                <span class="aksi-selesai">—</span>
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="8" class="text-center">Belum ada data pemesanan.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="pemesanan-pagination">
      {{ $pemesanan->links('pagination::bootstrap-5') }}
    </div>

  </div>
</div>

@endsection