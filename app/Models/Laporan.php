<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Laporan extends Model
{
    use HasFactory, Notifiable;

    // Nama tabel di database
    protected $table = 'laporan';

    // Primary key yang digunakan
    protected $primaryKey = 'laporan_id';

    // Timestamps otomatis
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'nama_pelapor',
        'kontak_pelapor',
        'kronologi',
        'lokasi_kejadian',
        'tanggal_kejadian',
        'bukti_kejadian',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }   
}
