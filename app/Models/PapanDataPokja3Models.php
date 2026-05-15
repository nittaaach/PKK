<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PapanDataPokja3Models extends Model
{
    use HasFactory;

    protected $table = 'papan_data_pokja3';
    protected $fillable = [
        'nama_wilayah', 'kader_pangan', 'kader_sandang', 'kader_tata_laksana',
        'beras', 'non_beras', 'peternakan', 'perikanan', 'warung_hidup',
        'lumbung_hidup', 'toga', 'tanaman_keras', 'industri_pangan',
        'industri_sandang', 'industri_jasa', 'rumah_sehat', 'rumah_tidak_sehat', 'keterangan'
    ];
}
