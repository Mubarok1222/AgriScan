<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PenyakitPadi extends Model
{
    use HasFactory;

    protected $table = 'penyakit_padi';
    protected $primaryKey = 'id_penyakit';

    protected $fillable = [
        'nama_penyakit',
        'deskripsi',
        'saran_penanganan',
    ];

    public function riwayatDeteksi(): HasMany
    {
        return $this->hasMany(RiwayatDeteksi::class, 'id_penyakit', 'id_penyakit');
    }
}

