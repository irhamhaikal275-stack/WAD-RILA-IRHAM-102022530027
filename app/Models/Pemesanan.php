<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    // Menghubungkan ke nama tabel persis di MySQL Workbench kamu
    protected $table = 'pemesanan';

    public $timestamps = false; // matikan jika tabel native kamu tidak memakai created_at/updated_at

    protected $fillable = [
        'nama',
        'tanggal',
        'jam',
        'raket',
        'sepatu',
        'bola',
        'total_bayar',
    ];

    protected static function booted()
    {
        static::saving(function ($pemesanan) {
            $pemesanan->total_bayar = (($pemesanan->raket ?? 0) * 25000) + 
                                      (($pemesanan->sepatu ?? 0) * 25000) + 
                                      (($pemesanan->bola ?? 0) * 25000);
        });
    }
}