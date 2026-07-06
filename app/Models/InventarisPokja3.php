<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class InventarisPokja3 extends Model {
    use HasFactory;
    protected $table = 'inventaris_pokja3';
    protected $fillable = ['nama_barang','asal_barang','tanggal_penerimaan','jumlah','tempat_penyimpanan','kondisi_barang','keterangan'];
}
