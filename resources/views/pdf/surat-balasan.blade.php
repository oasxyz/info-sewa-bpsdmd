<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    body { font-family: 'Helvetica', sans-serif; font-size: 11pt; color: #000; line-height: 1.4; }
    .center { text-align: center; }
    .right { text-align: right; }
    .justify { text-align: justify; }
    .bold { font-weight: bold; }
    .underline { text-decoration: underline; }
    .kop-title { text-align: center; font-size: 16pt; margin: 2px 0; }
    .kop-sub { text-align: center; font-size: 20pt; margin: 2px 0; }
    .kop-alamat { text-align: center; font-size: 8pt; margin: 1px 0; }
    .kop-logo { width: 60px; position: absolute; top: 20px; left: 40px; }
    hr.garis { border: none; border-top: 1px solid #000; margin: 2px 0; }
    hr.garis-tebal { border: none; border-top: 3px solid #000; margin: 0; }
    .data-table td { padding: 2px 0; vertical-align: top; }
    .data-table td.label { width: 100px; }
    .ttd { margin-top: 30px; }
    .mt-10 { margin-top: 10px; }
    .mt-20 { margin-top: 20px; }
    .mt-40 { margin-top: 40px; }
    .ms-40 { margin-left: 40px; }
</style>
</head>
<body>

<!-- KOP SURAT -->
<div style="position: relative;">
    <img src="{{ public_path('assets/images/Logo-Jawa+Tengah.png') }}" style="width: 60px; position: absolute; top: 0; left: 40px;">

    <p class="kop-title">PEMERINTAH PROVINSI JAWA TENGAH</p>
    <p class="kop-sub bold">BADAN PENGEMBANGAN</p>
    <p class="kop-sub bold">SUMBER DAYA MANUSIA DAERAH</p>
    <p class="kop-alamat">Jalan Setiabudi Nomor 201 A Semarang Kode Pos 50263</p>
    <p class="kop-alamat">Telepon 024-7473066 Faksimile 024-7473701 Laman http://bpsdmd.jatengprov.go.id</p>
    <p class="kop-alamat">Surat Elektronik bpsdmd@jatengprov.go.id</p>
</div>

<hr class="garis-tebal">
<hr class="garis">

<p class="right">Semarang, {{ $bulanSekarang }} {{ $tahunSekarang }}</p>

<table class="data-table">
    <tr>
        <td class="label">Nomor</td>
        <td width="20">:</td>
        <td></td>
        <td width="30"></td>
        <td class="label">Kepada</td>
        <td>:</td>
        <td>Yth.</td>
    </tr>
    <tr>
        <td class="label">Lampiran</td>
        <td>:</td>
        <td>-</td>
        <td></td>
        <td></td>
        <td></td>
        <td><strong>{{ $pemesan->pemesan }}</strong></td>
    </tr>
    <tr>
        <td class="label">Perihal</td>
        <td>:</td>
        <td>Surat Balasan Permohonan</td>
        <td></td>
        <td></td>
        <td></td>
        <td>{{ $pemesan->alamat }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Pinjam / Sewa Gedung</td>
    </tr>
</table>

<p class="justify ms-40 mt-10">
    Menunjuk surat Saudara tanggal {{ $tanggalFormat }}, perihal sebagaimana tersebut pada pokok surat,
    diberitahukan bahwa pada dasarnya kami menyampaikan terima kasih atas kepercayaannya untuk
    menggunakan gedung di BPSDMD Provinsi Jawa Tengah dan pada prinsipnya dapat memfasilitasi penggunaan :
</p>

<table class="data-table ms-40 mt-10">
    <tr><td style="width: 120px;">Gedung</td><td>: {{ $pemesan->gedung }}</td></tr>
    <tr><td>Hari / Tanggal</td><td>: <strong>{{ $hari }}, {{ $tanggalFormat }}</strong></td></tr>
    <tr><td>Jam Sewa</td><td>: {{ $jamSewa }}</td></tr>
    <tr><td>Keperluan</td><td>: {{ $pemesan->keperluan }}</td></tr>
</table>

<p class="justify ms-40 mt-10">
    Selanjutnya, untuk ketentuan pembayaran Pelunasan Sewa Gedung dapat dilakukan sesuai dengan
    ketentuan yang tercantum dalam Surat Perjanjian Sewa sebagaimana terlampir.
</p>

<p class="justify ms-40">
    Demikian untuk menjadikan maklum dan terima kasih.
</p>

<div class="center" style="margin-top: 20px;">
    <p><strong>a.n. KEPALA BADAN PENGEMBANGAN SUMBER DAYA MANUSIA DAERAH<br>PROVINSI JAWA TENGAH</strong></p>
    <p>Sekretaris,</p>
    <p style="margin-top: 50px;"><strong><u>{{ $sekretaris->nama ?? '' }}</u></strong></p>
    <p>{{ $sekretaris->nip ?? '' }}</p>
</div>

<p class="mt-20"><strong>Tembusan :</strong></p>
<p style="margin-left: 20px;">Kepala BPSDMD Provinsi Jawa Tengah (sebagai laporan)</p>

</body>
</html>