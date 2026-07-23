<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    body { font-family: 'Helvetica', sans-serif; font-size: 12pt; color: #000; line-height: 1.5; }
    .center { text-align: center; }
    .justify { text-align: justify; }
    .bold { font-weight: bold; }
    h1.title { text-align: center; font-size: 18pt; margin-bottom: 4px; }
    h2.subtitle { text-align: center; font-size: 14pt; margin: 2px 0; }
    table.data-table td { padding: 3px 0; vertical-align: top; }
    table.data-table td.label { width: 130px; }
    ol.legal { padding-left: 20px; }
    ol.legal li { margin-bottom: 8px; text-align: justify; }
    .pasal-title { text-align: center; font-weight: bold; margin-top: 24px; margin-bottom: 4px; }
    .pasal-body { text-align: justify; margin-bottom: 8px; }
    ol.klausul { padding-left: 20px; }
    ol.klausul li { margin-bottom: 6px; text-align: justify; }
    .page-break { page-break-before: always; }
</style>
</head>
<body>

<h1 class="title">SURAT PERJANJIAN</h1>
<h2 class="subtitle">SEWA GEDUNG {{ strtoupper($pemesan->gedung) }}</h2>
<h2 class="subtitle">BADAN PENGEMBANGAN SUMBER DAYA MANUSIA DAERAH</h2>
<h2 class="subtitle">(BPSDMD) PROVINSI JAWA TENGAH</h2>
<h2 class="subtitle">TAHUN {{ $tahunMou }}</h2>
<p class="center bold">NOMOR : &nbsp;</p>

<p class="justify" style="margin-top: 20px; text-indent: 40px;">
    Pada hari ini <strong>{{ $hariMou }}</strong> tanggal <strong>{{ $tanggalMouTerbilang }}</strong>
    bulan <strong>{{ $bulanMou }}</strong> tahun <strong>{{ $tahunMou }}</strong> yang bertanda tangan
    dibawah ini:
</p>

<table class="data-table" width="100%" style="margin-top: 16px;">
    <tr><td width="20">1.</td><td class="label">Nama</td><td>: <strong>{{ $kepala->nama ?? 'Drs. Mohamad Arief Irwanto, M.Si' }}</strong></td></tr>
    <tr><td></td><td class="label">NIP</td><td>: {{ $kepala->nip ?? '196806141990011001' }}</td></tr>
    <tr><td></td><td class="label">Jabatan</td><td>: Kepala BPSDMD Provinsi Jawa Tengah</td></tr>
    <tr><td></td><td class="label">Alamat Kantor</td><td>: Jl. Setiabudi No. 201-A Srondol Semarang.</td></tr>
</table>

<p class="justify" style="margin-top: 8px;">
    Dalam hal ini bertindak untuk dan atas nama Pemerintah Provinsi Jawa Tengah dan selanjutnya
    disebut sebagai <strong>PIHAK PERTAMA.</strong>
</p>

<table class="data-table" width="100%" style="margin-top: 20px;">
    <tr><td width="20">2.</td><td class="label">Nama</td><td>: <strong>{{ $pemesan->pemesan }}</strong></td></tr>
    <tr><td></td><td class="label">NIK</td><td>: {{ $pemesan->no }}</td></tr>
    <tr><td></td><td class="label">Alamat</td><td>: {{ $pemesan->alamat }}</td></tr>
    <tr><td></td><td class="label">No. HP (WA)</td><td>: {{ $pemesan->telp }}</td></tr>
    <tr><td></td><td class="label">Alamat E-mail</td><td>: {{ $pemesan->email ?: '-' }}</td></tr>
</table>

<p class="justify" style="margin-top: 8px;">
    Dalam hal ini bertindak untuk dan atas nama pengguna/penyewa gedung yang selanjutnya disebut
    sebagai <strong>PIHAK KEDUA.</strong>
</p>

<p class="bold" style="margin-top: 20px;">Berdasarkan :</p>
<ol class="legal">
    <li>Undang-Undang Nomor 28 Tahun 2009 tentang Pajak Daerah dan Retribusi Daerah</li>
    <li>Keputusan Menteri Kesehatan Republik Indonesia Nomor : HK.01.07/MENKES/382/2020 tentang Protokol Kesehatan bagi Masyarakat di Tempat dan Fasilitas Umum dalam Rangka Pencegahan dan Pengendalian Corona Virus Disease 2019 (Covid-19);</li>
    <li>Peraturan Daerah Provinsi Jawa Tengah Nomor 2 Tahun 2008 tentang Pengelolaan Barang Milik Daerah;</li>
    <li>Peraturan Gubernur Jawa Tengah Nomor 16 Tahun 2022 tentang Perubahan Tarif Retribusi Daerah Provinsi Jawa Tengah.</li>
</ol>

<div class="page-break"></div>

<p class="pasal-title">Pasal 1<br>Objek Sewa dan Ketentuan Pembayaran</p>
<p class="pasal-body">
    (1) <strong>PIHAK PERTAMA</strong> dan <strong>PIHAK KEDUA</strong> telah bersepakat mengadakan
    perjanjian sewa Gedung di BPSDMD Provinsi Jawa Tengah dengan obyek sewa Gedung
    {{ $pemesan->gedung }} untuk kegiatan {{ $pemesan->keperluan }} yang dikelola oleh
    <strong>PIHAK KEDUA</strong>.
</p>
<p class="pasal-body">
    (2) <strong>PIHAK PERTAMA</strong> memungut Retribusi Gedung untuk kegiatan {{ $pemesan->keperluan }}
    dengan objek sewa sebagaimana tersebut dalam Pasal 1 Ayat (1) perjanjian ini dan
    <strong>PIHAK KEDUA</strong> sanggup membayar Retribusi tersebut sesuai ketentuan yang berlaku.
</p>

<p class="pasal-title">Pasal 2<br>Waktu Pelaksanaan</p>
<p class="pasal-body">
    Waktu pelaksanaan kegiatan {{ $pemesan->keperluan }} pada hari <strong>{{ $hariPakai }}</strong>
    tanggal <strong>{{ $tanggalPakaiFormat }}</strong> pukul <strong>{{ $jamSewa }}</strong>.
</p>

<p class="pasal-title">Pasal 3<br>Biaya Retribusi dan Cara Pembayaran</p>
<p class="pasal-body">
    (1) Besarnya retribusi yang dibayar oleh <strong>PIHAK KEDUA</strong> kepada
    <strong>PIHAK PERTAMA</strong> adalah sebesar
    <strong>Rp {{ number_format($tarif, 0, ',', '.') }},- ({{ \App\Support\TanggalIndonesia::rupiahTerbilang($tarif) }})</strong>.
</p>
<p class="pasal-body">
    (2) <strong>PIHAK KEDUA</strong> melakukan pembayaran sewa paling lambat 10 (Sepuluh) hari sebelum
    kegiatan berlangsung, secara Non Tunai melalui PT Bank Pembangunan Daerah Jawa Tengah dengan
    nomor rekening <strong>1-034-02544-1</strong> atas nama Bendahara Penerimaan BPSDMD Prov. Jateng.
</p>
<p class="pasal-body">
    (3) Apabila <strong>PIHAK KEDUA</strong> tidak melakukan pembayaran sebagaimana tersebut dalam
    pasal 3 Ayat (2), maka dianggap telah membatalkan perjanjian dan <strong>PIHAK PERTAMA</strong>
    dapat menyewakan kepada pihak lain.
</p>
<p class="pasal-body">
    (4) Besarnya biaya retribusi sebagaimana tersebut pada Pasal 3 Ayat (1) dapat berubah sesuai
    dengan ketentuan yang berlaku.
</p>

<div class="page-break"></div>

<p class="pasal-title">Pasal 4<br>Hak dan Kewajiban PIHAK KEDUA</p>
<p class="pasal-body">(1) <strong>PIHAK KEDUA</strong> berhak mendapat fasilitas pelayanan Gedung {{ $pemesan->gedung }} sebagai berikut:</p>
<ol type="a" class="klausul">
    <li>Kursi lipat sebanyak 100 buah;</li>
    <li>Listrik 30.000 watt dan Genset;</li>
    <li>Full AC (portable 8 buah);</li>
    <li>Ruang transit 1 unit;</li>
    <li>Dapur bersih dan toilet; dan</li>
    <li>Lahan parkir yang luas.</li>
</ol>

<p class="pasal-body">(2) Selama pelaksanaan kegiatan kewajiban <strong>PIHAK KEDUA</strong> sebagai berikut:</p>
<ol type="a" class="klausul">
    <li>Menjaga keutuhan aset milik negara yang berada di lokasi/obyek sewa;</li>
    <li>Mengelola limbah/sampah sebagai akibat dari kegiatan yang dilaksanakan oleh <strong>PIHAK KEDUA</strong>;</li>
    <li>Limbah/sampah harus dibuang ke luar lokasi BPSDMD Provinsi Jawa Tengah;</li>
    <li>
        Guna mencegah penularan COVID-19, maka <strong>PIHAK KEDUA</strong> wajib mematuhi protokol
        kesehatan dengan menerapkan hal-hal sebagai berikut:
        <ol type="1" class="klausul" style="margin-top: 6px;">
            <li>Wajib mengajukan ijin penyelenggaraan kegiatan sosial kemasyarakatan kepada pihak yang berwenang;</li>
            <li>Wajib menyediakan sabun cuci tangan atau <em>hand sanitizer</em> bagi para tamu;</li>
            <li>Wajib menyediakan alat pengecekan suhu tubuh (<em>thermo gun</em>);</li>
            <li>Semua panitia/tim yang terlibat pada kegiatan diimbau untuk tetap menggunakan masker;</li>
            <li>Disarankan untuk menerapkan pembatas kapasitas tamu/undangan sesuai dengan kebijakan penanganan pandemi <em>COVID-19</em> yang sedang berlaku;</li>
            <li>Diutamakan tamu undangan sudah divaksin dan <em>skrining</em> dilakukan dengan menggunakan aplikasi Peduli Lindungi; dan</li>
            <li>Jika menyediakan makanan/minuman, dianjurkan dengan menggunakan metode <em>take away</em> (hidangan untuk dibawa pulang) atau disesuaikan dengan kebijakan yang berlaku;</li>
        </ol>
    </li>
</ol>

<div class="page-break"></div>

<p class="pasal-title">Pasal 5</p>
<p class="pasal-body">
    (1) Surat Perjanjian sewa Gedung/Ruangan ini dibuat dan ditandatangani pada hari ini tanggal,
    bulan dan tahun sebagaimana tercantum dalam awal Surat Perjanjian, dalam rangkap 2 (dua),
    masing-masing mempunyai kekuatan hukum yang sama sebagai alat bukti hukum. Lembar
    <strong>PERTAMA</strong> untuk <strong>PIHAK PERTAMA</strong> dan lembar <strong>KEDUA</strong>
    untuk <strong>PIHAK KEDUA</strong>.
</p>
<p class="pasal-body">
    (2) Surat Perjanjian Sewa Gedung/Ruangan ini dinyatakan <strong>tidak berlaku</strong> apabila ada
    kebijakan pemerintah, terkait dengan situasi darurat nasional yang tidak memperbolehkan untuk
    berkerumun atau mengumpulkan masa dalam satu ruangan.
</p>
<p class="pasal-body">
    (3) Segala biaya yang timbul akibat dari terbitnya perjanjian ini, menjadi tanggungjawab
    sepenuhnya oleh <strong>PIHAK KEDUA.</strong>
</p>

<table width="100%" style="margin-top: 50px;">
    <tr>
        <td width="50%" class="center bold">PIHAK KEDUA</td>
        <td width="50%" class="center bold">PIHAK PERTAMA</td>
    </tr>
    <tr>
        <td class="center" style="padding-top: 60px;"><strong>{{ $pemesan->pemesan }}</strong></td>
        <td class="center" style="padding-top: 60px;">
            <strong><u>{{ $kepala->nama ?? 'Drs. Mohamad Arief Irwanto, M.Si' }}</u></strong><br>
            NIP. {{ $kepala->nip ?? '196806141990011001' }}
        </td>
    </tr>
</table>

</body>
</html>