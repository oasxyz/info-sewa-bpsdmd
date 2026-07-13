<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pemesanan Berhasil - Info Sewa BPSDMD Provinsi Jawa Tengah</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="/css/pesan.css">

</head>
<body>

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
    <a href="/pesan" class="btn-pesan">Pesan Gedung</a>
  </div>
</nav>

<div class="page-wrap">
  <div class="form-card">
    <div class="form-card-header">Pemesanan Berhasil</div>
    <div class="form-card-body">
      <div class="text-center py-4">
        <div style="font-size: 80px; color: #28a745;">&#10004;</div>
        <h3 class="mt-3">Pemesanan Berhasil!</h3>
        <p class="text-muted">Terima kasih, data pemesanan Anda telah tersimpan.</p>
      </div>

      <div class="card p-4 mb-4">
        <h5>Ringkasan Pemesanan</h5>
        <table class="table table-borderless">
          <tr><td>No. KTP</td><td>: {{ $data['no_ktp'] }}</td></tr>
          <tr><td>Nama Pemesan</td><td>: {{ $data['nama_pemesan'] }}</td></tr>
          <tr><td>Nama Pemakai</td><td>: {{ $data['nama_pemakai'] }}</td></tr>
          <tr><td>Gedung</td><td>: {{ $data['gedung'] }}</td></tr>
          <tr><td>Tanggal Pakai</td><td>: {{ $data['tanggal_pemakaian'] }}</td></tr>
          <tr><td>Waktu</td><td>: {{ $data['waktu_pakai'] }}</td></tr>
          <tr><td>Keperluan</td><td>: {{ $data['keperluan'] }}</td></tr>
        </table>
      </div>

      <div class="alert alert-info">
        <strong>Penting!</strong> Lakukan verifikasi paling lambat 7 hari setelah pemesanan, dengan cara datang langsung pada jam kerja ke <strong>Ruang Layanan Informasi BPSDMD Provinsi Jawa Tengah</strong> dan menunjukkan <strong>KTP</strong> beserta bukti pemesanan ini.
      </div>

      <div class="text-center mt-4">
        <a href="/" class="btn btn-secondary">Kembali ke Beranda</a>
        <button onclick="window.print()" class="btn btn-primary">Cetak</button>
      </div>
    </div>
  </div>
</div>

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
