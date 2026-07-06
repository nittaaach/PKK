<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPrestasiPokja3 extends Model
{
    use HasFactory;
    protected $table = 'data_prestasi_pokja3';
    protected $fillable = [
        'tgl_tahun_lomba', 'nama_peserta', 'nama_lomba', 'prestasi',
        'tempat', 'tingkat_kelurahan', 'tingkat_kecamatan',
        'tingkat_kota', 'tingkat_provinsi', 'keterangan',
    ];
}
