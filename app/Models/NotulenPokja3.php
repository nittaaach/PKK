<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class NotulenPokja3 extends Model {
    use HasFactory;
    protected $table = 'notulen_pokja3';
    protected $fillable = ['dasar','tanggal','waktu','tempat','acara','pimpinan_rapat','peserta','isi_notulen'];
    protected $casts = ['tanggal' => 'date'];
}
