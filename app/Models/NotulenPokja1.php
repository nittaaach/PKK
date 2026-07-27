<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class NotulenPokja1 extends Model {
    use HasFactory;
    protected $table = 'notulen_pokja1';
    protected $fillable = ['dasar','tanggal','waktu','tempat','acara','pimpinan_rapat','peserta','isi_notulen','kesimpulan','mengetahui_jabatan','mengetahui_nama','pencatat_nama'];
    protected $casts = ['tanggal' => 'date'];
}
