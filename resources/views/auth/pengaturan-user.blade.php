@extends('layouts.admin')

@section('title', 'Pengaturan User - Admin BPSDMD')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-pengaturan.css') }}">
@endpush

@section('content')

@if(session('success'))
  <div class="alert-success-box">{{ session('success') }}</div>
@endif

<div class="settings-tabs-wrap">

  <!-- ===== TAB NAV ===== -->
  <div class="settings-tab-nav">
    <button type="button" class="settings-tab-btn active" data-tab="manage-user">Manage User</button>
    <button type="button" class="settings-tab-btn" data-tab="contact-person">Contact Person</button>
    <button type="button" class="settings-tab-btn" data-tab="sekretaris">Sekretaris</button>
    <button type="button" class="settings-tab-btn" data-tab="bendahara">Bendahara</button>
  </div>

  <!-- ===== TAB: MANAGE USER ===== -->
  <div class="settings-tab-panel active" id="tab-manage-user">
    <div class="settings-card">
      <div class="settings-card-header">Manage User</div>
      <div class="settings-card-body">
        <p class="settings-note">Catatan: Klik tombol centang untuk memperbarui Username dan Password</p>

        <div class="settings-table">
          @foreach($users as $u)
            <div class="settings-row">
              <form action="{{ url('/admin/pengaturan/user/'.$u->no) }}" method="POST" class="row-form">
                @csrf
                @method('PUT')
                <input type="text" name="user" class="form-control" value="{{ $u->user }}" required>
                <input type="password" name="password" class="form-control" placeholder="Password yang baru">
                <button type="submit" class="btn-icon btn-check" title="Simpan"><i class="bi bi-check-lg"></i></button>
              </form>
              <form action="{{ url('/admin/pengaturan/user/'.$u->no) }}" method="POST" class="row-form-delete" onsubmit="return confirm('Hapus user ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-icon btn-delete" title="Hapus"><i class="bi bi-x-lg"></i></button>
              </form>
            </div>
          @endforeach

          <div class="settings-row">
            <form action="{{ url('/admin/pengaturan/user') }}" method="POST" class="row-form-add">
              @csrf
              <input type="text" name="user" class="form-control" placeholder="Username baru" required>
              <input type="password" name="password" class="form-control" placeholder="Password baru" required>
              <button type="submit" class="btn-tambah">Tambah User</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== TAB: CONTACT PERSON ===== -->
  <div class="settings-tab-panel" id="tab-contact-person">
    <div class="settings-card">
      <div class="settings-card-header">Contact Person</div>
      <div class="settings-card-body">

        <div class="settings-table kontak-table">
          <div class="settings-row settings-row-head">
            <span>No.</span><span>Nama</span><span>Telepon</span><span>Alamat</span><span>Email</span>
          </div>
          @foreach($kontaks as $k)
            <div class="settings-row">
              <form action="{{ url('/admin/pengaturan/kontak/'.$k->no) }}" method="POST" class="row-form kontak-form">
                @csrf
                @method('PUT')
                <span class="col-no">{{ $loop->iteration }}</span>
                <input type="text" name="nama" class="form-control" value="{{ $k->nama }}" required>
                <input type="text" name="telepon" class="form-control" value="{{ $k->telepon }}" required>
                <input type="text" name="alamat" class="form-control" value="{{ $k->alamat }}" required>
                <input type="email" name="email" class="form-control" value="{{ $k->email ?? '' }}" placeholder="-">
                <button type="submit" class="btn-icon btn-check" title="Simpan"><i class="bi bi-check-lg"></i></button>
              </form>
              <form action="{{ url('/admin/pengaturan/kontak/'.$k->no) }}" method="POST" class="row-form-delete" onsubmit="return confirm('Hapus contact person ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-icon btn-delete" title="Hapus"><i class="bi bi-x-lg"></i></button>
              </form>
            </div>
          @endforeach
        </div>

        <form action="{{ url('/admin/pengaturan/kontak') }}" method="POST" class="kontak-add-form">
          @csrf
          <input type="text" name="nama" class="form-control" placeholder="Nama" required>
          <input type="text" name="telepon" class="form-control" placeholder="Telepon" required>
          <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
          <input type="email" name="email" class="form-control" placeholder="Email (opsional)">
          <button type="submit" class="btn-tambah">Tambah</button>
        </form>

      </div>
    </div>
  </div>

  <!-- ===== TAB: SEKRETARIS ===== -->
  <div class="settings-tab-panel" id="tab-sekretaris">
    <div class="settings-card">
      <div class="settings-card-header">Sekretaris</div>
      <div class="settings-card-body">
        <form action="{{ url('/admin/pengaturan/pejabat/sekretaris') }}" method="POST" class="row-form pejabat-form">
          @csrf
          @method('PUT')
          <input type="text" name="nama" class="form-control" value="{{ $sekretaris->nama ?? '' }}" placeholder="Nama" required>
          <input type="text" name="nip" class="form-control" value="{{ $sekretaris->nip ?? '' }}" placeholder="NIP" required>
          <button type="submit" class="btn-icon btn-check" title="Simpan"><i class="bi bi-check-lg"></i></button>
        </form>
      </div>
    </div>
  </div>

  <!-- ===== TAB: BENDAHARA ===== -->
  <div class="settings-tab-panel" id="tab-bendahara">
    <div class="settings-card">
      <div class="settings-card-header">Bendahara</div>
      <div class="settings-card-body">
        <form action="{{ url('/admin/pengaturan/pejabat/bendahara') }}" method="POST" class="row-form pejabat-form">
          @csrf
          @method('PUT')
          <input type="text" name="nama" class="form-control" value="{{ $bendahara->nama ?? '' }}" placeholder="Nama" required>
          <input type="text" name="nip" class="form-control" value="{{ $bendahara->nip ?? '' }}" placeholder="NIP" required>
          <button type="submit" class="btn-icon btn-check" title="Simpan"><i class="bi bi-check-lg"></i></button>
        </form>
      </div>
    </div>
  </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  var tabButtons = document.querySelectorAll('.settings-tab-btn');
  var tabPanels = document.querySelectorAll('.settings-tab-panel');

  tabButtons.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var target = btn.getAttribute('data-tab');

      tabButtons.forEach(function (b) { b.classList.remove('active'); });
      tabPanels.forEach(function (p) { p.classList.remove('active'); });

      btn.classList.add('active');
      document.getElementById('tab-' + target).classList.add('active');
    });
  });
});
</script>
@endpush

@endsection