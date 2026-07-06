<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class DataPtpPokja3 extends Model {
    use HasFactory;
    protected $table = 'data_ptp_pokja3';
    protected $fillable = [
        'nama_wilayah','jml_dasawisma','jml_krt','lumbung_hidup','warung_hidup',
        'apotik_hidup','peternakan','perikanan','tanaman_produktif','tanaman_keras',
        'tanaman_hias','tabulapot','komposting','lrb','pilah_sampah','keterangan'
    ];
}
