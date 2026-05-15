<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluarModels extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar';
    protected $fillable = [
        'role',
        'nomor_kode_surat',
        'tanggal_surat',
        'kepada',
        'perihal',
        'lampiran',
        'tembusan',
    ];
}
