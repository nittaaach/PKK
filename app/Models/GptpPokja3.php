<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class GptpPokja3 extends Model {
    use HasFactory;
    protected $table = 'gptp_pokja3';
    protected $fillable = ['jenis_tanaman','jumlah','lokasi_tanaman','tanggal_bantuan','kondisi_hidup','kondisi_mati','keterangan'];
}
