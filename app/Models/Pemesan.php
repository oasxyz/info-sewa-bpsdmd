<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesan extends Model
{
    protected $table = 'pemesan';
    protected $primaryKey = 'id'; // FIX: migration pakai $table->id(), bukan id_pemesan
    public $timestamps = false;

    protected $fillable = [
        'kode_booking', 'no', 'pemesan', 'pemakai', 'email', 'alamat', 'telp', 'hp',
        'keperluan', 'tanggal_pakai', 'waktu', 'gedung', 'fasilitas',
        'instansi', 'temp', 'tanggal_pesan', 'status'
    ];

    protected $casts = [
        'tanggal_pakai' => 'date',
        'tanggal_pesan' => 'datetime',
    ];

    public function gedungInfo()
    {
        return $this->belongsTo(Gedung::class, 'gedung', 'gedung');
    }

    // Tagihan dihitung otomatis dari harga gedung sesuai waktu pakai
    public function getTagihanAttribute()
    {
        $g = $this->gedungInfo;
        if (!$g) return 0;

        return match ($this->waktu) {
            'SIANG' => $g->hargasiang,
            'MALAM' => $g->hargamalam,
            '1HARI' => $g->hargahari,
            default => 0,
        };
    }

    // Sisa hari sebelum auto-dibatalkan, buat ditampilin di badge
    public function getBatasWaktuAttribute()
    {
        if (!$this->tanggal_pesan) return null;

        if ($this->status === 'proses') {
            $batas = $this->tanggal_pesan->copy()->addDays(7);
        } elseif ($this->status === 'terverifikasi') {
            $batas = $this->tanggal_pesan->copy()->addDays(60);
        } else {
            return null;
        }

        return (int) ceil(now()->diffInDays($batas, false));
    }
}