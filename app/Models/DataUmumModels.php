<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUmumModels extends Model
{
    use HasFactory;

    protected $table = 'data_umum';
    protected $fillable = [
        'nama_wilayah',
        'pkk_rw',
        'pkk_rt',
        'dasa_wisma',
        'krt',
        'kk',
        'jiwa_l',
        'jiwa_p',
        'kader_tp_pkk_l',
        'kader_tp_pkk_p',
        'kader_umum_l',
        'kader_umum_p',
        'kader_khusus_l',
        'kader_khusus_p',
        'honorer_l',
        'honorer_p',
        'bantuan_l',
        'bantuan_p',
        'keterangan'
    ];
}
