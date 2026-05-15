<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuKeuangan extends Model
{
    protected $table = 'buku_keuangans';
    protected $fillable = [
        'role',
        'tanggal_penerimaan',
        'sumber_dana_penerimaan',
        'uraian_penerimaan',
        'bukti_kas_penerimaan',
        'penerimaan',
        'tanggal_pengeluaran',
        'sumber_dana_pengeluaran',
        'uraian_pengeluaran',
        'bukti_kas_pengeluaran',
        'pengeluaran'
    ];
}
