<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    @page { margin: 20px 20px 60px 20px; }
    body { font-family: 'Times New Roman', 'Times', serif; font-size: 12pt; color: #000; line-height: 1.4; margin: 0; padding: 20px; }
    .header { margin-top: 5px; margin-bottom: 10px; padding-left: 90px; padding-top: 12px; }
    .header img { width: 70px; position: absolute; top: 20px; left: 20px; }
    .header-title { font-family: 'Arial', 'Helvetica', sans-serif; font-size: 12pt; font-weight: bold; }
    .header-sub { font-family: 'Arial', 'Helvetica', sans-serif; font-size: 14pt; font-weight: bold; }
    .line { border-top: 1px solid #000; margin: 16px 0 12px 0; }
    .title { font-family: 'Times New Roman', 'Times', serif; text-align: center; font-size: 12pt; font-weight: bold; text-decoration: underline; margin-bottom: 16px; }
    table.data { border-collapse: collapse; width: 100%; margin-bottom: 10px; }
    table.data td { padding: 3px 0; vertical-align: top; }
    table.data td.indent { width: 25px; }
    table.data td.label { width: 140px; }
    .content-text { text-align: justify; margin-bottom: 20px; }
    .signature { text-align: right; margin-top: 30px; padding-right: 30px; }
    .signature-inner { display: inline-block; text-align: center; }
    .signature .name { margin-top: 60px; text-decoration: underline; font-weight: bold; }
    .footer { position: fixed; bottom: 0; left: 0; right: 0; text-align: center; }
    .footer-line { border-top: 1px solid #000; margin-bottom: 4px; }
    .footer-text { font-family: 'Times New Roman', 'Times', serif; font-size: 10pt; margin-bottom: 2px; }
    .footer-date { font-family: 'Times New Roman', 'Times', serif; font-size: 7pt; margin-top: 4px; }
</style>
</head>
<body>

<div class="header">
    <img src="{{ public_path('images/logo-jateng.png') }}" alt="Logo">
    <div class="header-title">PEMERINTAH PROVINSI JAWA TENGAH</div>
    <div class="header-sub">BADAN PENGEMBANGAN SUMBER DAYA MANUSIA DAERAH</div>
</div>

<div class="line"></div>

<div class="title">TANDA BUKTI PEMESANAN</div>

<p>Yang bertanda tangan di bawah ini:</p>

<table class="data">
    <tr><td class="indent"></td><td class="label">Nama</td><td>: {{ $pemesan->pemesan }}</td></tr>
    <tr><td></td><td>No. KTP</td><td>: {{ $pemesan->no }}</td></tr>
    <tr><td></td><td>Alamat</td><td>: {{ $pemesan->alamat }}</td></tr>
    <tr><td></td><td>Tanggal pemesanan</td><td>: {{ $tanggalPesan }}</td></tr>
</table>

<div class="content-text">
    Telah melakukan pemesanan {{ strtoupper($pemesan->gedung) }} untuk {{ $pemesan->keperluan }} pada hari {{ $hari }} tanggal {{ $tanggal }} {{ $bulan }} {{ $tahun }} waktu {{ $waktu }}. Dengan retribusi sebesar Rp {{ number_format($tarif, 0, ',', '.') }} ({{ $terbilang }}).
</div>

<div class="signature">
    <div class="signature-inner">
        <div>Pemesan</div>
        <div class="name">{{ $pemesan->pemesan }}</div>
    </div>
</div>

<div class="footer">
    <div class="footer-line"></div>
    <div class="footer-text">Bukti pemesanan online ini HARAP DIBAWA ke Ruang Layanan Informasi Badan Pengembangan Sumber Daya Manusia Daerah</div>
    <div class="footer-text">Provinsi Jawa Tengah pada jam kerja untuk verifikasi paling lambat 3 hari setelah pemesanan.</div>
    <div class="footer-date">Dicetak pada {{ $tanggalskr }}</div>
</div>

</body>
</html>