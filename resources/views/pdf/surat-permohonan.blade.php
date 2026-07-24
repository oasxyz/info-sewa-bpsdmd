<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    body { font-family: 'Helvetica', sans-serif; font-size: 12pt; color: #000; line-height: 1.5; }
    .center { text-align: center; }
    .right { text-align: right; }
    .justify { text-align: justify; }
    .bold { font-weight: bold; }
    .underline { text-decoration: underline; }
    h1.title { text-align: center; font-size: 18pt; margin-bottom: 20px; }
    .kepada { margin-left: 40px; }
    .data-table td { padding: 3px 0; vertical-align: top; }
    .data-table td.label { width: 120px; }
    .ttd { margin-top: 50px; }
    .ttd-table td { padding: 5px 0; }
    .mt-10 { margin-top: 10px; }
    .mt-20 { margin-top: 20px; }
    .mt-40 { margin-top: 40px; }
</style>
</head>
<body>

<h1 class="title underline">SURAT PERMOHONAN</h1>

<div class="kepada">
    <p>Kepada Yth.</p>
    <p>Kepala Badan Pengembangan Sumber Daya</p>
    <p>Manusia Daerah Provinsi Jawa Tengah</p>
    <p>Di <strong>SEMARANG</strong></p>
</div>

<p class="mt-20">Yang bertanda tangan di bawah ini kami:</p>

<table class="data-table">
    <tr><td class="label">Nama</td><td>: <strong>{{ $pemesan->pemesan }}</strong></td></tr>
    <tr><td class="label">Alamat</td><td>: {{ $pemesan->alamat }}</td></tr>
</table>

<p class="mt-10 justify">
    Memberitahukan bahwa kami mengajukan permohonan pemakaian / pemanfaatan gedung / Ruang Badan
    Pengembangan Sumber Daya Manusia Daerah Provinsi Jawa Tengah berupa
    <strong>Gedung {{ $pemesan->gedung }}</strong>, dengan rincian sebagai berikut:
</p>

<table class="data-table">
    <tr><td class="label">Obyek Retribusi</td><td>: Gedung / Ruangan</td></tr>
    <tr><td class="label">Luas / Jumlah</td><td>: 1 (satu) unit</td></tr>
    <tr><td class="label">Penggunaan untuk</td><td>: {{ $pemesan->keperluan }}</td></tr>
    <tr><td class="label">Jangka waktu</td><td>: <strong>{{ $tanggalFormat }} ({{ $hari }} {{ $pemesan->waktu }})</strong></td></tr>
</table>

<p class="justify">
    Apabila permohonan dikabulkan kami sanggup membayar retribusi sesuai Peraturan Gubernur Jawa Tengah
    Nomor 16 tahun 2022 tentang Perubahan Tarif Retribusi Daerah Provinsi Jawa Tengah, serta menanggung
    segala biaya-biaya yang diakibatkan pemeriksaan dan persyaratan-persyaratan administrasi termasuk
    sanksi-sanksi sesuai dengan ketentuan perundang-undangan yang berlaku terhadap saya atau
    yang saya beri kuasa.
</p>

<div class="ttd right">
    <p>Semarang,</p>
    <p>Hormat Kami,</p>
    <p style="margin-top: 60px;"><strong>{{ $pemesan->pemesan }}</strong></p>
</div>

</body>
</html>