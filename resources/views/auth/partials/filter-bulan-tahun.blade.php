<form method="GET" action="{{ route('admin.pemesanan') }}" class="filter-bar">
  <select name="bulan" class="form-control">
    <option value="">--Bulan--</option>
    @php
      $namaBulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
      ];
    @endphp
    @foreach($namaBulan as $angka => $nama)
      <option value="{{ $angka }}" {{ (string) request('bulan') === (string) $angka ? 'selected' : '' }}>{{ $nama }}</option>
    @endforeach
  </select>

  <select name="tahun" class="form-control">
    <option value="">--Tahun--</option>
    @foreach($tahunOptions as $t)
      <option value="{{ $t }}" {{ (string) request('tahun') === (string) $t ? 'selected' : '' }}>{{ $t }}</option>
    @endforeach
  </select>

  <button type="submit" class="btn-filter">Filter</button>

  <a href="{{ route('admin.pemesanan') }}" class="btn-reset-filter">Reset</a>
</form>