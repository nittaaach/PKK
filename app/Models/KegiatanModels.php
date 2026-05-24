<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanModels extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    protected $fillable = [
        'role',
        'nama',
        'jabatan',
        'kategori',
        'tanggal_kegiatan',
        'tempat',
        'uraian',
        'tanda_tangan',
        'dokumentasi_ids',
    ];
}
