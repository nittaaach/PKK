<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class GertamPokja3 extends Model {
    use HasFactory;
    protected $table = 'gertam_pokja3';
    protected $fillable = ['diterima_dari','jenis_tanaman','jumlah','waktu_penerimaan','keterangan'];
}
