<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pesan Gedung - Info Sewa BPSDMD Provinsi Jawa Tengah</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="/css/pesan.css">

</head>
<body>

<!-- ================= NAVBAR ================= -->
<nav class="navbar-custom">
  <div class="container d-flex align-items-center justify-content-between">

    <div class="d-flex align-items-center gap-2">
      <div class="brand-logo">
        <img src="/images/logo-jateng.png" alt="Logo BPSDMD Jawa Tengah">
      </div>
      <div>
        <div class="brand-text-main">INFO SEWA</div>
        <div class="brand-text-sub">BPSDMD Provinsi Jawa Tengah</div>
      </div>
    </div>

    <div class="nav-links d-none d-lg-flex">
      <a href="/">Home</a>
      <a href="/pesan" class="active">Pesan</a>
      <a href="#">Informasi</a>
    </div>

    <a href="#formulir" class="btn-pesan">Pesan Gedung</a>
  </div>
</nav>

<!-- ================= PAGE CONTENT ================= -->
<div class="page-wrap">

  <!-- ===== PETUNJUK PEMESANAN ===== -->
  <div class="petunjuk-card">
    <h5>Petunjuk Pemesanan:</h5>
    <ol>
      <li>Silakan isi identitas Anda dengan benar termasuk KTP (Kartu Tanda Penduduk), karena akan digunakan pada saat verifikasi.</li>
      <li>Setelah berhasil melakukan pemesanan, Anda bisa melihat jadwal pemesanan Anda di menu 'Jadwal pemesanan'.</li>
      <li>Setelah berhasil melakukan pemesanan, lakukan <strong>verifikasi paling lambat 7 hari setelah pemesanan</strong>, dengan cara datang langsung pada jam kerja ke <strong>Ruang Layanan Informasi BPSDMD Provinsi Jawa Tengah</strong> dan menunjukkan <strong>KTP</strong> beserta bukti cetak pemesanan online.</li>
      <li>Jika dalam waktu 7 hari Anda belum melakukan verifikasi, data pemesanan Anda akan dihapus.</li>
      <li>Pelunasan biaya sewa gedung dilakukan <strong>paling lambat 60 hari sebelum tanggal pemakaian.</strong> Apabila melebihi batas waktu tersebut maka pemesanan akan dibatalkan.</li>
      <li>Penggunaan Gedung Sasana Widya Praja untuk acara Resepsi Pernikahan hanya bisa digunakan pada hari <strong>Jumat Malam, Sabtu, Minggu</strong> dan hari libur nasional.</li>
      <li>Apabila terjadi pembatalan segera hubungi petugas.</li>
    </ol>
  </div>

  <!-- ===== FORMULIR PEMESANAN ===== -->
  <div class="form-card" id="formulir">
    <div class="form-card-header">Formulir Pemesanan</div>
    <div class="form-card-body">
        <form action="{{ route('pesan') }}" method="POST">
          @csrf

          @if($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

        <div class="row g-4 mb-1">
          <div class="col-12">
            <label class="form-label">No. KTP <span class="text-muted fw-normal">(Kartu Tanda Penduduk)</span><span class="req">*</span></label>
            <input type="text" class="form-control" name="no_ktp" placeholder="Nomor KTP" value="{{ old('no_ktp') }}" required>
            @error('no_ktp') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="row g-4 mt-1">
          <div class="col-md-6">
            <label class="form-label">Nama pemesan<span class="req">*</span></label>
            <input type="text" class="form-control" name="nama_pemesan" placeholder="Nama pemesan" value="{{ old('nama_pemesan') }}" required>
            @error('nama_pemesan') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label">Nama pemakai<span class="req">*</span></label>
            <input type="text" class="form-control" name="nama_pemakai" placeholder="Nama pemakai" value="{{ old('nama_pemakai') }}" required>
            @error('nama_pemakai') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="row g-4 mt-1">
          <div class="col-md-6">
            <label class="form-label">No. telepon pemesan<span class="req">*</span></label>
            <input type="tel" class="form-control" name="no_telepon_pemesan" placeholder="Nomor telepon pemesan" value="{{ old('no_telepon_pemesan') }}" required>
            @error('no_telepon_pemesan') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label">No. telepon pemakai<span class="req">*</span></label>
            <input type="tel" class="form-control" name="no_telepon_pemakai" placeholder="Nomor telepon pemakai" value="{{ old('no_telepon_pemakai') }}" required>
            @error('no_telepon_pemakai') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="row g-4 mt-1">
          <div class="col-md-6">
            <label class="form-label">Email<span class="req">*</span></label>
            <input type="email" class="form-control" name="email" placeholder="Alamat email" value="{{ old('email') }}" required>
            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label">Alamat<span class="req">*</span></label>
            <textarea class="form-control" name="alamat" rows="1" placeholder="Alamat" required>{{ old('alamat') }}</textarea>
            @error('alamat') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="row g-4 mt-1">
          <div class="col-md-6">
            <label class="form-label">Tanggal pemakaian<span class="req">*</span></label>
            <input type="date" class="form-control" name="tanggal_pemakaian" value="{{ old('tanggal_pemakaian') }}" required>
            @error('tanggal_pemakaian') <div class="text-danger small">{{ $message }}</div> @enderror
            <div class="radio-group">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="waktu_pakai" id="waktuSiang" value="siang" {{ old('waktu_pakai') == 'siang' ? 'checked' : '' }}>
                <label class="form-check-label" for="waktuSiang">siang</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="waktu_pakai" id="waktuMalam" value="malam" {{ old('waktu_pakai') == 'malam' ? 'checked' : '' }}>
                <label class="form-check-label" for="waktuMalam">malam</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="waktu_pakai" id="waktuSehari" value="sehari" {{ old('waktu_pakai') == 'sehari' ? 'checked' : '' }}>
                <label class="form-check-label" for="waktuSehari">1 hari</label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <label class="form-label">Keperluan<span class="req">*</span></label>
            <input type="text" class="form-control" name="keperluan" placeholder="Contoh resepsi" value="{{ old('keperluan') }}" required>
            @error('keperluan') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="row g-4 mt-1 mb-4">
          <div class="col-md-6">
            <label class="form-label">Gedung yang dipesan</label>
            <select class="form-select" name="gedung" required>
              @foreach($gedungs as $g)
                <option value="{{ $g->gedung }}" {{ old('gedung') == $g->gedung ? 'selected' : '' }}>{{ $g->gedung }}</option>
              @endforeach
            </select>
            @error('gedung') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
        </div>

        <button type="submit" class="btn-submit-pesan">Pesan Sekarang</button>
      </form>
    </div>
  </div>

</div>

<!-- ================= FOOTER ================= -->
<footer class="site-footer">
  <div class="container">
    <div class="row gy-4">
      <div class="col-md-4">
        <h6>BPSDMD<br>PROVINSI JAWA TENGAH</h6>
        <p>Jl. Setiabudi No. 201 A, Semarang 50263</p>
        <p>Telepon: 024-7472046</p>
        <p>Faximile: 7472930</p>
        <p>Email: bpsdmd@jatengprov.go.id</p>
      </div>
      <div class="col-md-4 text-md-center">
        <h6>Link Terkait</h6>
        <p><a href="#">Website BPSDMD</a></p>
        <p><a href="#">PPID BPSDMD</a></p>
      </div>
      <div class="col-md-4 text-md-end">
        <h6>Follow Us</h6>
        <div class="footer-social">
          <a href="#"><i class="bi bi-instagram"></i></a>
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-twitter-x"></i></a>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
