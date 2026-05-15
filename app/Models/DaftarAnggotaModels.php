<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarAnggotaModels extends Model
{
    use HasFactory;

    // Arahkan ke nama tabel yang benar
    protected $table = 'daftar_anggota';

    // Kolom apa saja yang boleh diisi lewat form (Mass Assignment)
    protected $fillable = [
        'id_users',
        'no_registrasi',
        'name',
        'jenis_kelamin',
        'role_pkk',
        'keanggotaan_tp_pkk',
        'kader_umum',
        'kader_khusus',
        'tempat_lahir',
        'tanggal_lahir',
        'umur',
        'status_perkawinan',
        'alamat',
        'pendidikan',
        'pekerjaan',
        'keterangan',
        'foto',
        'email',
        'notelp'
    ];

    // Mengubah tipe data secara otomatis saat ditarik dari database
    protected $casts = [
        'kader_umum' => 'boolean',
        'kader_khusus' => 'boolean',
        'tanggal_lahir' => 'date',
        'umur' => 'integer',
    ];

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
