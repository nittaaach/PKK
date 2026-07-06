<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class LapKegiatanPokja3 extends Model {
    use HasFactory;
    protected $table = 'lap_kegiatan_pokja3';
    protected $fillable = ['dasar','tanggal','waktu','tempat','acara','pimpinan_rapat','peserta','isi_laporan'];
    protected $casts = ['tanggal' => 'date'];
}
