<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PapanDataPokja1Models extends Model
{
    use HasFactory;

    protected $table = 'papan_data_pokja1';
    protected $fillable = [
        'nama_wilayah', 'kader_pkbn', 'kader_pkdrt', 'kader_pola_asuh',
        'pkbn_jml_klp', 'pkbn_jml_anggota', 'pkdrt_jml_klp', 'pkdrt_jml_anggota',
        'pola_asuh_jml_klp', 'pola_asuh_jml_anggota', 'lansia_jml_klp',
        'lansia_jml_anggota', 'kerja_bakti', 'rukun_kematian', 'keagamaan',
        'jimpitan', 'arisan', 'keterangan'
    ];
}
