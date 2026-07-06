<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPotensiPokja3 extends Model
{
    use HasFactory;

    protected $table = 'data_potensi_pokja3';

    protected $fillable = [
        'wilayah',
        'lumbung_hidup',
        'warung_hidup',
        'peternakan',
        'perikanan',
        'tanaman_produktif',
        'toga',
        'tanaman_keras',
        'tanaman_hias',
        'tabulapot',
        'jumlah_komposting',
        'lrb',
        'pilah_sampah',
        'kwt',
        'poktan_hatinya_pkk',
        'urban_farming',
        'keterangan',
    ];
}
