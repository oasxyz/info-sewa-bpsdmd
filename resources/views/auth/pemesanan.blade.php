@extends('layouts.admin')

@section('title', 'Data Pemesanan - Admin')

@section('content')
<div class="card">
  <div class="card-header">Data Pemesanan</div>
  <div class="card-body">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>No. KTP</th>
          <th>Pemesan</th>
          <th>Pemakai</th>
          <th>Gedung</th>
          <th>Tanggal</th>
          <th>Waktu</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pemesanan as $i => $p)
        <tr>
          <td>{{ $i + 1 }}</td>
          <td>{{ $p->no }}</td>
          <td>{{ $p->pemesan }}</td>
          <td>{{ $p->pemakai }}</td>
          <td>{{ $p->gedung }}</td>
          <td>{{ $p->tanggal_pakai }}</td>
          <td>{{ $p->waktu }}</td>
          <td>{{ $p->status }}</td>
          <td>
            <form action="{{ route('admin.pemesanan.status', $p->id_pemesan) }}" method="POST">
              @csrf
              <select name="status" class="form-select form-select-sm">
                <option value="terverifikasi" {{ $p->status == 'proses' ? '' : 'disabled' }}>Verifikasi KTP</option>
                <option value="dipesan" {{ $p->status == 'terverifikasi' ? '' : 'disabled' }}>Konfirmasi Bayar</option>
                <option value="dibatalkan">Batalkan</option>
              </select>
              <button type="submit" class="btn btn-sm btn-primary mt-1">Update</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{ $pemesanan->links() }}
  </div>
</div>
@endsection