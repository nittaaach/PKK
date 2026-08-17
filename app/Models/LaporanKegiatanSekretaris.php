<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class LaporanKegiatanSekretaris extends Model {
    use HasFactory;
    protected $table = 'laporan_kegiatan_sekretaris';
    protected $fillable = ['dasar','tanggal','waktu','tempat','acara','pimpinan_rapat','peserta','isi_notulen','kesimpulan','mengetahui_jabatan','mengetahui_nama','pencatat_nama'];
    protected $casts = ['tanggal' => 'date'];
}
