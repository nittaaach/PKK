<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasukModels extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';
    protected $fillable = [
        'role',
        'tanggal_terima',
        'tanggal_surat',
        'no_surat',
        'asal_surat',
        'perihal',
        'lampiran',
        'diteruskan_kepada',
    ];
}
