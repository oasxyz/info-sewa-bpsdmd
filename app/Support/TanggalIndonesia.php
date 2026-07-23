<?php

namespace App\Support;

use Carbon\Carbon;

class TanggalIndonesia
{
    protected static array $hari = [
        'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu',
    ];

    protected static array $bulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
    ];

    public static function hari(Carbon $tanggal): string
    {
        return self::$hari[$tanggal->format('l')];
    }

    public static function bulan(Carbon $tanggal): string
    {
        return self::$bulan[(int) $tanggal->format('n')];
    }

    public static function format(Carbon $tanggal): string
    {
        return $tanggal->format('d') . ' ' . self::bulan($tanggal) . ' ' . $tanggal->format('Y');
    }

    public static function terbilang(int $nilai): string
    {
        $nilai = abs($nilai);
        $huruf = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];

        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } elseif ($nilai < 20) {
            $temp = self::terbilang($nilai - 10) . " belas";
        } elseif ($nilai < 100) {
            $temp = self::terbilang(intdiv($nilai, 10)) . " puluh" . self::terbilang($nilai % 10);
        } elseif ($nilai < 200) {
            $temp = " seratus" . self::terbilang($nilai - 100);
        } elseif ($nilai < 1000) {
            $temp = self::terbilang(intdiv($nilai, 100)) . " ratus" . self::terbilang($nilai % 100);
        } elseif ($nilai < 2000) {
            $temp = " seribu" . self::terbilang($nilai - 1000);
        } elseif ($nilai < 1000000) {
            $temp = self::terbilang(intdiv($nilai, 1000)) . " ribu" . self::terbilang($nilai % 1000);
        } elseif ($nilai < 1000000000) {
            $temp = self::terbilang(intdiv($nilai, 1000000)) . " juta" . self::terbilang($nilai % 1000000);
        } elseif ($nilai < 1000000000000) {
            $temp = self::terbilang(intdiv($nilai, 1000000000)) . " milyar" . self::terbilang((int) fmod($nilai, 1000000000));
        } else {
            $temp = self::terbilang(intdiv($nilai, 1000000000000)) . " triliun" . self::terbilang((int) fmod($nilai, 1000000000000));
        }

        return trim($temp);
    }

    public static function rupiahTerbilang(int $nilai): string
    {
        return ucfirst(self::terbilang($nilai)) . ' Rupiah';
    }
}