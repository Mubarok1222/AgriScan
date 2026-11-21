<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatDeteksi extends Model
{
    use HasFactory;

    protected $table = 'riwayat_deteksi';
    protected $primaryKey = 'id_deteksi';

    protected $fillable = [
        'id_user',
        'id_penyakit',
        'foto_daun',
        'skor_akurasi',
        'status_hasil',
        'tanggal_deteksi',
    ];

    protected $casts = [
        'tanggal_deteksi' => 'datetime',
        'skor_akurasi' => 'float',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function penyakit(): BelongsTo
    {
        return $this->belongsTo(PenyakitPadi::class, 'id_penyakit', 'id_penyakit');
    }

    /**
     * Helper to get full storage URL for photo
     */
    public function getFotoUrlAttribute(): string
    {
        if (str_starts_with($this->foto_daun, 'http://') || str_starts_with($this->foto_daun, 'https://') || str_starts_with($this->foto_daun, '/images/')) {
            return $this->foto_daun;
        }

        return asset('storage/' . $this->foto_daun);
    }
}

